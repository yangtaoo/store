<body class="bootstrap-admin-with-small-navbar">



  
    <!-- small navbar -->
    <?php include __DIR__ . "/../public/nav.php" ?>

    <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            <!-- left, vertical navbar -->
            <?php include __DIR__ . "/../public/left.php" ?>               

            <!-- content -->
            <div class="main">
                <div class="row">
                	<div class="inner">
                        <div class="fangke"><a href="/admin/User/index"><em></em><p><b><i>今日</i><?php echo $userCount['newUser'] ?><i>人</i></b><i>累计</i><?php echo $userCount['oldUser'] ?><i>人</i></p></a><div class="bg"></div></div>
                        <div class="hongbao"><a href="/admin/redPack/index"><em></em><p><b><i>今日</i><?php echo $userCount['cancelUser'] ?><i>人</i></b></p></a><div class="bg"></div></div>
                        <div class="liuyan"><a href="/admin/message/index"><em></em><p><b><i>未读</i><?php echo $messageCount['newMessage'] ?><i>条</i></b><i>累计</i><?php echo $messageCount['allMessage'] ?><i>条</i></p></a><div class="bg"></div></div>
                    </div>
                    <div style="position:relative;">
                    	<div id="container" style="min-width:870px;height:300px; border:1px solid #ddd; margin-bottom:20px; padding-top:10px; background:#fff;"></div>
                    	<em style="width:200px; height:14px; position:absolute; right:0; bottom:2px; background:#fff; display:block; z-index:9999;"></em>
                    </div>
                    <div class="yonghu">
                    <div class="my">欢迎你！<h1>admin</h1>
                    	<em><a href="/admin/User/ChangePwd" class="icon_mima" title="修改密码">修改密码</a><a href="/admin/Login/LoginOut" class="icon_out" title="退出">退出</a></em>
                        </div>
                    <div class="yonghu_list">
                    	<div class="title5"><h3>新进用户</h3><a href="/admin/User/index">更多>></a></div>
                        <ul>
                            <?php foreach($newUser['data'] as $val){ ?>
                        	<li><img src="<?php echo $val['headimgurl']?$val['headimgurl']:'/images/logo300.png'; ?>"><b><?php echo $val['nickname'] ?></b><span><?php echo date('m-d H:i', $val['addtime']) ?></span></li>
                            <?php } ?>
                        </ul>
                    </div>
                    </div>
                    <div class="liuyan_list">
                    	<div class="title5"><h3>最新留言</h3><a href="/admin/message/index">更多>></a></div>
                        <ul>
                        	<?php foreach($newMessage['data'] as $val){ ?>
                            <li><span class="fl"><img src="<?php echo isset($val['headimgurl']) && !empty($val['headimgurl'])?$val['headimgurl']:'/images/logo300.png'; ?>"></span>
                                <div class="fr"><span class="span_name"><?php echo isset($val['nickname']) && !empty($val['nickname'])?$val['nickname']:'-'; ?></span><span class="span_time"><?php echo date('m-d H:i', $val['addtime']) ?></span>
                                    <p><?php echo $val['content'] ?></p>
                                </div>
                                <div class="clear"></div>
                            </li>
                                <?php } ?>
                            
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include __DIR__ . "/../public/foot.php" ?>
  <script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
  <script>
    $(function () {
    $('#container').highcharts({
        title: {
            text: '微信后台一周数据监控',
            x: -20 //center
        },
        xAxis: {
            categories: [<?php foreach($userCountList['newUser'] as $key => $val){ echo "'" . $key . "',"; } ?>]
        },
        yAxis: {
            title: {
                text: ' '
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '新增',
            data: [<?php foreach($userCountList['newUser'] as $key => $val){ echo "" . $val['new_user'] . ","; } ?>]
        }, {
            name: '跑路',
            data: [<?php foreach($userCountList['newUser'] as $key => $val){ echo "" . $val['cancel_user'] . ","; } ?>]
        }, {
            name: '总数',
            data: [<?php foreach($userCountList['oldUser'] as $key => $val){ echo "" . $val . ","; } ?>]
        }]
    });
});
				
  </script>
</body>