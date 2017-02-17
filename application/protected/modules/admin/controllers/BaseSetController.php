<?php

/**
 * 基础设置控制器.
 *
 * @author yangtaoo <1162510775@qq.com>
 */

/**
 * 默认控制器类.
 */
class BaseSetController extends CController {

    public function actionIndex() {
        $baseSet     = array();
        $updateStatu = null;

        if (Yii::app()->request->isPostRequest) {
            $baseSet['website_name']        = Yii::app()->request->getParam("website_name");
            $baseSet['website_title']       = Yii::app()->request->getParam("website_title");
            $baseSet['website_keywords']    = Yii::app()->request->getParam("website_keywords");
            $baseSet['website_description'] = Yii::app()->request->getParam("website_description");
            $baseSet['vip_password']        = Yii::app()->request->getParam("vip_password");
            $baseSet['site_introduction']   = Yii::app()->request->getParam("site_introduction");
            if (!empty($_FILES['website_image']['name'])) {
                $upload = Helper::uploadImg($_FILES['website_image'], date('Y-m-d'), 'baseSet');
                if ($upload['status']) {
                    $baseSet['website_image'] = $upload['message'];
                }
            } else {
                $baseSet['website_image'] = Yii::app()->request->getParam('website_img', '');
            }
            $updateStatu = BaseSetModel::getInstance()->setBaseSet($baseSet);
        } else {
            $baseSet = BaseSetModel::getInstance()->getBaseSet();
        }
        $this->render('index', compact('baseSet', 'updateStatu'));
    }
    /**
     * 分享设置
     * @return void
     */
    public function actionShareSet() {
        $param       = array();
        $updateStatu = null;
        if (Yii::app()->request->isPostRequest) {
            $param = array(
                'title'   => Yii::app()->request->getParam('title'),
                'desc'    => Yii::app()->request->getParam('desc'),
                'img_url' => Yii::app()->request->getParam('img_url'),
            );
            if (!empty($_FILES['upload_img']['name'])) {
                $upload = Helper::uploadImg($_FILES['upload_img'], date('Y-m-d'), 'shareSet');
                if ($upload['status']) {
                    $param['img_url'] = 'http://' . $_SERVER['HTTP_HOST'] . $upload['message'];
                }
            }
            $param       = array('share_set' => json_encode($param));
            $updateStatu = BaseSetModel::getInstance()->setBaseSet($param);
        } else {
            $param = BaseSetModel::getInstance()->getBaseSet(array('and', 'name="share_set"'));
        }
        $param = isset($param['share_set']) ? json_decode($param['share_set'], true) : '';
        $this->render('shareSet', compact('param', 'updateStatu'));
    }

    public function actionRedPackSet() {
        $baseSet     = array();
        $updateStatu = null;
        if (Yii::app()->request->isPostRequest) {
            $baseSet['min_price'] = Yii::app()->request->getParam("min_price") * 100;
            $baseSet['max_price'] = Yii::app()->request->getParam("max_price") * 100;
            $baseSet['wishing']   = Yii::app()->request->getParam("wishing");
            $updateStatu          = BaseSetModel::getInstance()->setBaseSet(array('red_pack_set' => json_encode($baseSet)));
        } else {
            $baseSet = BaseSetModel::getInstance()->getBaseSet();
            $baseSet = isset($baseSet['red_pack_set']) ? json_decode($baseSet['red_pack_set'], true) : array();
        }
        $this->render('redPackSet', compact('baseSet', 'updateStatu'));
    }

}
