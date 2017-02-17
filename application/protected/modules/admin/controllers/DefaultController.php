<?php
/**
 * 默认控制器.
 *
 * @author yangtaoo <1162510775@qq.com>
 */

/**
 * 默认控制器类.
 */
class DefaultController extends CController {

    /**
     * 默认方法.
     *
     * @return void
     */
    public function actionIndex() {
        // $userCount     = UserModel::getInstance()->getWeixinUserCount();
        // $messageCount  = UserModel::getInstance()->getMessageCount();
        $userCount         = UserModel::getInstance()->getUserCount();
        $agencyCount       = AgencyModel::getInstance()->getAgencyCount();
        $auctionGoodsCount = AuctionGoodsModel::getInstance()->getGoodsCount();
        $auctionCount      = AuctionModel::getInstance()->getAuctionCount();

        $userCountList = UserModel::getInstance()->getWeixinUserCountList();
        $newUser       = UserModel::getInstance()->getPageList(1, 10, array(), 'id desc');
        $newMessage    = MessageModel::getInstance()->getMessageList(1, 5);

        $this->render('index', compact('userCount', 'agencyCount', 'auctionGoodsCount', 'auctionCount', 'userCountList', 'newUser', 'newMessage'));
    }
    /**
     * 首页轮播图
     * @return void
     */
    public function actionImageList() {
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
        $list     = DefaultModel::getInstance()->getPageList($page, $pageSize, $cond, 'sort asc');
        $this->render('imageList', compact('list', 'pageSizeConfig', 'pageSize', 'keyWords'));
    }
    /**
     * 添加图片
     * @return void
     */
    public function actionImageAdd() {
        $status = array(
            'status'  => null,
            'message' => '',
        );
        $param = array(
            'img_url'  => '',
            'alt'      => '',
            'img_link' => '',
            'sort'     => 20,
            'status'   => 1,
            'intro'    => '',
        );
        $id = Yii::app()->request->getParam('id', 0);

        if (Yii::app()->request->isPostRequest) {
            $param = array(
                'img_url'  => trim(Yii::app()->request->getParam('img_url', '')),
                'alt'      => trim(Yii::app()->request->getParam('alt', '')),
                'img_link' => trim(Yii::app()->request->getParam('img_link', '')),
                'sort'     => trim(Yii::app()->request->getParam('sort', '')),
                'status'   => trim(Yii::app()->request->getParam('status', '')),
                'intro'    => trim(Yii::app()->request->getParam('intro', '')),
            );
            $status = DefaultModel::getInstance()->saveImg($param, $id);
            if ($status['status'] === true) {
                $id               = $status['id'];
                $param['img_url'] = $status['img_url'];
            }
        } else {
            if ($id) {
                $model = DefaultModel::getInstance();
                $param = $model->getOneByCond(array('and', 'id = "' . $id . '"'));
            }
        }
        $this->render('imageAdd', compact('status', 'param', 'id'));
    }
    /**
     * ajax删除数据
     * @return void
     */
    public function actionAjaxDel() {
        $id     = Yii::app()->request->getParam('id', array());
        $return = array(
            'status'  => false,
            'message' => '删除失败',
        );
        $model = DefaultModel::getInstance();
        if ($model->delete(array('in', 'id', $id))) {
            $return['status']  = true;
            $return['message'] = '删除成功';
        }
        echo json_encode($return);
    }

}
