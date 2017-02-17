<body class="bootstrap-admin-with-small-navbar">




    <!-- small navbar -->
    <?php include __DIR__ . "/../public/nav.php"?>

    <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            <!-- left, vertical navbar -->
            <?php include __DIR__ . "/../public/left.php"?>

            <!-- content -->
            <div class="main">
                <div class="row">
                    <div class="inner"><p><a href="/admin/User/index"><b><?php echo $userCount; ?></b>用户</a></p><p><a href="/admin/agency/index"><b><?php echo $agencyCount; ?></b>机构</a></p><p><a href="/admin/AuctionGoods/index"><b><?php echo $auctionGoodsCount; ?></b>拍品</a></p><p><a href="/admin/auction/index"><b><?php echo $auctionCount; ?></b>拍卖会</a></p></div>
                    <div style="position:relative;">
                        <div id="container" style="min-width:870px;height:300px; border:1px solid #ddd; margin-bottom:20px; padding-top:10px; background:#fff;"></div>
                        <em style="width:200px; height:14px; position:absolute; right:0; bottom:2px; background:#fff; display:block; z-index:9999;"></em>
                    </div>
                    <div class="yonghu">
                    <div class="yonghu_list">
                        <div class="title5"><h3>新进用户</h3><a href="/admin/User/index">更多>></a></div>
                        <ul>
                            <?php foreach ($newUser['data'] as $val) {?>
                            <li><img src="<?php echo $val['headimgurl'] ? $val['headimgurl'] : '/images/logo300.png'; ?>"><b><?php echo $val['nickname'] ?></b><span><?php echo date('m-d H:i', $val['addtime']) ?></span></li>
                            <?php }?>
                        </ul>
                    </div>
                    </div>
                    <div class="liuyan_list">
                        <div class="title5"><h3>最新留言</h3><a href="/admin/message/index">更多>></a></div>
                        <ul>
                            <?php foreach ($newMessage['data'] as $val) {?>
                            <li><span class="fl"><img src="<?php echo isset($val['headimgurl']) && !empty($val['headimgurl']) ? $val['headimgurl'] : '/images/logo300.png'; ?>"></span>
                                <div class="fr"><span class="span_name"><?php echo isset($val['nickname']) && !empty($val['nickname']) ? $val['nickname'] : '-'; ?></span><span class="span_time"><?php echo date('m-d H:i', $val['add_time']) ?></span>
                                    <p><?php echo $val['content'] ?></p>
                                </div>
                                <div class="clear"></div>
                            </li>
                                <?php }?>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include __DIR__ . "/../public/foot.php"?>
  <script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
  <script>
    $(function () {
    $('#container').highcharts({
        title: {
            text: '微信后台一周数据监控',
            x: -20 //center
        },
        xAxis: {
            categories: [<?php foreach ($userCountList['newUser'] as $key => $val) {echo "'" . $key . "',";}?>]
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
            data: [<?php foreach ($userCountList['newUser'] as $key => $val) {echo "" . $val['new_user'] . ",";}?>]
        }, {
            name: '跑路',
            data: [<?php foreach ($userCountList['newUser'] as $key => $val) {echo "" . $val['cancel_user'] . ",";}?>]
        }, {
            name: '总数',
            data: [<?php foreach ($userCountList['oldUser'] as $key => $val) {echo "" . $val . ",";}?>]
        }]
    });
});

  </script>
</body>