<?php

class DefaultModel extends BaseModel {

    const TABLE_NAME = 'turnreal_home_carousel_img';
    /**
     * 保存首页轮播图片
     * @param  array $param 图片信息
     * @param  integer $id    图片ID
     * @return array
     */
    public function saveImg($param, $id) {
        $status = array(
            'status'  => false,
            'message' => '',
            'id'      => $id,
            'img_url' => '',
        );
        if (!empty($_FILES['upload_img']['tmp_name'])) {
            list($width, $height) = getimagesize($_FILES['upload_img']['tmp_name']);
            if (!($width == 750 && $height == 450)) {
                $status['message'] = '图片尺寸为750*450';
                return $status;
            }
            $upload = Helper::uploadImg($_FILES['upload_img'], date('Y-m-d'), 'home_carousel_img');
            if ($upload['status']) {
                $param['img_url']  = $upload['message'];
                $status['img_url'] = $upload['message'];
            } else {
                $status['message'] = '图片上传失败: ' . $upload['message'];
                return $status;
            }
        }
        if ($id) {
            $save = $this->getDb()->update(self::TABLE_NAME, $param, array('and', 'id = "' . $id . '"'));
            if (empty($status['img_url'])) {
                $img               = self::getColumnByCond('id=' . $id, 'img_url');
                $status['img_url'] = array_shift($img);
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
}

?>