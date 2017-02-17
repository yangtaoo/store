<?php

/**
 * 网站留言类.
 *
 * @author yangtaoo <1162510775@qq.com>
 */
class MessageModel extends BaseModel {

    const TABLE_NAME = 'turnreal_user_message';

    /**
     * 获取网站留言列表
     *
     * @param integer $page     页码.
     * @param integer $pageSize 每页数.
     * @param array   $cond     条件.
     *
     * @return array .
     */
    public function getMessageList($page, $pageSize, $cond = array()) {
        $result            = array();
        $start             = ($page - 1) * $pageSize;
        $start             = $start < 0 ? 0 : $start;
        $result['data']    = $this->getDb()->select("m.*,u.nickname,u.headimgurl")->from(self::TABLE_NAME . ' as m')->leftJoin(UserModel::TABLE_NAME . ' as u', 'm.user_id = u.id')->where($cond)->order('m.id desc')->limit($pageSize, $start)->queryAll();
        $cnt               = $this->getDb()->select("count(1) as cnt")->from(self::TABLE_NAME . ' as m')->leftJoin(UserModel::TABLE_NAME . ' as u', 'm.user_id = u.id')->where($cond)->queryRow();
        $result['pageStr'] = Helper::creagePageBar($page, $pageSize, $cnt['cnt']);
        return $result;
    }

    /**
     * 获取单条留言信息.
     *
     * @param integer $id 消息ID .
     *
     * @return array 消息内容.
     */
    public function getMessageOne($id) {
        return $this->getDb()->select("m.*,u.nickname,u.headimgurl")->from(self::TABLE_NAME . ' as m')->leftJoin(UserModel::TABLE_NAME . ' as u', 'm.user_id = u.id')->where(array('and', 'm.id = ' . $id))->queryRow();
    }

    /**
     * 返回未读消息条数
     *
     * @return integer 未读消息条数.
     */
    public function getNotReadMessageNum() {
        $cnt = $this->getDb()->select("count(1) as cnt")->from(self::TABLE_NAME)->where(array('and', 'status = 0'))->queryRow();
        return $cnt['cnt'];
    }

    /**
     * 消息删除方法
     * @param array $ids 消息ID数组 .
     *
     * @return boolean.
     */
    public function delMessage($ids) {
        return $this->getDb()->delete(self::TABLE_NAME, array('and', array('in', 'id', $ids)));
    }
}
