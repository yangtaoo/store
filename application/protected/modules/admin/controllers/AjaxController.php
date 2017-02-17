<?php
/**
 * 默认控制器.
 *
 * @author yangtaoo <1162510775@qq.com>
 */

/**
 * 默认控制器类.
 */
class AjaxController extends CController
{

    /**
     * 默认方法.
     *
     * @return void
     */
    public function actionGetMenu()
    {
        $type = Yii::app()->request->getPost("type");
        echo MenuModel::getInstance()->getChildMenu($type);
    }

}
