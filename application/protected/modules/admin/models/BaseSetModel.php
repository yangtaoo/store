<?php

/**
 * 基础设置类.
 *
 * @author yangtaoo <1162510775@qq.com>
 */
class BaseSetModel extends BaseModel {

    const TABLE_NAME = 'admin_config';

    /**
     * 获取网站基础设置信息
     *
     * @return array .
     */
    public function getBaseSet($cond = array()) {
        $result = array();
        $data   = $this->getDb()->select("name,values")->from(self::TABLE_NAME)->where($cond)->queryAll();
        foreach ($data as $val) {
            $result[$val['name']] = $val['values'];
        }
        return $result;
    }

    /**
     * 基础信息设置
     * @param array $baseSet 设置参数.
     *
     * @return boolean.
     */
    public function setBaseSet($baseSet) {
        $updateStatu = true;
        $nowBaseSet  = $this->getBaseSet();
        $db          = $this->getDb();
        foreach ($baseSet as $key => $val) {
            if (isset($nowBaseSet[$key])) {
                $param = array(
                    'values' => $val,
                );
                $cond = array(
                    'and',
                    'name = "' . $key . '"',
                );
                $updateStatu = $updateStatu && $db->update(self::TABLE_NAME, $param, $cond) !== false;
            } else {
                $param = array(
                    'name'   => $key,
                    'values' => $val,
                    'remark' => '',
                );
                $updateStatu && $db->insert(self::TABLE_NAME, $param);
            }
        }
        return $updateStatu;
    }

}
