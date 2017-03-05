<?php
/**
 * 产品api入口类
 *
 * @author cupid <1162510775@qq.com>
 */

/**
 * 入口类.
 */
class CategoryApiController extends BaseController {
    
    /**
     * 分类api
     */
    public function actionCategoryList(){
        $data = array(
            1 => array(
                "category_id" => 1,
                "category_name" => "酒水饮料",
            ),
            2 => array(
                "category_id" => 2,
                "category_name" => "食品干货",
            )
        );
        $this->responeJson($data);
    }
    
}