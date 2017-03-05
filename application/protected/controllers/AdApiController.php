<?php
/**
 * 广告api入口类
 *
 * @author cupid <1162510775@qq.com>
 */

/**
 * 入口类.
 */
class AdApiController extends BaseController {
    public function actionAdList(){
        $adType = Yii::app()->request->getParam('ad_type');
        $data = array(
            1 => array(
                "ad_id" => 1,
                "image_url" => "http://www.turnreal.net/upload/upload/imgcontent/day_120410/20120410062819.jpg",
                "link" => "http://www.turnreal.net"
            ),
            2 => array(
                "ad_id" => 2,
                "image_url" => "http://www.turnreal.net/upload/upload/imgcontent/day_120410/20120410062819.jpg",
                "link" => "http://www.turnreal.net"
            )
        );
        $this->responeJson($data);
    }
}