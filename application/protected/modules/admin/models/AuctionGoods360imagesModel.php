<?php

class AuctionGoods360imagesModel extends BaseModel {

    const TABLE_NAME      = 'turnreal_auction_goods_360images';
    
    /**
     * 为拍品增加360图片
     * 
     * @param integer $goodsId  拍品ID .
     * @param string  $imageUrl 图片地址 .
     * 
     * @return boolean 
     */
    public function add360Image($goodsId, $imageUrl, $sort = 0){
        $cond = array(
            'and',
            'goods_id=' . $goodsId,
            'sort=' . $sort
        );
        $sortOne = $this->getOneByCond($cond);
        if($sortOne){
            unset($cond['sort=']);
            $lastOne = $this->getOneByCond($cond, 'sort', 'sort desc');
            $sort = 0;
            if($lastOne){
                $sort = $lastOne['sort'] + 1;
            }
        }
        $param = array(
            'goods_id' => $goodsId,
            'image_url' => $imageUrl,
            'sort' => $sort
        );
        $insertId = $this->insert($param);
        return $insertId;
    }
    
    /**
     * 360图片调序
     * @param integer $goodsId 拍品id .
     * @param integer $id      图片id .
     * @param string  $type    调序类型 up/down .
     */
    public function change360ImageSort($goodsId, $id, $type) {
        $cond = array(
            'and',
            'goods_id=' . $goodsId
        );
        $imageList = $this->getListByCond($cond, 'sort asc', 'id,sort');
        $beforeOne = $afterOne = $nowOne = array();
        foreach ($imageList as $val) {
            if ($nowOne) {
                $afterOne = $val;
                break;
            }
            if ($val['id'] == $id) {
                $nowOne = $val;
            } else {
                $beforeOne = $val;
            }
        }

        $result = array(
            'status' => 0,
            'message' => '操作失败'
        );
        $db = Yii::app()->db;
        $transaction = $db->beginTransaction();
        if ($type == 'up') {
            if (empty($beforeOne)) {
                $result['message'] = '当前图片已在第一位，不能再前移';
                $transaction->commit();
                return $result;
            }
            $cond = array(
                'and',
                'id=' . $id
            );
            $param = array(
                'sort' => $beforeOne['sort']
            );
            if($db->createCommand()->update(self::TABLE_NAME, $param, $cond) === false){
                $transaction->rollback();
                $result['message'] = '操作失败';
                return $result;
            }
            if($beforeOne['sort'] == $nowOne['sort']){//兼容异常数据
                $cond = array(
                    'and',
                    'goods_id=' . $goodsId,
                    'sort > ' . $nowOne['sort']
                );
                $param = array(
                    'sort' => new CDbExpression('sort+1')
                );
                if($db->createCommand()->update(self::TABLE_NAME, $param, $cond) === false){
                    $transaction->rollback();
                    $result['message'] = '操作失败';
                    return $result;
                }
                $nowOne['sort'] += 1;
            }
            $cond = array(
                'and',
                'id=' . $beforeOne['id']
            );
            $param = array(
                'sort' => $nowOne['sort']
            );
            if($db->createCommand()->update(self::TABLE_NAME, $param, $cond) === false){
                $transaction->rollback();
                $result['message'] = '操作失败';
                return $result;
            }
            
        }else{
            if (empty($afterOne)) {
                $result['message'] = '当前图片已在最后一位，不能再后移';
                $transaction->commit();
                return $result;
            }
            $cond = array(
                'and',
                'id=' . $id
            );
            $param = array(
                'sort' => $afterOne['sort']
            );
            if($db->createCommand()->update(self::TABLE_NAME, $param, $cond) === false){
                $transaction->rollback();
                $result['message'] = '操作失败';
                return $result;
            }
            if($afterOne['sort'] == $nowOne['sort']){//兼容异常数据
                $cond = array(
                    'and',
                    'goods_id=' . $goodsId,
                    'sort < ' . $nowOne['sort']
                );
                $param = array(
                    'sort' => new CDbExpression('sort-1')
                );
                if($db->createCommand()->update(self::TABLE_NAME, $param, $cond) === false){
                    $transaction->rollback();
                    $result['message'] = '操作失败';
                    return $result;
                }
                $nowOne['sort'] -= 1;
            }
            $cond = array(
                'and',
                'id=' . $afterOne['id']
            );
            $param = array(
                'sort' => $nowOne['sort']
            );
            if($db->createCommand()->update(self::TABLE_NAME, $param, $cond) === false){
                $transaction->rollback();
                $result['message'] = '操作失败';
                return $result;
            }
        }
        $transaction->commit();
        $result['status'] = 1;
        $result['message'] = '操作成功';
        return $result;
        
    }

}