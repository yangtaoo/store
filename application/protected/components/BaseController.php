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
        return parent::beforeAction($action);
    }

    public function responeJson($data) {
        echo json_encode($data);
        exit;
    }

    public function page404() {
        die('page not found');
    }
    
}
