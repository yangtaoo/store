<?php

class AuctionGoodsController extends CController {
    /**
     * 拍品主页列表
     * @return void
     */
    public function actionIndex() {
        $pageSizeConfig = Yii::app()->params['pageConfig'];
        $page           = Yii::app()->request->getParamInt("page", 1);
        $pageSize       = Yii::app()->request->getParamInt("pageSize", 10);
        $pageSize       = isset($pageSizeConfig[$pageSize]) ? $pageSize : 10;
        $keyWords       = Yii::app()->request->getParam("keyWords");

        $cond = array();
        if (!empty($keyWords)) {
            $cond = array(
                'or',
                'agency_name like "%' . $keyWords . '%"',
                'name like "%' . $keyWords . '%"',
                'decade like "%' . $keyWords . '%"',
            );
        }
        $list = AuctionGoodsModel::getInstance()->getPageList($page, $pageSize, $cond, 'id desc');
        $this->render('index', compact('list', 'pageSizeConfig', 'pageSize', 'keyWords'));
    }
    /**
     * 添加拍品
     * @return void
     */
    public function actionAdd() {
        $status = array(
            'status'  => null,
            'message' => '',
        );
        $param = array(
            'name'        => '',
            'agency_name' => '',
            'intro'       => '',
            'agency_id'   => 0,
            'auction_id'  => 0,
            'category_id' => 0,
            'status'      => 1,
            'img'         => '',
            'decade'      => '',
            'min_price'   => '',
            'max_price'   => '',
            'start_price' => '',
            'sort'        => 20,
            'weight'      => '',
            'details'     => '',
            'size'        => array('long' => '', 'width' => '', 'height' => ''),
            'trade_price' => '',
        );
        $id = Yii::app()->request->getParam('id', 0);

        if (Yii::app()->request->isPostRequest) {
            $param = array(
                'name'        => trim(Yii::app()->request->getParam('name', '')),
                'agency'      => trim(Yii::app()->request->getParam('agency', '')),
                'intro'       => trim(Yii::app()->request->getParam('intro', '')),
                'status'      => trim(Yii::app()->request->getParam('status', '')),
                'auction_id'  => trim(Yii::app()->request->getParam('auction_id', '')),
                'category_id' => trim(Yii::app()->request->getParam('category_id', '')),
                'decade'      => trim(Yii::app()->request->getParam('decade', '')),
                'min_price'   => trim(Yii::app()->request->getParam('min_price', '')),
                'max_price'   => trim(Yii::app()->request->getParam('max_price', '')),
                'start_price' => trim(Yii::app()->request->getParam('start_price', '')),
                'sort'        => trim(Yii::app()->request->getParam('sort', '')),
                'weight'      => trim(Yii::app()->request->getParam('weight', '')),
                'details'     => trim(Yii::app()->request->getParam('details', '')),
                'size'        => Yii::app()->request->getParam('size', ''),
                'img'         => Yii::app()->request->getParam('img', ''),
                'trade_price' => Yii::app()->request->getParam('trade_price', 0),
            );
            if (!$param['category_id']) {
                $status['message'] = '请选择分类<br/>';
            }

            if (!$param['agency']) {
                $status['message']    = '请选择机构<br/>';
                $param['agency_id']   = '';
                $param['agency_name'] = '';
            } else {
                $agency               = explode('/', $param['agency']);
                $param['agency_id']   = $agency[0];
                $param['agency_name'] = $agency[1];
            }
            if (!$status['message']) {
                $status = AuctionGoodsModel::getInstance()->saveAuctionGoods($param, $id);
                if ($status['status'] === true) {
                    $id           = $status['id'];
                    $param['img'] = $status['img_url'];
                }
            } else {
                $status['status'] = false;
            }
        } else {
            if ($id) {
                $model = AuctionGoodsModel::getInstance();
                $cond  = array(
                    'and',
                    'a.id=' . $id,
                );
                $param         = $model->getDb()->from(AuctionGoodsModel::TABLE_NAME . ' a')->leftjoin(AuctionGoodsModel::INFO_TABLE_NAME . ' b', 'a.id=b.auction_goods_id')->where($cond)->queryRow();
                $param['size'] = json_decode($param['size'], true);
            }
        }
        $agency   = AgencyModel::getInstance()->getListByCond();
        $category = $this->getCategory();
        $auction  = AuctionModel::getInstance()->getListByCond();
        $this->render('add', compact('status', 'param', 'id', 'agency', 'category', 'auction'));
    }

    /**
     * 360度图片管理
     */
    public function action360imagesList() {
        $id = Yii::app()->request->getParamInt("id", 0);
        if (!$id) {
            die('param error!');
        }
        $cond = array(
            'and',
            'id = ' . $id,
        );
        $goodsInfo = AuctionGoodsModel::getInstance()->getOneByCond($cond, 'id,auction_id,agency_name,name,img');
        $cond      = array(
            'and',
            'goods_id = ' . $id,
        );
        $list = AuctionGoods360imagesModel::getInstance()->getListByCond($cond, 'sort asc', 'id,image_url,sort');

        $this->render('360imagesList', compact('goodsInfo', 'list'));
    }

    /**
     * 360度图片上传类
     */
    public function action360imagesUpload() {
        $id     = Yii::app()->request->getParamInt('goods_id', 0);
        $result = array(
            'status'  => 0,
            'message' => '',
        );
        if (!$id) {
            $result['message'] = 'params error!';
            $this->jsonResult($result);
        }
        if (!isset($_FILES['fileList']) || empty($_FILES['fileList'])) {
            $result['message'] = 'file can not empty!';
            $this->jsonResult($result);
        }
        $uploadInfo = Helper::uploadImg($_FILES['fileList'], $id);
        $fileName = explode(',', $_FILES['fileList']['name']);
        $sort = intval($fileName[0]);
        if (!$uploadInfo['status']) {
            $result['message'] = 'upload error!';
            $this->jsonResult($result);
        }
        $insertId = AuctionGoods360imagesModel::getInstance()->add360Image($id, $uploadInfo['message'], $sort);
        if (!$insertId) {
            $result['message'] = 'add error!';
            $this->jsonResult($result);
        }
        $result['status']  = 1;
        $result['message'] = $uploadInfo['message'];
        $this->jsonResult($result);
    }

    /**
     * ajax删除360图片
     * @return json
     */
    public function actionAjaxDel360Images() {
        $id     = Yii::app()->request->getParam('id', array());
        $return = array(
            'status'  => false,
            'message' => '删除失败',
        );
        $model = AuctionGoods360imagesModel::getInstance();
        $cond = array('in', 'id', $id);
        $one = $model->getOneByCond($cond,'');
        if ($model->delete(array('in', 'id', $id))) {
            if($one){
                unlink(BASE_PATH . $one['image_url']);
            }
            $return['status']  = true;
            $return['message'] = '删除成功';
        }
        echo json_encode($return);
    }

    /**
     * 360图片调序
     * @return json
     */
    public function actionChange360ImageSort() {
        $id      = Yii::app()->request->getParamInt('id', 0);
        $goodsId = Yii::app()->request->getParamInt('goods_id', 0);
        $type    = Yii::app()->request->getParam('type', array());
        $return  = array(
            'status'  => false,
            'message' => '操作失败',
        );
        if (!$id || !$goodsId) {
            $return['message'] = '参数错误';
            $this->jsonResult($return);
        }
        $result = AuctionGoods360imagesModel::getInstance()->change360ImageSort($goodsId, $id, $type);
        if ($result['status']) {
            $return['status']  = true;
            $return['message'] = '操作成功';
        } else {
            $return['message'] = $result['message'];
        }
        echo json_encode($return);
    }

    private function jsonResult($data) {
        echo json_encode($data);
        exit;
    }

    /**
     * 添加拍品获取分类
     * @return json
     */
    private function getCategory() {
        $topNode = array(
            'id'   => 0,
            'name' => '请选择',
            'pid'  => '',
        );
        $rows = CategoryModel::getInstance()->getCategory();
        array_unshift($rows, $topNode);
        return json_encode($rows);
    }

    /**
     * ajax删除拍品
     * @return json
     */
    public function actionAjaxDel() {
        $id     = Yii::app()->request->getParam('id', array());
        $return = array(
            'status'  => false,
            'message' => '删除失败',
        );
        $model = AuctionGoodsModel::getInstance();
        $db    = Yii::app()->db;
        $db    = $db->beginTransaction();
        if ($model->delete(array('in', 'id', $id))) {
            if ($model->getDb()->delete($model::INFO_TABLE_NAME, array('in', 'auction_goods_id', $id)) !== false) {
                $db->commit();
                $return['status']  = true;
                $return['message'] = '删除成功';
            } else {
                $db->rollback();
            }
        }
        echo json_encode($return);
    }
}

?>
