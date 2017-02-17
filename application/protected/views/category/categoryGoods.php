<section>

    <div class="main">
                <?php foreach ($goodsList as $val): ?>
                <div class="img_box">
                    <p class="<?php echo in_array($val['id'], $goodsConcern) ? 'love_yes' : 'love' ?>">
                    <em onclick="concern(this,<?php echo $val['id'] ?>,1)"><img src="/images/love.png" /></em>
                    <i onclick="cancelConcern(this,<?php echo $val['id'] ?>,1)"><img src="/images/love_yes.png" /></i>
                    </p>
                    <a href="/auction/auctionGoodsDetail?id=<?php echo $val['id'] ?>&is_auction=no">
                        <p class="img"><img src="<?php echo $val['img']; ?>" /></p>
                        <h3 class="ft34"><?php echo $val['name'] ?></h3>
                        <p class="money"><i>￥</i><?php echo number_format($val['min_price']) ?>-<i>￥</i><?php echo number_format($val['max_price']) ?></p>
                    </a>
                </div>
            <?php endforeach;?>
         <div class="clear"></div>
</div>
</div>

</section>
<script type="text/javascript">

    //关注对象
    function concern(event,id,type) {
    $.post('/user/userConcern', {
        id: id,
        type: type
    }, function(data, textStatus, xhr) {
        var obj = eval('(' + data + ')');
        if (obj.status) {
            $(event).parent('p').prop('class', 'love_yes');
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
               $(event).parent('p').prop('class', 'love');
            }else{
                alert(obj.msg);
            }
        });
    }
</script>