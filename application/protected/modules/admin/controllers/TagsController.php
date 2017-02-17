<?php
/**
 * 搜索热门
 */
class TagsController extends CController {

    public function actionIndex() {
        $tagsSet     = array();
        $updateStatu = null;

        if (Yii::app()->request->isPostRequest) {
            $tagsSet['home_tags_tag']   = Yii::app()->request->getParam("home_tags_tag");
            $tagsSet['agency_tags_tag'] = Yii::app()->request->getParam("agency_tags_tag");
            $updateStatu                = BaseSetModel::getInstance()->setBaseSet($tagsSet);
        } else {
            $tagsSet = BaseSetModel::getInstance()->getBaseSet();
        }
        $this->render('index', compact('updateStatu', 'tagsSet'));
    }
}

?>