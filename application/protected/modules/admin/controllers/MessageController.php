<?php
/**
 * 用户留言
 */
class MessageController extends CController {
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
                'name like "%' . $keyWords . '%"',
                'phone like "%' . $keyWords . '%"',
            );
        }
        $list    = MessageModel::getInstance()->getPageList($page, $pageSize, $cond, 'id desc');
        $userIds = array();
        foreach ($list['data'] as $k => $v) {
            $userIds[] = $v['id'];
        }
        $this->render('index', compact('list', 'pageSizeConfig', 'pageSize', 'keyWords'));
    }

    public function actionRemoveMessage() {
        $return = array(
            'status'  => true,
            'message' => '',
        );
        $ids  = Yii::app()->request->getParam('id');
        $ids  = json_decode($ids, true);
        $cond = array('in', 'id', $ids);
        if (!MessageModel::getInstance()->delete($cond)) {
            $return['status']  = false;
            $return['message'] = '操作失败';
        }
        echo json_encode($return);
    }

    public function actionMessageInfo() {
        $id  = Yii::app()->request->getParam('id');
        $db  = BaseModel::getInstance()->getDb();
        $row = $db->select('a.*,b.nickname,b.headimgurl')->from('turnreal_user_message a')->leftJoin('turnreal_users b', 'a.user_id=b.id')->where(array('and', 'a.id="' . $id . '"'))->queryRow();
        MessageModel::getInstance()->update(array('status' => 1), array('and', 'id="' . $id . '"'));
        $this->render('messageInfo', compact('row'));
    }
}
?>