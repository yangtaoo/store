<?php

class AuctionGoodsModel extends BaseModel {

    const TABLE_NAME      = 'turnreal_auction_goods';
    const INFO_TABLE_NAME = 'turnreal_auction_goods_info';
    /**
     * 保存拍品信息
     * @return boolean
     */
    public function saveAuctionGoods($param, $id) {
        $status = array(
            'status'  => false,
            'message' => '',
            'id'      => $id,
            'img_url' => '',
        );
        $data = array(
            'size'    => json_encode($param['size']),
            'weight'  => $param['weight'],
            'details' => $param['details'],
        );
        unset($param['size'], $param['weight'], $param['details'], $param['agency']);
        if (!empty($_FILES['upload_img']['tmp_name'])) {
            list($width, $height) = getimagesize($_FILES['upload_img']['tmp_name']);
            if (!($width == 290 && $height == 290)) {
                $status['message'] = '图片尺寸为290*290';
                return $status;
            }
            $upload = Helper::uploadImg($_FILES['upload_img'], date('Y-m-d'), 'AuctionGoods');
            if ($upload['status']) {
                $param['img']      = $upload['message'];
                $status['img_url'] = $upload['message'];
            } else {
                $status['message'] = '图片上传失败: ' . $upload['message'];
                return $status;
            }
        }
        if ($id) {
            $save = $this->getDb()->update(self::TABLE_NAME, $param, array('and', 'id = "' . $id . '"'));
            if (empty($status['img_url'])) {
                $status['img_url'] = Yii::app()->request->getParam('img', '');
            }
            if ($save !== false) {
                if ($this->getDb()->update(self::INFO_TABLE_NAME, $data, array('and', 'auction_goods_id = "' . $id . '"')) === false) {
                    $status['message'] = '拍品详细保存失败';
                    return $status;
                }
            }
        } else {
            $param['add_time'] = time();
            $save              = $this->getDb()->insert(self::TABLE_NAME, $param);
            $id                = Yii::app()->db->getLastInsertID();
            $status['id']      = $id;
            if ($save) {
                $data['auction_goods_id'] = $id;
                if (!$this->getDb()->insert(self::INFO_TABLE_NAME, $data)) {
                    $status['message'] = '拍品详情添加失败';
                    return $status;
                }
            }
        }
        if ($save !== false) {
            $status['status']  = true;
            $status['message'] = '数据保存成功！';
        } else {
            $status['message'] = '数据保存失败！';
        }
        return $status;
    }

    public function getGoodsCount() {
        $row = $this->getOneByCond(array(), 'count(1) cut');
        return $row['cut'];
    }
}

?>