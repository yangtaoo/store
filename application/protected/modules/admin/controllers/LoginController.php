<?php
/**
 * 默认控制器.
 *
 * @author yangtaoo <1162510775@qq.com>
 */

/**
 * 默认控制器类.
 */
class LoginController extends CController {

    /**
     * 默认方法.
     *
     * @return void
     */
    public function actionIndex() {
        $msg  = '';
        $name = $pwd = '';
        if (Yii::app()->request->isPostRequest) {
            $name = Yii::app()->request->getParam("username");
            $pwd  = Yii::app()->request->getParam("password");
            $role = array();

            $info = AdminUserModel::getInstance()->getInfoByLogin($name, $pwd);
            if (isset($info['AccountID']) && !empty($info['AccountID'])) {
                Yii::app()->session['accountInfo'] = $info;
                $this->redirect("/admin");
            } else {
                $msg = '登录失败,用户名或密码错误';
            }
        }
        $this->layout = false;

        $this->render('index', compact("msg", "name", "pwd"));
    }

    public function actionLoginOut() {
        unset(Yii::app()->session['accountInfo']);
        $this->redirect('/admin');
    }

}
