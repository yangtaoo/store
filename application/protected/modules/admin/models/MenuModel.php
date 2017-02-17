<?php
/**
 * 菜单类.
 *
 * @author yangtaoo <1162510775@qq.com>
 */

class MenuModel extends BaseModel {

    public $childMenu = array(
        array(
            'name'      => '首页',
            'url'       => '/admin',
            'countName' => '',
        ),
        array(
            'name'      => '基础设置',
            'url'       => '/admin/baseSet/index',
            'countName' => '',
        ),
        array(
            'name'      => '用户管理',
            'url'       => '/admin/User/index',
            'countName' => '',
        ),

        array(
            'name'      => '分类管理',
            'url'       => '/admin/category/index',
            'countName' => '',

        ),
        array(
            'name'      => '机构管理',
            'url'       => '/admin/agency/index',
            'countName' => '',

        ),
        array(
            'name'      => '拍卖会管理',
            'url'       => '/admin/auction/index',
            'countName' => '',

        ),
        array(
            'name'      => '拍品管理',
            'url'       => '/admin/AuctionGoods/index',
            'countName' => '',

        ),
        array(
            'name'      => '分享设置',
            'url'       => '/admin/BaseSet/shareSet',
            'countName' => '',
        ),
        array(
            'name'      => '首页轮播图',
            'url'       => '/admin/Default/imageList',
            'countName' => '',
        ),
        array(
            'name'      => '搜索热门设置',
            'url'       => '/admin/Tags/index',
            'countName' => '',
        ),
    );

    /**
     * 返回json数据
     * @param type $data
     *
     * @return json
     */
    public function jsonData($data) {
        return json_encode($data);
    }

}