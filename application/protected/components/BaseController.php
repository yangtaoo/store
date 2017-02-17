<?php
/**
 * 自定义控制器基类文件
 *
 * @author Yao Jian <1400310011@qq.com>
 */

/**
 * Class BaseController.
 */
class BaseController extends CController {
    /**
     * 页面title
     */
    public $title;
    /**
     * 微信分享参数
     */
    public static $shareParam;
    /**
     * 开始Action之前的操作.
     *
     * @param string $controller Controller.
     * @param string $action     Action.
     *
     * @return bool.
     */
    public function beforeControllerAction($controller, $action) {
        parent::beforeControllerAction($controller, $action);
        return true;
    }

    /**
     * action前执行.
     *
     * @param string $action Action.
     *
     * @return boolean.
     */
    public function beforeAction($action) {
        $userInfo  = Yii::app()->session['userInfo'];
        $path      = strtolower($this->getId() . '/' . $action->getId());
        $ignorePath = array(
            'usercenter/login',
            'usercenter/ajaxlogin',
            'user/getuserinfo',
            'weixinmessage/reply',
            'pay/wxpaynotify',
            'product/360images',
        );
        $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        if (!$userInfo && !in_array($path, $ignorePath) && strpos($userAgent, 'MicroMessenger') !== false) {
            $rurl    = 'http://' . $_SERVER['HTTP_HOST'] . '/User/getUserInfo';
            $rurl    = urlencode($rurl);
            $baseUrl = Yii::app()->params['weixinParams']['apiUrl']['userGetCode'];

            //用PHP方法 跳转到这个地址
            $url = $baseUrl . '?appid=' . Yii::app()->params['weixinParams']['weixinAuth']['AppID'] . '&redirect_uri=' . $rurl . '&response_type=code&scope=snsapi_userinfo&state=' . urlencode($_SERVER['REQUEST_URI']) . '#wechat_redirect';
            // echo $url;exit;
            header("location:" . $url);
            exit;
        }
        //设置微信分享参数
        $this::$shareParam = self::getWxConfig();
        return parent::beforeAction($action);
    }

    public function responeJson($data) {
        echo json_encode($data);
        exit;
    }

    public function page404() {
        die('page not found');
    }
    //获取微信分享设置
    public static function getWxConfig() {
        $weixinParams     = Yii::app()->params['weixinParams'];
        $model            = BaseModel::getInstance();
        $params           = array();
        $time             = time();
        $str              = md5(uniqid());
        $params['config'] = array(
            'app_id'    => $weixinParams['weixinAuth']['AppID'],
            'timestamp' => $time,
            'nonceStr'  => $str,
            'signature' => '',
        );
        $curl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $db   = BaseModel::getInstance()->getDb();
        if ($result = $db->select('values')->from('admin_config')->where(array('and', 'name="share_set"'))->queryRow()) {
            $params['param']         = json_decode($result['values'], true);
            $params['param']['link'] = $curl;
        }
        $row = $model->getDb()->select('values')->from('admin_config')->where(array('and', 'name="jsapi_ticket"'))->queryRow();
        $arr = array(
            'noncestr'  => $str,
            'timestamp' => $time,
            'url'       => $curl,
        );
        if ($row) {
            $row = json_decode($row['values'], true);
            if ($time < $row['expires_in']) {
                $arr['jsapi_ticket'] = $row['ticket'];
                ksort($arr, SORT_STRING);
                $sstr                          = http_build_query($arr);
                $sstr                          = urldecode($sstr);
                $params['config']['signature'] = sha1($sstr);
                return $params;
            }
        }
        $accessToken = $model->getAccessToken();
        $url         = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=' . $accessToken . '&type=jsapi';
        $result      = CurlApiModel::getInstance()->crulWeixin($url);
        if (!isset($result['ticket']) || !isset($result['expires_in'])) {
            return $params;
        }
        $arr['jsapi_ticket'] = $result['ticket'];
        ksort($arr, SORT_STRING);
        $sstr                          = http_build_query($arr);
        $sstr                          = urldecode($sstr);
        $params['config']['signature'] = sha1($sstr);
        $param                         = array(
            'ticket'     => $result['ticket'],
            'expires_in' => $result['expires_in'] + $time,
        );
        if ($row) {
            $data = array('values' => json_encode($param));
            $model->update($data, array('and', 'name="jsapi_ticket"'));
        } else {
            $data = array(
                'name'   => 'jsapi_ticket',
                'values' => json_encode($param),
            );
            $model->insert($data);
        }
        return $params;
    }
}
