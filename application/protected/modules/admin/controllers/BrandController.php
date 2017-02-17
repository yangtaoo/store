<?php
/**
 * 品牌控制器.
 *
 * @author yangtaoo <1162510775@qq.com>
 */

/**
 * 默认控制器类.
 */
class BrandController extends CController
{
    public function actionIndex(){
        $pageSizeConfig = array(
            10 => 10,
            20 => 20,
            50 => 50,
            100 => 100
        );
        $page = Yii::app()->request->getParamInt("page", 1);
        $pageSize = Yii::app()->request->getParamInt("pageSize", 10);
        $pageSize = isset($pageSizeConfig[$pageSize]) ? $pageSize : 10;
        $keyWords = Yii::app()->request->getParam("keyWords");
        $cond = array();
        if(!empty($keyWords)){
            $cond = array(
                'or',
                'brand_name like "%'.$keyWords.'%"',
            );
        }
        $list = BrandModel::getInstance()->getPageList($page, $pageSize, $cond, 'brand_id desc');
        $this->render('index', compact('list','pageSizeConfig', 'pageSize', 'keyWords'));
    }
    
    /**
     * 产品新增
     */
    public function actionAdd(){
        $status = array(
            'status' => null,
            'message' => ''
        );
        $param = array(
            'brand_name' => '',
            'brand_logo' => '',
            'brand_info' => '',
        );
        $id = Yii::app()->request->getParam('id', 0);
        if($id){
            $param = BrandModel::getInstance()->getOneByCond(array('and', 'brand_id = "' . $id . '"'));
        }
        if (Yii::app()->request->isPostRequest) {
            $param = array(
                'brand_name' => trim(Yii::app()->request->getParam('brand_name', '')),
                'brand_logo' => trim(Yii::app()->request->getParam('brand_logo', '')),
                'brand_info' => trim(Yii::app()->request->getParam('brand_info', '')),
            );
            $status = BrandModel::getInstance()->saveBrand($param, $id);
            if($status['status'] === true){
                $id = $status['brandId'];
                $param = $param = BrandModel::getInstance()->getOneByCond(array('and', 'brand_id = "' . $id . '"'));
            }
        }
        $this->render('add', compact('status', 'param', 'id'));
    }
    
    /**
     * 异步调用删除消息方法
     */
    public function actionAjaxDel(){
        $result = array(
            'status' => 0,
            'message' => ''
        );
        $id = Yii::app()->request->getParam("id", array());
        if(BrandModel::getInstance()->delete(array('and', array('in', 'brand_id', $id))) !== false){
            $result['status'] = 1;
        }else{
            $result['message'] = '删除失败请重试';
        }
        echo json_encode($result);
    }
}