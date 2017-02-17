<section>
<div class="jigou">
     <div class="xx_jigou mb_4">
     	<img src="<?php echo $agency['logo']; ?>" />
        <div class="info">
        	<p class="ft34"><?php echo $agency['name']; ?></p>
        	<p class="ft26"><?php echo count($auctionGoodsList); ?>件拍品</p>
        </div>
        	<a href="#" class="a_guanzhu" id="concern" onclick="concern(this,<?php echo $agency['id'] ?>,3)">+ 关注</a>
        	<a href="#" class="a_guanzhu ygz" onclick="cancelConcern(this,<?php echo $agency['id'] ?>,3)" id="cancel_concern" style="display:none;">已关注</a>
        <div class="clear"></div>
     </div>


     <div id="leftTabBox" class="tabBox">
				<div class="hd tab_tit">
					<ul>
						<li><a href="#">拍品</a></li>
						<li><a href="#">简介</a></li>
                        <div class="clear"></div>
					</ul>
				</div>
				<div class="bd ">
						<ul>
                        <div class="main">
                    <?php foreach ($auctionGoodsList as $val): ?>
                <div class="img_box">
                    <p class="<?php echo in_array($val['id'], $goodsConcernId) ? 'love_yes' : 'love' ?>">
                    <em onclick="concern(this,<?php echo $val['id'] ?>,1)"><img src="/images/love.png" /></em>
                    <i onclick="cancelConcern(this,<?php echo $val['id'] ?>,1)"><img src="/images/love_yes.png" /></i>
                    </p>
                    <a href="/auction/auctionGoodsDetail?id=<?php echo $val['id'] ?>&is_auction=no">
                        <p class="img"><img src="<?php echo $val['img'] ?>" /></p>
                        <h3 class="ft34"><?php echo $val['name'] ?></h3>
                        <p class="money"><i>￥</i><?php echo number_format($val['min_price']); ?>-<i>￥</i><?php echo number_format($val['max_price']); ?></p>
                    </a>
                </div>
                   <?php endforeach;?>
             <div class="clear"></div>
             </div>
		</ul>

        <ul>
			<div class="main">
            	<?php echo $agency['account']; ?>
            </div>
		</ul>

				</div>
			</div>
			<script type="text/javascript">TouchSlide({ slideCell:"#leftTabBox" });</script>

</div>

</section>
<script type="text/javascript">

    $(function(){
        <?php if (in_array($agency['id'], $agencyConcernId)) {
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
            } else {
                $(event).css('display', 'none');
                $('#cancel_concern').css('display', 'block');
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
            } else {
                $(event).css('display', 'none');
                $('#concern').css('display', 'block');
            }
            }else{
                alert(obj.msg);
            }
        });
    }
</script>