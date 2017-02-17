<?php

class CategoryController extends CController {
    /**
     * 分类主页
     * @return void
     */
    public function actionIndex() {
        $rows = CategoryModel::getInstance()->getCategory();
        $this->render('index', compact('rows'));
    }
    /**
     * 添加分类
     */
    public function actionAdd() {
        $status = array(
            'status'  => null,
            'message' => '',
        );
        $param = array(
            'name'  => '',
            'intro' => '',
            'sort'  => 20,
        );
        $id = Yii::app()->request->getParam('id', 0);
        if ($id) {
            $param = CategoryModel::getInstance()->getOneByCond(array('and', 'id = "' . $id . '"'));
        }
        if (Yii::app()->request->isPostRequest) {
            $param = array(
                'name'          => trim(Yii::app()->request->getParam('name', '')),
                'intro'         => trim(Yii::app()->request->getParam('intro', '')),
                'pid'           => trim(Yii::app()->request->getParam('pid', '')),
                'status'        => trim(Yii::app()->request->getParam('status', '')),
                'list_img'      => trim(Yii::app()->request->getParam('list_img', '')),
                'tags_img'      => trim(Yii::app()->request->getParam('tags_img', '')),
                'home_list_img' => trim(Yii::app()->request->getParam('home_list_img', '')),
                'sort'          => trim(Yii::app()->request->getParam('sort', '')),
            );
            $status = CategoryModel::getInstance()->saveCategory($param, $id);
            if ($status['status'] === true) {
                $id    = $status['id'];
                $param = CategoryModel::getInstance()->getOneByCond(array('and', 'id = "' . $id . '"'));
            }
        }
        $rows = $this->_before_view();
        $this->render('add', compact('status', 'param', 'id', 'rows'));
    }

    private function _before_view() {
        $rows    = CategoryModel::getInstance()->getCategory();
        $topNode = array(
            'id'   => 0,
            'name' => '请选择',
            'pid'  => '',
        );
        array_unshift($rows, $topNode);
        return json_encode($rows);
    }
    /**
     * ajax删除分类
     * @return void
     */
    public function actionAjaxDel() {
        $return = array(
            'status'  => true,
            'message' => '删除失败',
        );
        $id = Yii::app()->request->getParam("id", '');
        if (!CategoryModel::getInstance()->deleteCategory($id)) {
            $return['status']  = false;
            $return['message'] = '删除失败';
        }
        echo json_encode($return);
    }
}

?>