<?php

class AuctionModel extends BaseModel {

    const TABLE_NAME = 'turnreal_auction';
    /**
     * 保存拍品会信息
     * @param  array $param 拍品会信息
     * @param  int $id
     * @return boolean
     */
    public function saveAuction($param, $id) {
        $status = array(
            'status'  => false,
            'message' => '',
            'id'      => $id,
            'img_url' => '',
        );
        if (!empty($_FILES['upload_img']['tmp_name'])) {
            list($width, $height) = getimagesize($_FILES['upload_img']['tmp_name']);
            if (!($width == 590 && $height == 260)) {
                $status['message'] = '图片尺寸为590*260';
                return $status;
            }
            $upload = Helper::uploadImg($_FILES['upload_img'], date('Y-m-d'), 'Auction');
            if ($upload['status']) {
                $param['auction_img'] = $upload['message'];
                $status['img_url']    = $upload['message'];
            } else {
                $status['message'] = '图片上传失败: ' . $upload['message'];
                return $status;
            }
        }
        if ($id) {
            $save = $this->getDb()->update(self::TABLE_NAME, $param, array('and', 'id = "' . $id . '"'));
            if (empty($status['img_url'])) {
                $status['img_url'] = Yii::app()->request->getParam('auction_img');
            }
        } else {
            $param['add_time'] = time();
            $save              = $this->getDb()->insert(self::TABLE_NAME, $param);
            $id                = Yii::app()->db->getLastInsertID();
            $status['id']      = $id;
        }
        if ($save !== false) {
            $status['status']  = true;
            $status['message'] = '数据保存成功！';
        } else {
            $status['message'] = '数据保存失败！';
        }
        return $status;
    }

    public function getAuctionCount() {
        $row = $this->getOneByCond(array(), 'count(1) cut');
        return $row['cut'];
    }
}

?>