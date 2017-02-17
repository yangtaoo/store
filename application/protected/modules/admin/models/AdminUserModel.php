<?php
/**
 * 菜单类.
 *
 * @author yangtaoo <1162510775@qq.com>
 */

class AdminUserModel extends BaseModel
{
    const TABLE_NAME = 'admin_users';
    
    //每页数
    const PAGE_SIZE = 20;
    
    //性别配置
    public $gender = array(
        0 => '女',
        1 => '男'
    );
    
    /**
     * 登陆获取用户信息.
     *
     * @param string $name 用户名.
     * @param string $pwd  密码.
     *
     * @return mixed 用户信息.
     */
    public function getInfoByLogin($name, $pwd)
    {
        $db = $this->getDb();
        $info = $db->select('AccountID, AccountName,AccountTrueName,AccountPassword,salt')->from(self::TABLE_NAME)->where(array('and', 'AccountName=:name') , array(':name' => $name))->queryRow();
        if($info){
            $truePassword = Helper::getTruePassWord($pwd, $info['salt']);
            if($truePassword !== $info['AccountPassword']){
                return false;
            }
        }
        return $info;
    }
            
    /**
     * 根据条件返回用户列表,支持分页
     * @param array   $cond
     * @param integer $page
     * 
     * @return array
     */
    public function getUserListByCond($cond, $page){
        $offsetStart = ($page - 1) * self::PAGE_SIZE;
        $result = $this->db->select('u.AccountID,u.AccountName,u.AccountTrueName,u.AccountGender,u.AccountBirthday,u.AccountTelephone,u.AccountMobilePhone,u.AccountPolitics,u.AccountEmail,u.PositionID,u.DepartmentID')
                ->from(self::TABLE_NAME . ' u')
                ->where($cond)
                ->limit(self::PAGE_SIZE, $offsetStart)
                ->order('u.AccountID desc')
                ->queryAll();
        $this->db->reset();
        return $result;
    }
    
    /**
     * 根据条件获取单个用户数据
     * @param type $cond
     */
    public function getOneUserByCond($cond){
        $result = $this->db->select('*')
                ->from(self::TABLE_NAME)
                ->where($cond)
                ->queryRow();
        return $result;
    }
    
    /**
     * 用户信息更新
     * @param array $data 更新数据.
     * @param array $cond 条件.
     * 
     * @return bloean
     */
    public function updateUser($data, $cond){
        $result = $this->getDb()->update(self::TABLE_NAME, $data, $cond);
        return $result === false ? false : true;
    }
    
    /**
     * 根据条件判断用户表是否存在记录
     * @param array $cond 条件
     */
    public function userIsExistByCond($cond){
        $result = $this->db->select('*')
                ->from(self::TABLE_NAME)
                ->where($cond)
                ->queryRow();
        return $result ? true : false;
    }
    
    /**
     * 添加用户
     * @param type $userInfo 数据.
     * 
     * @return boolean .
     */
    public function addUser($userInfo){
        $result = $this->insert($userInfo);
        return $result;
    }
}