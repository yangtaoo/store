<?php
/**
 * Distributor Module 初始化文件.
 *
 * @author Yao Jian <1400310011@qq.com>
 */

/**
 * Distributor Module初始化类.
 */
class AdminModule extends CWebModule {
    /**
     * assetUrl定义.
     *
     * @var string
     */
    private $_assetsUrl;
    /**
     * 初始化方法.
     *
     * @return void
     */
    public function init() {
        $this->setImport(
            array(
                'admin.models.*',
                'admin.components.*',
            )
        );
    }

    /**
     * 操作前执行内容.
     *
     * @param string $controller 控制器.
     * @param string $action     方法.
     *
     * @return bool 执行成功或失败.
     */
    public function beforeControllerAction($controller, $action) {
        if ('/admin/api/userremind' == strtolower($_SERVER['REQUEST_URI'])) {
            return true;
        }
        Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.admin.assets'));
        $notInArrController = array(
            'login' => 1,
        );
        if ((!Yii::app()->session['accountInfo'])) {
            if (!isset($notInArrController[strtolower($controller->getId())])) {
                header("Location: /admin/login");
                exit;
            }
        } else {
            //权限判断
            $AccountID = Yii::app()->session['accountInfo']['AccountID'];
            $path      = strtolower($controller->getId() . '/' . $action->getId());

//            $nowPromission = PromissionModel::getInstance()->getPromissionByAccountID($AccountID);
            //            $passPath = array(
            //                'default/index' => 1,
            //                'ajax/getmenu' => 1,
            //                'login/loginout' => 1
            //            );
            //            if(!isset($nowPromission[$path]) && !isset($passPath[$path])){
            //                echo 'Permission denied';
            //                exit;
            //            }
        }

        $notLayoutsInArrController = array(
            'login' => 1,
        );
        if (!isset($notLayoutsInArrController[strtolower($controller->getId())])) {
            $this->layout = 'admin.views.layouts.admin';
        }
        if (parent::beforeControllerAction($controller, $action)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 返回Asset的URL路径.
     *
     * @return string Url
     */
    public function getAssetsUrl() {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.admin.assets'), false, -1, YII_DEBUG);
        }

        return $this->_assetsUrl;
    }

    /**
     * 设置Asset的URL路径.
     *
     * @param string $value 路径.
     *
     * @return bool.
     */
    public function setAssetsUrl($value) {
        $this->_assetsUrl = $value;
        return true;
    }

}
