<?php

class CategoryModel extends BaseModel {

    const TABLE_NAME = 'turnreal_category';
    /**
     * 获取分类列表数据
     * @return array
     */
    public function getCategory() {
        return $this->getDb()->from(self::TABLE_NAME)->order('rght desc')->queryAll();
    }
    /**
     * 保存分类
     * @param  array $param 分类数据
     * @param  int $id    分类id
     * @return boolean
     */
    public function saveCategory($param, $id = '') {
        $status = array(
            'status'  => false,
            'message' => '',
            'id'      => $id,
        );
        $msg = '';
        if (empty($param['name'])) {
            $status['message'] .= "<br>分类名称不能为空！";
            return $status;
        }
        Yii::import('application.extensions.*');
        require_once 'Logic/DbMysql.php';
        require_once 'Logic/DbMysqlLogic.php';
        require_once 'Service/NestedSetsService.php';

        $db    = new DbMysqlLogic();
        $neste = new NestedSetsService($db, self::TABLE_NAME, 'lft', 'rght', 'pid', 'id', 'level');
        foreach ($_FILES as $key => $val) {
            if (empty($val['name'])) {
                continue;
            }
            list($width, $height) = getimagesize($val['tmp_name']);
            switch ($key) {
            case 'list_img':
                if (!($width == 750 && $height == 250)) {
                    $status['message'] = '分类列表图片尺寸为750*250';
                }
                break;
            case 'tags_img':
                if (!($width == 160 && $height == 266)) {
                    $status['message'] = '热门分类图片尺寸为160*266';
                }
                break;
            default:
                if (!($width == 750 && $height == 150)) {
                    $status['message'] = '主页分类列表图片为750*150';
                }
                break;
            }
            if (!empty($status['message'])) {
                return $status;
            }
            $upload = Helper::uploadImg($val, date('Y-m-d'), $key);
            if ($upload['status']) {
                $param[$key] = $upload['message'];
            } else {
                switch ($key) {
                case 'list_img':
                    $imgType = '分类列表图上传失败: ';
                    break;
                case 'tags_img':
                    $imgType = '热门分类图上传失败: ';
                    break;
                default:
                    $imgType = '主页分类列表图上传失败: ';
                    break;
                }
                $status['message'] = $imgType . $upload['message'];
                return $status;
            }
        }
        if ($id) {
            $cond = "`name`='{$param['name']}' and pid='{$param['pid']}' and id<>{$id}";
            if (self::getOneByCond($cond, 'id')) {
                $result = false;
                $msg    = '已经存在同名分类';
            } else {
                $old_pid = self::getOneByCond('id=' . $id, 'pid');
                if ($old_pid['pid'] !== $param['pid']) {
                    $result = $neste->moveUnder($id, $param['pid'], 'bottom');
                    if ($result === false) {
                        $msg = '分类保存失败';
                    }
                }
                $result = $this->getDb()->update(self::TABLE_NAME, $param, array('and', 'id = "' . $id . '"'));
                if ($result === false) {
                    $msg = '数据保存失败';
                }
            }
        } else {
            $param['add_time'] = time();
            $result            = $neste->insert($param['pid'], $param, 'bottom');
            if ($result === false) {
                $msg = '添加失败';
            } else {
                $status['id'] = $result;
            }
        }
        if ($result === false) {
            $status['message'] = $msg;
        } else {
            $status['status']  = true;
            $status['message'] = '数据保存成功';
        }
        return $status;
    }
    /**
     * 根据id删除分类及所有子分类
     * @param  int $id 分了id
     * @return boolean
     */
    public function deleteCategory($id) {
        $row  = self::getOneByCond('id=' . $id, 'lft,rght');
        $cond = "lft>={$row['lft']} and rght<={$row['rght']}";
        return self::delete($cond);
    }

}

?>