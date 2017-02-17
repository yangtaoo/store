<?php

class ApiController extends CController {
    /**
     * 执行拍卖会即将开始之前推送关注用户
     * @return void
     */
    public function actionUserRemind() {
        $time         = time();
        $str          = md5('123456');
        $requestCheck = Yii::app()->request->getParam('requestCheck');
        if ($str != $requestCheck) {
            echo 'request error';
            exit();
        }
        $cond = array(
            'and',
            'status=1',
            'end_time>' . $time,
        );

        $result = AuctionModel::getInstance()->getListByCond($cond, 'id', 'id,name,start_time');
        $model  = BaseModel::getInstance();
        foreach ($result as $val) {
            $openids = array();
            if (($val['start_time'] - $time) < (3600 * 24 * 3)) {
                $openid = array();
                $rows   = $model->getDb()->select('b.id,b.openid')->from('turnreal_user_concern a')->leftJoin('turnreal_users b', 'a.user_id=b.id')->where(array('and', 'a.concern_type=2', 'a.object_id=' . $val['id']))->queryAll();
                foreach ($rows as $val1) {
                    $openid[]  = $val1['openid'];
                    $openids[] = $val1['openid'];
                }
                //根据openid推送消息给用户

                $goodsId = AuctionGoodsModel::getInstance()->getListByCond(array('and', 'status=1', 'auction_id=' . $val['id']), 'id', 'id,name');
                foreach ($goodsId as $val2) {
                    $rows    = $model->getDb()->select('b.id,b.openid')->from('turnreal_user_concern a')->leftJoin('turnreal_users b', 'a.user_id=b.id')->where(array('and', 'a.concern_type=1', 'a.object_id=' . $val2['id']))->queryAll();
                    $openid1 = array();
                    foreach ($rows as $val3) {
                        if (!in_array($val3['openid'], $openids)) {
                            $openid1[] = $val3['openid'];
                            $openids[] = $val3['openid'];
                        }
                    }
                    //根据openid推送消息给用户
                    var_dump($openid1);exit();
                }
            }
        }
    }
}

?>