<?php
$server = "127.0.0.1";
$user   = "root";
$pwd    = "root";
$db     = "coco";
//公众号配置
$config = array(
    //公众号配置
    'app_id'       => 'wx9c77971cfceb0dde',
    'app_secret'   => '4e931b57509f072488083bbe0d063471',
    'template_id'  => 'D-4YcXHR6A3kVAHf2yhEWkEgvnZ-3yUPztl1-jsu0Yk',
    //接口地址
    'access_token' => 'https://api.weixin.qq.com/cgi-bin/token',
    'message_url'  => 'https://api.weixin.qq.com/cgi-bin/message/template/send',
);
try {
    $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $pwd);
    // echo "连接成功";
} catch (PDOException $e) {
    echo $e->getMessage();
}

//curl请求
function curlWeixin($url, $post = 0, $param = array()) {
    try {
        $curl = curl_init();
        //设置url
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
        //设置不验证证书
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if ($post) {
            //设置发送方式：
            curl_setopt($curl, CURLOPT_POST, true);
            //设置发送数据
            curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
        }
        //抓取URL并把它传递给浏览器
        $ext = curl_exec($curl);
        //关闭cURL资源，并且释放系统资源
        curl_close($curl);
        $result = json_decode($ext, true);
        return $result;
    } catch (Exception $ex) {
        throw new Exception($ex->getMessage());
    }
}
//获取access_token
$url    = $config['access_token'] . '?grant_type=client_credential&appid=' . $config['app_id'] . '&secret=' . $config['app_secret'];
$result = curlWeixin($url);
if (empty($result['access_token'])) {
    echo "access_token获取失败";
    exit();
}
$access_token = $result['access_token'];

$time = time();
$sql  = "select id,name,start_time,end_time,intro,province,city,area,address from turnreal_auction where status=1 and end_time>{$time}";
//获取即将开始拍卖会
$auction = $pdo->query($sql);
foreach ($auction as $val) {
    $openids = array();
    if (($startTime = $val['start_time'] - $time) < (3600 * 24 * 3)) {
        $isStart = $startTime > 0 ? '即将' : '已经';
        $openid  = array();
        //查看当前拍卖会关注用户
        $sql   = "select b.openid from turnreal_user_concern as a left join turnreal_users as b on a.user_id=b.id where a.concern_type=2 and a.object_id={$val['id']}";
        $users = $pdo->query($sql);
        foreach ($users as $val1) {
            $openid[]  = $val1['openid'];
            $openids[] = $val1['openid'];
            //根据openid推送消息提醒拍卖会
            $param = array(
                'touser'      => $val1['openid'],
                'template_id' => $config['template_id'],
                'url'         => 'http://coco.turnreal.net/auction/Detail?id=' . $val['id'],
                'data'        => array(
                    'first'    => array(
                        'value' => '您关注的拍卖会' . $isStart . '开始！',
                        'color' => '#040000',
                    ),
                    'keyword1' => array(
                        'value' => $val['name'],
                        'color' => '#040000',
                    ),
                    'keyword2' => array(
                        'value' => date('Y年m月d日 H:i', $val['start_time']) . '开始拍卖',
                        'color' => '#040000',
                    ),
                    'keyword3' => array(
                        'value' => $val['province'] . '-' . $val['city'] . ' ' . $val['area'] . '(' . $val['address'] . ')',
                        'color' => '#040000',
                    ),
                    'keyword4' => array(
                        'value' => $val['intro'],
                        'color' => '#040000',
                    ),
                    'remark'   => array(
                        'value' => '更多详情信息请到拍卖会页面查看！',
                        'color' => '#040000',
                    ),
                ),
            );
            $result = curlWeixin($config['message_url'] . '?access_token=' . $access_token, 1, json_encode($param));
        }

        //查看当前拍卖会下所有拍品
        $sql          = "select id,name from turnreal_auction_goods where status=1 and {$val['id']}";
        $auctionGoods = $pdo->query($sql);
        //获取每个拍品关注所有用户
        foreach ($auctionGoods as $val2) {
            $sql   = "select b.id,b.openid from turnreal_user_concern as a left join turnreal_users as b on a.user_id=b.id where a.concern_type=1 and a.object_id={$val2['id']}";
            $users = $pdo->query($sql);
            foreach ($users as $val3) {
                if (!in_array($val3['openid'], $openids)) {
                    $goodsName = array();
                    //获取用户提醒拍品
                    $sql          = "select b.name from turnreal_user_remind as a left join turnreal_auction_goods as b on a.object_id=b.id where a.user_id={$val3['id']} and b.auction_id={$val['id']}";
                    $auctionGoods = $pdo->query($sql);
                    foreach ($auctionGoods as $val4) {
                        $goodsName[] = $val4['name'];
                    }
                    //查看当前用户关注所有拍品
                    $sql          = "select b.name from turnreal_user_concern as a left join turnreal_auction_goods as b on a.object_id=b.id where a.concern_type=1 and b.status=1 and a.user_id={$val3['id']}";
                    $auctionGoods = $pdo->query($sql);
                    foreach ($auctionGoods as $val5) {
                        if (!in_array($val5['name'], $goodsName)) {
                            $goodsName[] = $val5['name'];
                        }

                    }
                    $goodsName = implode(',', $goodsName);
                    $openid1[] = $val3['openid'];
                    //根据openid推送消息提醒拍品
                    $param = array(
                        'touser'      => $val3['openid'],
                        'template_id' => $config['template_id'],
                        'url'         => 'http://coco.turnreal.net/auction/Detail?id=' . $val['id'],
                        'data'        => array(
                            'first'    => array(
                                'value' => '您关注的拍品: ' . $goodsName . $isStart . '拍卖。',
                                'color' => '#040000',
                            ),
                            'keyword1' => array(
                                'value' => $val['name'],
                                'color' => '#040000',
                            ),
                            'keyword2' => array(
                                'value' => date('Y年m月d日 H:i', $val['start_time']) . '开始拍卖',
                                'color' => '#040000',
                            ),
                            'keyword3' => array(
                                'value' => $val['province'] . '-' . $val['city'] . ' ' . $val['area'] . '(' . $val['address'] . ')',
                                'color' => '#040000',
                            ),
                            'keyword4' => array(
                                'value' => $val['intro'],
                                'color' => '#040000',
                            ),
                            'remark'   => array(
                                'value' => '更多详情信息请到拍卖会页面查看！',
                                'color' => '#040000',
                            ),
                        ),
                    );
                    $result = curlWeixin($config['message_url'] . '?access_token=' . $access_token, 1, json_encode($param));
                }
            }
        }
    }
}

?>