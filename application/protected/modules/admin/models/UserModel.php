<?php

/**
 * 用户类.
 *
 * @author yangtaoo <1162510775@qq.com>
 */
class UserModel extends BaseModel {

    const TABLE_NAME = 'turnreal_users';

    public function getWeixinUserCount() {
        $cache = BaseSetModel::getInstance()->getBaseSet();
        if (isset($cache['userCount'])) {
            $userCount = json_decode($cache['userCount'], true);
            if ($userCount['date'] == date('Y-m-d')) {
                return $userCount['data'];
            }
        }
        $result = array(
            'newUser'    => 0,
            'cancelUser' => 0,
            'oldUser'    => 0,
        );
        $token = $this->getAccessToken();
        if (!$token) {
            return $result;
        }

        $url   = Yii::app()->params['weixinParams']['apiUrl']['getusersummary'] . '?access_token=' . $token;
        $param = array(
            'begin_date' => date('Y-m-d', strtotime('-2 day')),
            'end_date'   => date("Y-m-d", strtotime('-1 day')),
        );
        $param = json_encode($param);

        $newUser = CurlApiModel::getInstance()->crulWeixin($url, 1, $param);
        if (!$newUser || !isset($newUser['list'])) {
            return $result;
        }
        foreach ($newUser['list'] as $val) {
            $result['newUser'] += $val['new_user'];
            $result['cancelUser'] += $val['cancel_user'];
        }

        $url     = Yii::app()->params['weixinParams']['apiUrl']['getusercumulate'] . '?access_token=' . $token;
        $oldUser = CurlApiModel::getInstance()->crulWeixin($url, 1, $param);
        if (!$oldUser) {
            return $result;
        }
        foreach ($oldUser['list'] as $val) {
            $result['oldUser'] += $val['cumulate_user'];
        }
        $userCount['date'] = date('Y-m-d');
        $userCount['data'] = $result;
        BaseSetModel::getInstance()->setBaseSet(array('userCount' => json_encode($userCount)));
        return $result;
    }

    public function getMessageCount() {
        $result = array(
            'newMessage' => 0,
            'allMessage' => 0,
        );
        $cnt                  = $this->getDb()->select("count(1) as cnt")->from(MessageModel::TABLE_NAME)->where(array('and', 'status = 0'))->queryRow();
        $result['newMessage'] = $cnt['cnt'];
        $cnt                  = $this->getDb()->select("count(1) as cnt")->from(MessageModel::TABLE_NAME)->queryRow();
        $result['allMessage'] = $cnt['cnt'];
        return $result;
    }

    public function getWeixinUserCountList() {
        $cache = BaseSetModel::getInstance()->getBaseSet();
        if (isset($cache['userCountList'])) {
            $userCountList = json_decode($cache['userCountList'], true);
            if ($userCountList['date'] == date('Y-m-d')) {
                return $userCountList['data'];
            }
        }
        $result = array(
            'newUser' => array(),
            'oldUser' => array(),
        );
        $token = $this->getAccessToken();
        if (!$token) {
            return $result;
        }

        $url   = Yii::app()->params['weixinParams']['apiUrl']['getusersummary'] . '?access_token=' . $token;
        $param = array(
            'begin_date' => date('Y-m-d', strtotime('-7 day')),
            'end_date'   => date("Y-m-d", strtotime('-1 day')),
        );
        $param = json_encode($param);

        $data    = CurlApiModel::getInstance()->crulWeixin($url, 1, $param);
        $newUser = array();
        if (!isset($data['list'])) {
            return $result;
        }
        foreach ($data['list'] as $val) {
            if (isset($newUser[$val['ref_date']])) {
                $newUser[$val['ref_date']]['new_user'] += $val['new_user'];
                $newUser[$val['ref_date']]['cancel_user'] += $val['cancel_user'];
            } else {
                $newUser[$val['ref_date']]['new_user']    = $val['new_user'];
                $newUser[$val['ref_date']]['cancel_user'] = $val['cancel_user'];
            }
        }

        $url     = Yii::app()->params['weixinParams']['apiUrl']['getusercumulate'] . '?access_token=' . $token;
        $data    = CurlApiModel::getInstance()->crulWeixin($url, 1, $param);
        $oldUser = array();
        foreach ($data['list'] as $val) {
            if (isset($oldUser[$val['ref_date']])) {
                $oldUser[$val['ref_date']] += $val['cumulate_user'];
            } else {
                $oldUser[$val['ref_date']] = $val['cumulate_user'];
            }
        }
        $result['oldUser'] = $oldUser;
        $result['newUser'] = $newUser;

        $userCountList['date'] = date('Y-m-d');
        $userCountList['data'] = $result;
        BaseSetModel::getInstance()->setBaseSet(array('userCountList' => json_encode($userCountList)));
        return $result;
    }

    public function getUserCount() {
        $row = $this->getOneByCond(array(), 'count(1) cut');
        return $row['cut'];
    }
}
