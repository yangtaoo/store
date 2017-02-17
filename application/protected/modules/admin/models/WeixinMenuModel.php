<?php

/**
 * 自定义菜单类.
 *
 * @author yangtaoo <1162510775@qq.com>
 */
class WeixinMenuModel extends BaseModel {

    const TABLE_NAME = 'turnreal_weixin_menu';

    /**
     * 保存自定义菜单
     *
     * @param array   $param
     * @param integer $id
     *
     * @return integer
     */
    public function saveMenu($param, $id) {
        $result = array(
            'status'  => 0,
            'message' => '',
        );
        if ($id) {
            if ($this->update($param, array('and', 'id=' . $id, 'user_id=' . $param['user_id'])) === false) {
                $result['message'] = "菜单更新失败";
                return $result;
            }
        } else {
            if ($param['f_id'] == 0) {
                $data = $this->getDb()->select('count(1) as cnt')->from(self::TABLE_NAME)->where(array('and', 'f_id=0', 'user_id=' . $param['user_id']))->queryRow();
                if ($data['cnt'] > 2) {
                    $result['message'] = '顶级菜单最多只能创建三个';
                    return $result;
                }
            } else {
                $data = $this->getDb()->select('count(1) as cnt')->from(self::TABLE_NAME)->where(array('and', 'f_id=' . $param['f_id'], 'user_id=' . $param['user_id']))->queryRow();
                if ($data['cnt'] > 4) {
                    $result['message'] = '二级菜单最多只能创建五个';
                    return $result;
                }
            }
            if ($this->insert($param) === false) {
                $result['message'] = "菜单创建失败";
                return $result;
            }
        }
        $result['status'] = 1;
        return $result;
    }

    /**
     * 获取微信自定义菜单设置
     *
     * @return array .
     */
    public function getMenuList() {
        $user_id = !empty($_SESSION['accountInfo']['AccountID']) ? $_SESSION['accountInfo']['AccountID'] : 0;
        $data    = $this->getDb()->select('*')->from(self::TABLE_NAME)->where(array('and', 'user_id=' . $user_id))->order('sort')->queryAll();
        $result  = array();
        $child   = array();
        foreach ($data as $val) {
            if ($val['f_id'] == 0) {
                $result[$val['id']] = $val;
            } else {
                $child[$val['f_id']][] = $val;
            }
        }
        foreach ($result as $id => &$val) {
            $val['child'] = isset($child[$id]) ? $child[$id] : array();
        }
        return $result;
    }

    /**
     * 自定义菜单删除
     *
     * @param integer $id .
     *
     * @return array
     */
    public function delMenu($id) {
        $user_id = !empty($_SESSION['accountInfo']['AccountID']) ? $_SESSION['accountInfo']['AccountID'] : 0;
        $result  = array(
            'status'  => 0,
            'message' => '',
        );
        if ($this->delete(array('and', 'user_id=' . $user_id, 'f_id=' . $id . ' or ' . 'id=' . $id)) === false) {
            $result['message'] = '删除失败';
            return $result;
        }
        $result['status'] = 1;
        return $result;
    }

    public function urlencodeArr($data) {
        $result = array();
        foreach ($data as $key => $val) {
            if (is_array($val)) {
                $val = $this->urlencodeArr($val);
            } else {
                $val = urlencode($val);
            }
            $result[$key] = $val;
        }
        return $result;
    }

    public function releaseMenu() {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return false;
        }
        $menuList = $this->getMenuList();
        $menuList = $this->urlencodeArr($menuList);
        $menu     = array();
        foreach ($menuList as $val) {

            $one = array(
                "name" => $val['name'],
            );
            if ($val['child']) {
                $one['sub_button'] = array();
                foreach ($val['child'] as $v) {
                    $subButton = array(
                        "type" => $v['type'],
                        "name" => $v['name'],
                    );
                    if ($subButton['type'] == 'view') {
                        $subButton['url'] = $v['url'];
                    }
                    if ($subButton['type'] == 'text') {
                        $subButton['value'] = $v['content'];
                    }
                    $one['sub_button'][] = $subButton;
                }
            } else {
                $one['type'] = $val['type'];
                if ($one['type'] == 'view') {
                    $one['url'] = $val['url'];
                }
                if ($one['type'] == 'text') {
                    $one['value'] = $val['content'];
                }
            }
            $menu['button'][] = $one;
        }
        $menu = urldecode(json_encode($menu));

        $url = Yii::app()->params['weixinParams']['apiUrl']['createMenu'] . '?access_token=' . $accessToken;
        return CurlApiModel::getInstance()->crulWeixin($url, 1, $menu);

    }
}
