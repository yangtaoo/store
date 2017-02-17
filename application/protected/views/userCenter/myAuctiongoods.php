<section>
<div class="main">
            <?php foreach ($auctiongoodsList as $val): ?>
                <div class="img_box">
                    <p class="love_yes" onclick="cancelConcern(this,<?php echo $val['id'] ?>)">
                    <em><img src="/images/love.png" /></em>
                    <i><img src="/images/love_yes.png" /></i>
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
</section>
<script type="text/javascript">
    //取消关注拍品
    function cancelConcern(event,id){
        if(confirm('确定不在关注')){
            $.post('/user/cancelConcern', {id:id,type:1}, function(data, textStatus, xhr) {
            var obj=eval('('+data+')');
            if(obj.status){
                $(event).parent('div').remove();
            }else{
                alert(obj.msg);
            }
        });
        }
    }
</script>