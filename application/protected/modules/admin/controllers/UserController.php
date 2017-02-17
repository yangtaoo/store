<?php
/**
 * 默认控制器.
 *
 * @author yangtaoo <1162510775@qq.com>
 */

/**
 * 默认控制器类.
 */
class UserController extends CController {

    /**
     * 默认方法.
     *
     * @return void
     */
    public function actionIndex() {
        $pageSizeConfig = array(
            10  => 10,
            20  => 20,
            50  => 50,
            100 => 100,
        );
        $page     = Yii::app()->request->getParamInt("page", 1);
        $pageSize = Yii::app()->request->getParamInt("pageSize", 10);
        $pageSize = isset($pageSizeConfig[$pageSize]) ? $pageSize : 10;
        $keyWords = Yii::app()->request->getParam("keyWords");
        $cond     = array();
        if (!empty($keyWords)) {
            $cond = array(
                'or',
                'id="' . $keyWords . '"',
                'mobile like "%' . $keyWords . '%"',
                'true_name like "%' . $keyWords . '%"',
                'country = "' . $keyWords . '"',
                'province = "' . $keyWords . '"',
                'city = "' . $keyWords . '"',
                'nickname like "%' . $keyWords . '%"',
            );
        }
        $list    = UserModel::getInstance()->getPageList($page, $pageSize, $cond, 'id desc');
        $userIds = array();
        foreach ($list['data'] as $k => $v) {
            $userIds[] = $v['id'];
        }
        $this->render('index', compact('list', 'pageSizeConfig', 'pageSize', 'keyWords'));
    }

    public function actionAjaxRedPack() {
        $user_id      = !empty($_SESSION['accountInfo']['AccountID']) ? $_SESSION['accountInfo']['AccountID'] : 0;
        $openid       = Yii::app()->request->getParam("openid");
        $price        = Yii::app()->request->getParamInt("price");
        $price        = $price > 20000 ? 20000 : $price;
        $websiteTitle = BaseModel::getInstance()->getSiteName('website_title');
        $param        = array(
            'mch_billno'   => Yii::app()->params['weixinParams']['redPack']['mchId'] . date('Ymd') . time(),
            'mch_id'       => Yii::app()->params['weixinParams']['redPack']['mchId'],
            'wxappid'      => Yii::app()->params['weixinParams']['weixinAuth']['AppID'],
            'send_name'    => $websiteTitle,
            're_openid'    => $openid,
            'total_amount' => $price,
            'total_num'    => 1,
            'wishing'      => '感谢关注' . $websiteTitle,
            'client_ip'    => Yii::app()->params['weixinParams']['redPack']['clientIp'],
            'act_name'     => '关注有奖',
            'remark'       => '关注就有大红包',
        );
        $send   = CurlApiModel::getInstance()->curlRedpack(Yii::app()->params['weixinParams']['apiUrl']['redPack'], $param);
        $result = array(
            'status'  => 0,
            'message' => '',
        );
        if ($send['return_code'] == 'SUCCESS') {
            $param = array(
                'user_openid' => $openid,
                'price'       => $price,
                'type'        => 'admin',
                'addtime'     => time(),
                'order_id'    => 0,
                'mch_billno'  => $send['mch_billno'],
                'send_listid' => $send['send_listid'],
                'user_id'     => $user_id,
            );
            RedPackLogModel::getInstance()->insert($param);
            $result['status'] = 1;
        } else {
            $result['message'] = '红包发送失败，失败原因：' . $send['return_msg'];
        }
        echo json_encode($result);
    }

    /**
     * 密码修改 .
     * @return void
     */
    public function actionChangePwd() {
        $updateStatu = array(
            'statu'   => null,
            'message' => '',
        );
        $pwdInfo = array();

        if (Yii::app()->request->isPostRequest) {
            $updateStatu['statu']  = 0;
            $pwdInfo['old_pwd']    = Yii::app()->request->getParam("old_pwd");
            $pwdInfo['new_pwd']    = Yii::app()->request->getParam("new_pwd");
            $pwdInfo['re_new_pwd'] = Yii::app()->request->getParam("re_new_pwd");
            if (strlen($pwdInfo['new_pwd']) < 6 || strlen($pwdInfo['new_pwd']) > 12) {
                $updateStatu['message'] = '必须由英文、数字、特殊字符组成6-12位新密码！';
            } else if ($pwdInfo['new_pwd'] != $pwdInfo['re_new_pwd']) {
                $updateStatu['message'] = '新密码两次输入不一致，请重新输入！';
            } else if (!AdminUserModel::getInstance()->getInfoByLogin(Yii::app()->session['accountInfo']['AccountName'], $pwdInfo['old_pwd'])) {
                $updateStatu['message'] = '旧密码验证失败，请核对后重试！';
            } else if (AdminUserModel::getInstance()->updateUser(array('AccountPassword' => md5($pwdInfo['new_pwd'])), array('and', 'AccountID = ' . Yii::app()->session['accountInfo']['AccountID']))) {
                $updateStatu['statu']   = 1;
                $updateStatu['message'] = '密码更新成功，再次登录时请使用新密码：' . $pwdInfo['new_pwd'];
            } else {
                $updateStatu['message'] = '密码修改失败！';
            }
        }

        $this->render('changePwd', compact('updateStatu', 'pwdInfo'));
    }

    public function actionRelateCard() {
        $updateStatu = array(
            'statu'   => null,
            'message' => '',
        );
        $id      = Yii::app()->request->getParamInt("id", 0);
        $user_id = !empty($_SESSION['accountInfo']['AccountID']) ? $_SESSION['accountInfo']['AccountID'] : 0;
        if (Yii::app()->request->isPostRequest) {
            $cardNo = Yii::app()->request->getParam("card_no", "");
            if (empty($cardNo)) {
                $updateStatu['statu']   = 0;
                $updateStatu['message'] = '充值卡号必填';
            } else {
                $ret = CardModel::getInstance()->relate($id, $cardNo);
                if (!$ret) {
                    $updateStatu['statu']   = 0;
                    $updateStatu['message'] = '充值失败';
                } else {
                    $updateStatu['statu']   = 1;
                    $updateStatu['message'] = '充值成功';
                }
            }
        }
        $info       = UserModel::getInstance()->getOneByCond(array("and", "id=" . $id, 'user_id=' . $user_id));
        $pluginInfo = UserPluginModel::getInstance()->getOneByCond(array("and", "user_id=" . $id, 'admin_user_id=' . $user_id));
        $this->render("relateCard", compact("info", "pluginInfo", "updateStatu"));
    }

    public function actionModifyExpire() {
        $updateStatu = array(
            'statu'   => null,
            'message' => '',
        );
        $id      = Yii::app()->request->getParamInt("id", 0);
        $user_id = !empty($_SESSION['accountInfo']['AccountID']) ? $_SESSION['accountInfo']['AccountID'] : 0;
        if (Yii::app()->request->isPostRequest) {
            $type  = Yii::app()->request->getParam("type", 0);
            $value = Yii::app()->request->getParam("value", 0);
            if (preg_match("/^[0-9]+$/", $value) && $value > 0) {
                $pluginInfo = UserPluginModel::getInstance()->getOneByCond(array("and", "user_id=" . $id, 'admin_user_id=' . $user_id));
                $upData     = array();
                if ($type == 0) {
                    $newValue              = date("Y-m-d", strtotime("-" . $value . " days", strtotime($pluginInfo['expire_date'])));
                    $upData['expire_date'] = $newValue;
                } else {
                    $newValue                  = $pluginInfo['available_times'] - $value > 0 ? $pluginInfo['available_times'] - $value : 0;
                    $upData['available_times'] = $newValue;
                }
                $ret = UserPluginModel::getInstance()->update($upData, array("and", "user_id=" . $id, 'admin_user_id=' . $user_id));
                if ($ret !== false) {
                    if ($type == 0) {
                        $logData = array("user_id" => $id, "type" => $type, "old" => $pluginInfo['expire_date'], "new" => $newValue);
                    } else {
                        $logData = array("user_id" => $id, "type" => $type, "old" => $pluginInfo['available_times'], "new" => $newValue);
                    }
                    $logData['admin_user_id'] = $user_id;
                    Helper::logToFile(BASE_PATH . '/logs/modifyExpire.log', json_encode($logData));
                    $updateStatu = array(
                        'statu'   => 1,
                        'message' => '扣减成功',
                    );
                } else {
                    $updateStatu = array(
                        'statu'   => 0,
                        'message' => '扣减失败',
                    );
                }
            } else {
                $updateStatu = array(
                    'statu'   => 0,
                    'message' => '扣减值必须是大于0的整数',
                );
            }
        }
        $info       = UserModel::getInstance()->getOneByCond(array("and", "id=" . $id, 'user_id=' . $user_id));
        $pluginInfo = UserPluginModel::getInstance()->getOneByCond(array("and", "user_id=" . $id, 'admin_user_id=' . $user_id));
        $this->render("modifyExpire", compact("info", "pluginInfo", "updateStatu"));
    }

    public function actionAjaxReflushTime() {
        $updateStatu = array(
            'statu'   => 0,
            'message' => '',
        );
        if (Yii::app()->request->isPostRequest) {
            $uid  = Yii::app()->request->getParamInt("uid", 0);
            $cond = array(
                'and',
                'user_id=' . $uid,
                'order_type="card"',
                'pay_status>0',
            );
            $order = OrderModel::getInstance()->getListByCond($cond, 'id asc', 'pay_time,target_id');
            $cond  = array(
                'and',
                'user_id=' . $uid,
            );
            $param = array(
                'expire_date' => 0,
            );
            if (UserPluginModel::getInstance()->update($param, $cond) === false) {
                $updateStatu['message'] = '用户日期清空失败!';
                echo json_encode($updateStatu);
            }
            $expireDate = 0;
            foreach ($order as $val) {
                $card = CardModel::getInstance()->getTmplateByCardNumber($val['target_id']);
                if ($card) {
                    $cardValue  = $card['card_value'];
                    $expireDate = $expireDate ? ($expireDate + $cardValue * 3600 * 24) : ($val['pay_time'] + $cardValue * 3600 * 24);
                }
            }
            $cond = array(
                'and',
                'user_id=' . $uid,
            );
            $param = array(
                'expire_date' => date('Y-m-d', $expireDate),
            );
            if (UserPluginModel::getInstance()->update($param, $cond) === false) {
                $updateStatu['message'] = '用户日期更新失败!';
                echo json_encode($updateStatu);
            }
        }
        $updateStatu['status']  = 1;
        $updateStatu['message'] = '用户日期更新成功!';
        echo json_encode($updateStatu);
    }

}
