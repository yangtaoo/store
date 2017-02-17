<?php
/**
 * 产品api入口类
 *
 * @author cupid <1162510775@qq.com>
 */

/**
 * 入口类.
 */
class ProductApiController extends BaseController {
    public function productList(){
        $data = array(
            array(
                "_id" => 1,
                "name" => "产品名测试",
                "price" => "21.00",
                "remark" => "描述",
                "images" => "http://www.turnreal.net/upload/upload/imgcontent/day_120410/20120410062819.jpg",
                "types" => "types",
                "create_at" => "create_at",
                "update_at" => "update_at"
            )
        );
        $this->responeJson($data);
    }
}