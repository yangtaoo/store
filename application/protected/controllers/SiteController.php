<?php
/**
 * 默认入口类
 *
 * @author cupid <1162510775@qq.com>
 */

/**
 * 默认入口类.
 */
class SiteController extends BaseController {

    /**
     * 默认方法.
     *
     * @return void
     */
    public function actionIndex() {
        $tagsGoods   = AuctionGoodsModel::getInstance()->getTagsGoods();
        $userConcern = UserConcernModel::getInstance()->getConcernList(1);
        $homeImg     = DefaultModel::getInstance()->getListByCond(array('and', 'status=1'), 'sort asc', 'img_url,alt,img_link', 6);
        $category    = CategoryModel::getInstance()->getListByCond(array('and', 'level=1', 'status=1'), 'sort asc', 'id,name,tags_img', 4);
        $agencyNum   = AgencyModel::getInstance()->getOneByCond(array('and', 'status = 1'), 'count(1) as cnt');
        $model       = AgencyModel::getInstance();
        $agencys     = $model->getListByCond(array('and', 'status = 1'), 'sort asc', 'id,name,logo', 3);
        foreach ($agencys as &$val) {
            $result       = $model->getDb()->select('count(id) cont')->from('turnreal_auction_goods')->where(array('and', 'status=1', 'agency_id=' . $val['id']))->queryRow();
            $val['count'] = $result['cont'];
        }
        $categoryGoodsList = AuctionGoodsModel::getInstance()->getCategoryGoodsList();
        $this->render('index', compact('category', 'agencyNum', 'agencys', 'categoryGoodsList', 'homeImg', 'userConcern', 'tagsGoods'));
    }
}
