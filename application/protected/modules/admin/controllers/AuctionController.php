<?php

class AuctionController extends CController {
    /**
     * 拍品会主页列表
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
                'name like "%' . $keyWords . '%"',
                'agency_name like "%' . $keyWords . '%"',
            );
        }
        $list = AuctionModel::getInstance()->getPageList($page, $pageSize, $cond, 'id desc');
        $this->render('index', compact('list', 'pageSizeConfig', 'pageSize', 'keyWords'));
    }
    /**
     * 保存拍品会信息
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
            'start_time'  => '',
            'end_time'    => '',
            'auction_img' => '',
            'status'      => 1,
            'agency_id'   => '',
            'province'    => '',
            'city'        => '',
            'area'        => '',
            'address'     => '',
        );
        $id = Yii::app()->request->getParam('id', 0);

        if (Yii::app()->request->isPostRequest) {
            $groupAddr = trim(Yii::app()->request->getParam('groupAddr', array()));
            $addr      = explode('/', $groupAddr);
            $param     = array(
                'name'        => trim(Yii::app()->request->getParam('name', '')),
                'intro'       => trim(Yii::app()->request->getParam('intro', '')),
                'status'      => trim(Yii::app()->request->getParam('status', '')),
                'start_time'  => trim(Yii::app()->request->getParam('start_time', '')),
                'end_time'    => trim(Yii::app()->request->getParam('end_time', '')),
                'province'    => !empty($addr[0]) ? $addr[0] : '',
                'city'        => !empty($addr[1]) ? $addr[1] : '',
                'area'        => !empty($addr[2]) ? $addr[2] : '',
                'address'     => trim(Yii::app()->request->getParam('address', '')),
                'auction_img' => trim(Yii::app()->request->getParam('auction_img', '')),
            );
            $param['start_time'] = strtotime($param['start_time']);
            $param['end_time']   = strtotime($param['end_time']);
            $agency              = Yii::app()->request->getParam('agency', '');
            if ($agency) {
                $agency               = explode('/', $agency);
                $param['agency_id']   = $agency[0];
                $param['agency_name'] = $agency[1];
                if (count($addr) < 3) {
                    $status['status']  = false;
                    $status['message'] = '请录入拍卖地址';
                } else {
                    $status = AuctionModel::getInstance()->saveAuction($param, $id);
                    if ($status['status'] === true) {
                        $id                   = $status['id'];
                        $param['auction_img'] = $status['img_url'];
                    }
                }
            } else {
                $status['status']  = false;
                $status['message'] = '请选择所属机构';
            }

        } else {
            if ($id) {
                $model = AuctionModel::getInstance();
                $param = $model->getOneByCond(array('and', 'id = "' . $id . '"'));
            }
        }
        $agency = $this->_get_agency();
        $this->render('add', compact('status', 'param', 'id', 'agency'));
    }
    /**
     * 获取所有机构
     * @return [type] [description]
     */
    private function _get_agency() {
        $rows = AgencyModel::getInstance()->getListByCond(array(), 'id desc', 'id,name');
        return $rows ?: array();
    }
    /**
     * ajax删除根据id删除数据
     * @return void
     */
    public function actionAjaxDel() {
        $id     = Yii::app()->request->getParam('id', array());
        $return = array(
            'status'  => false,
            'message' => '刪除失败',
        );
        if (AuctionModel::getInstance()->delete(array('in', 'id', $id))) {
            $return['status']  = true;
            $return['message'] = '删除成功';
        }
        echo json_encode($return);
    }
}

?>