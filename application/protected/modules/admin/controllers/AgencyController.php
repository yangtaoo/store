<?php

class AgencyController extends CController {
    /**
     * 机构列表展示
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
                'phone like "%' . $keyWords . '%"',
                'email like "%' . $keyWords . '%"',
                'responsible like "%' . $keyWords . '%"',
            );
        }
        $list = AgencyModel::getInstance()->getPageList($page, $pageSize, $cond, 'id desc');
        $this->render('index', compact('list', 'pageSizeConfig', 'pageSize', 'keyWords'));
    }
    /**
     * 保存机构信息
     * @return void
     */
    public function actionAdd() {
        $status = array(
            'status'  => null,
            'message' => '',
        );
        $param = array(
            'name'        => '',
            'logo'        => '',
            'intro'       => '',
            'phone'       => '',
            'email'       => '',
            'responsible' => '',
            'status'      => 1,
            'sort'        => 20,
            'province'    => '',
            'city'        => '',
            'area'        => '',
            'address'     => '',
            'account'     => '',
            'agency_type' => 1,
        );
        $id = Yii::app()->request->getParam('id', 0);

        if (Yii::app()->request->isPostRequest) {
            $groupAddr = trim(Yii::app()->request->getParam('groupAddr', array()));
            $addr      = explode('/', $groupAddr);
            $param     = array(
                'name'        => trim(Yii::app()->request->getParam('name', '')),
                'intro'       => trim(Yii::app()->request->getParam('intro', '')),
                'phone'       => trim(Yii::app()->request->getParam('phone', '')),
                'email'       => trim(Yii::app()->request->getParam('email', '')),
                'responsible' => trim(Yii::app()->request->getParam('responsible', '')),
                'status'      => trim(Yii::app()->request->getParam('status', '')),
                'sort'        => trim(Yii::app()->request->getParam('sort', '')),
                'province'    => !empty($addr[0]) ? $addr[0] : '',
                'city'        => !empty($addr[1]) ? $addr[1] : '',
                'area'        => !empty($addr[2]) ? $addr[2] : '',
                'address'     => trim(Yii::app()->request->getParam('address', '')),
                'account'     => trim(Yii::app()->request->getParam('account', '')),
                'agency_type' => trim(Yii::app()->request->getParam('agency_type', '')),
            );
            if (count($addr) < 3) {
                $status['status']  = false;
                $status['message'] = '请输入机构所在地区';
            } else {
                $status = AgencyModel::getInstance()->saveAgency($param, $id);
                if ($status['status'] === true) {
                    $id            = $status['id'];
                    $param['logo'] = $status['img_url'];
                }
            }

        } else {
            if ($id) {
                $model            = AgencyModel::getInstance();
                $param            = $model->getOneByCond(array('and', 'id = "' . $id . '"'));
                $result           = $model->getDb()->select('account')->from('turnreal_agency_info')->where('agency_id=' . $id)->queryRow();
                $param['account'] = $result['account'];
            }
        }
        $this->render('add', compact('status', 'param', 'id'));
    }
    /**
     * ajax删除机构
     */
    public function actionAjaxDel() {
        $id     = Yii::app()->request->getParam('id', array());
        $return = array(
            'status'  => false,
            'message' => '删除失败',
        );
        $model = AgencyModel::getInstance();
        if ($model->delete(array('in', 'id', $id))) {
            $model->getDb()->delete('turnreal_agency_info', array('in', 'agency_id', $id));
            $return['status']  = true;
            $return['message'] = '删除成功';
        }
        echo json_encode($return);
    }
}

?>