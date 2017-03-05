<?php
/**
 * 分类api入口类
 *
 * @author cupid <1162510775@qq.com>
 */

/**
 * 入口类.
 */
class ProductApiController extends BaseController {
    public function actionProductList(){
        $categoryId = Yii::app()->request->getParam('category_id');
        $data = array(
            1 => array(
                "product_id" => 1,
                "product_name" => "产品名测试",
                "price" => "21.00",
                "market_price" => "23.00",
                "remark" => "描述",
                "image_url" => "http://www.turnreal.net/upload/upload/imgcontent/day_120410/20120410062819.jpg",
                "types" => "types",
                "create_at" => "create_at",
                "update_at" => "update_at"
            ),
            2 => array(
                "product_id" => 2,
                "product_name" => "产品名测试",
                "price" => "21.00",
                "market_price" => "23.00",
                "remark" => "描述",
                "image_url" => "http://www.turnreal.net/upload/upload/imgcontent/day_120410/20120410062819.jpg",
                "types" => "types",
                "create_at" => "create_at",
                "update_at" => "update_at"
            )
        );
        $result = array(
            'status' => 1,
            'data' => $data
        );
        $this->responeJson($result);
    }
}