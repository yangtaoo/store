<?php

class AgencyModel extends BaseModel {

    const TABLE_NAME = 'turnreal_agency';
    /**
     * 保存机构信息
     * @param  array $param 机构信息
     * @param  int $id    需要更改id
     * @return boolean
     */
    public function saveAgency($param, $id) {
        $status = array(
            'status'  => false,
            'message' => '',
            'id'      => $id,
            'img_url' => '',
        );
        $account = $param['account'];
        unset($param['account']);
        if (!empty($_FILES['upload_img']['tmp_name'])) {
            list($width, $height) = getimagesize($_FILES['upload_img']['tmp_name']);
            if (!($width == 135 && $height == 135)) {
                $status['message'] = '图片尺寸为135*135';
                return $status;
            }
            $upload = Helper::uploadImg($_FILES['upload_img'], date('Y-m-d'), 'agency');
            if ($upload['status']) {
                $param['logo']     = $upload['message'];
                $status['img_url'] = $upload['message'];
            } else {
                $status['message'] = '机构LOGO上传失败: ' . $upload['message'];
                return $status;
            }
        }
        if ($id) {
            $save = $this->getDb()->update(self::TABLE_NAME, $param, array('and', 'id = "' . $id . '"'));
            if ($save !== false) {
                $data = array(
                    'account' => $account,
                );
                $result = $this->getDb()->update('turnreal_agency_info', $data, array('and', 'agency_id="' . $id . '"'));
                if ($result === false) {
                    $status['message'] = '机构详情保存失败';
                    return $status;
                }
                if (empty($status['img_url'])) {
                    $img               = self::getColumnByCond('id=' . $id, 'logo');
                    $status['img_url'] = array_shift($img);
                }
            }
        } else {
            $param['add_time'] = time();
            $save              = $this->getDb()->insert(self::TABLE_NAME, $param);
            $id                = Yii::app()->db->getLastInsertID();
            $status['id']      = $id;
            if ($save !== false) {
                $data = array(
                    'agency_id' => $id,
                    'account'   => $account,
                );
                $result = $this->getDb()->insert('turnreal_agency_info', $data);
                if ($result === false) {
                    $status['message'] = '机构详情保存失败';
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

    public function getAgencyCount() {
        $row = $this->getOneByCond(array(), 'count(1) cut');
        return $row['cut'];
    }
}

?>