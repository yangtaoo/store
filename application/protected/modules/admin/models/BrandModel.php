<?php

/**
 * 品牌类.
 *
 * @author yangtaoo <1162510775@qq.com>
 */
class BrandModel extends BaseModel {
    
    const TABLE_NAME = 'turnreal_brands';
    
    /**
     * 保存品牌数据
     * 
     * @param array   $param   数据.
     * @param integer $brandId 品牌ID.
     * 
     * @return boolean .
     */
    public function saveBrand($param, $brandId = 0){
        $status = array(
            'status' => false,
            'message' => '',
            'brandId' => $brandId
        );
        if(empty($param['brand_name'])){
            $status['message'] .= "<br>品牌名称不能为空！";
        }
        if(!empty($status['message'])){
            return $status;
        }
        if($brandId){
            if(!empty($_FILES['brand_logo_file']['tmp_name'])){
                $upload = Helper::uploadImg($_FILES['brand_logo_file'], $brandId, 'brand');
                if($upload['status']){
                    $param['brand_logo'] = $upload['message'];
                }
            }
            $save = $this->getDb()->update(self::TABLE_NAME, $param, array('and', 'brand_id = "' . $brandId . '"'));
        }else{
            $save = $this->getDb()->insert(self::TABLE_NAME, $param);
            $brandId = Yii::app()->db->getLastInsertID();
            $status['brandId'] = $brandId;
            if(!empty($_FILES['brand_logo_file']['tmp_name'])){
                $upload = Helper::uploadImg($_FILES['brand_logo_file'], $brandId, 'brand');
                if($upload['status']){
                    $this->getDb()->update(self::TABLE_NAME, array('brand_logo' => $upload['message']), array('and', 'brand_id = "' . $brandId . '"'));
                }
            }
        }
        if($save !== false){
            $status['status'] = true;
            $status['message'] = '数据保存成功！';
        }else{
            $status['message'] = '数据保存失败！';
        }
        return $status;
    }
    
}