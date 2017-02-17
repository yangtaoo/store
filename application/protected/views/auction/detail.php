<section>
    <div class="xiangxi pai">
        <div class="img">
            <?php if ($action['start_time'] > time()) {?>
            <div class="time weikai"><span class="f1">未开始</span><span  class="fr ft26"><?php echo date('Y年m月d日 H:i', $action['start_time']) ?>开始</span><em></em></div>
            <?php } elseif ($action['end_time'] < time()) {?>
            <div class="time weikai"><span class="f1">已结束</span><span  class="fr ft26"><?php echo date('Y年m月d日 H:i', $action['end_time']) ?>结束</span><em></em></div>
            <?php } else {?>
            <div class="time kai"><span class="f1">拍卖中</span><span  class="fr ft26"><?php echo date('Y年m月d日 H:i', $action['end_time']) ?>截止</span><em></em></div>
            <?php }?>
            <!--我是拍卖未开始的效果<div class="time weikai"><span class="fl">暂未开始</span><span class="fr ft26">2016年12月05日 10:00开始</span><em></em></div>-->

            <p><img src="<?php echo $action['auction_img'] ?>" /></p></div>

        <div class="info">
            <h1><?php echo $action['name'] ?></h1>
            <p class="<?php echo in_array($action['id'], $auctionConcernId) ? 'love_yes' : 'love'; ?>">
            <em onclick="concern(this,<?php echo $action['id'] ?>,2)"><img src="/images/shoucang.png" /></em>
            <i onclick="cancelConcern(this,<?php echo $action['id'] ?>,2)"><img src="/images/shoucang_yes.png" /></i>
            </p>
            <p class="ft26 c_666"><span class="fl">共<?php echo $auctionGoodsCnt['cnt'] ?>件拍品</span><span class="fr">共<?php echo $action['count']; ?>人鉴赏</span><div class="clear"></div></p>
        </div>
        <div class="xx_jigou"><a href="/Agency/agencyDetail?id=<?php echo $action['agency_id'] ?>"><img src="<?php echo $agency['logo'] ?>" /><p class="fl"><?php echo $agency['name'] ?></p></a>
        <a href="javascript:void(0)" class="a_guanzhu" id="concern" onclick="concern(this,<?php echo $action['agency_id'] ?>,3)">+ 关注</a>
        <a href="javascript:void(0)" class="a_guanzhu ygz" onclick="cancelConcern(this,<?php echo $action['agency_id'] ?>,3)" id="cancel_concern" style="display: none;">已关注</a>
            <div class="clear"></div>
        </div>
        <div class="main">
            <?php foreach ($auctionGoodsList as $val) {?>
            <div class="img_box">
                <p class="number">1</p>
                <p class="<?php echo in_array($val['id'], $goodsConcernId) ? 'love_yes' : 'love'; ?>">
                <em onclick="concern(this,<?php echo $val['id'] ?>,1)"><img src="/images/love.png" /></em>
                <i onclick="cancelConcern(this,<?php echo $val['id'] ?>,1)"><img src="/images/love_yes.png" /></i>
                </p>
                <a href="/auction/auctionGoodsDetail?id=<?php echo $val['id'] ?>">
                    <p class="img"><img src="<?php echo $val['img'] ?>" /></p>
                    <h3 class="ft34"><?php echo $val['name'] ?></h3>
                    <p class="money"><i>￥</i><?php echo number_format($val['min_price']) ?>-<i>￥</i><?php echo number_format($val['max_price']) ?></p>
                </a>
            </div>
            <?php }?>
            <div class="clear"></div>
        </div>
    </div>
</section>
<script type="text/javascript">

    $(function(){
        <?php if (in_array($action['agency_id'], $agencyConcernId)) {
    echo '$("#concern").css("display","none");';
    echo '$("#cancel_concern").css("display","block");';
}
?>
    })
    //关注对象
    function concern(event,id,type) {
    $.post('/user/userConcern', {
        id: id,
        type: type
    }, function(data, textStatus, xhr) {
        var obj = eval('(' + data + ')');
        if (obj.status) {
            if (type != 3) {
                $(event).parent('p').prop('class', 'love_yes');
                alert("关注成功");
            } else {
                $(event).css('display', 'none');
                $('#cancel_concern').css('display', 'block');
                alert("关注成功");
            }
        } else {
            alert(obj.msg);
        }
    });
}
    //取消关注
    function cancelConcern(event,id,type) {
        $.post('/user/cancelConcern', {id: id,type:type}, function(data, textStatus, xhr) {
            var obj=eval('(' + data + ')');
            if(obj.status){
               if (type != 3) {
                $(event).parent('p').prop('class', 'love');
                alert("已取消关注");
            } else {
                $(event).css('display', 'none');
                $('#concern').css('display', 'block');
                alert("已取消关注");
            }
            }else{
                alert(obj.msg);
            }
        });
    }
</script>
