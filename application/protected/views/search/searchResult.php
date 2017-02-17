<section>
<div class="jigou">
	<div class="seach">
    <form action="" method="get">
    	<input name="keyword" type="text" class="txt" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" />
        <input type="submit" class="btn" value="搜索" style="display:none;" />
        <div class="clear"></div>
    </form>
    </div>
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



	<!--当搜索框继续输入的时候 就显示下面了  开始-->
     <div class="seach_page2" style="display:none;">
        <!-- <div class="seach_list ft30">
            <ul>
                <li><a href="#">成都腾睿</a></li>
                <li><a href="#">成都青羊</a></li>
                <li><a href="#">成都市</a></li>
                <li><a href="#">成都高新区</a></li>
            </ul>
        </div> -->
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
$(document).ready(function(){
//搜索框 继续输入内容 执行
$('.txt').click(function(){
$('.main').hide();
$('.seach_page2').show();
});
$('.btn').click(function(){
$('.seach_page2').hide();
$('.main').show();
});
$('.seach_list li a').click(function(){
$('.seach_page2').hide();
$('.main').show();
});


});


</script>