<section>
<div class="jigou">
	<div class="seach">
    <form action="" method="get">
    	<input name="keyword" type="text" class="txt" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" />
        <input type="submit" class="btn" value="搜索" style="display:none;" />
        <div class="clear"></div>
    </form>
    </div>
	<div class="jigou_list">
        	<?php foreach ($agencyList as $val): ?>
                    <div class="xx_jigou"><a href="/Agency/agencyDetail?id=<?php echo $val['id'] ?>">
                            <img src="<?php echo $val['logo'] ?>" />
                            <div class="info">
                                <p class="ft34"><?php echo $val['name'] ?></p>
                                <p class="ft26"><?php echo $val['count'] ?>件拍品</p>
                            </div>
                            <?php if (in_array($val['id'], $agencyConcernId)) {?>
                            <a href="javascript:void(0)" onclick="concern(this,<?php echo $val['id'] ?>,3)" style="display:none;"><span class="a_guanzhu">+ 关注</span></a>
                            <a href="javascript:void(0)" onclick="cancelConcern(this,<?php echo $val['id'] ?>,3)"><span class="a_guanzhu ygz">已关注</span></a>
                            <?php } else {?>
                            <a href="javascript:void(0)" onclick="concern(this,<?php echo $val['id'] ?>,3)"><span class="a_guanzhu">+ 关注</span></a>
                            <a href="javascript:void(0)" onclick="cancelConcern(this,<?php echo $val['id'] ?>,3)" style="display:none;"><span class="a_guanzhu ygz">已关注</span></a>
                            <?php }?>
                            <div class="clear"></div></a>
                    </div>
                <?php endforeach;?>
	</div>
	<!--当搜索框继续输入的时候 就显示下面了  开始-->
     <div class="seach_page2" style="display:none;">
       <!--  <div class="seach_list ft30">
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

    //关注机构
    function concern(event,id,type){
    $.post('/user/userConcern', {
        id: id,
        type: type
    }, function(data, textStatus, xhr) {
        var obj = eval('(' + data + ')');
        if (obj.status) {
            $(event).css('display', 'none');
            $(event).next().css('display', 'block');
        } else {
            alert(obj.msg);
        }
    });

    }
    //取消关注
    function cancelConcern(event,id,type){
    $.post('/user/cancelConcern', {
        id: id,
        type: type
    }, function(data, textStatus, xhr) {
        var obj = eval('(' + data + ')');
        if (obj.status) {
            $(event).css('display', 'none');
            $(event).prev().css('display', 'block');
        } else {
            alert(obj.msg);
        }
    });

    }

$(document).ready(function(){

//搜索框 继续输入内容 执行
$('.txt').click(function(){
$('.jigou_list').hide();
$('.seach_page2').show();
});
$('.btn').click(function(){
$('.seach_page2').hide();
$('.jigou_list').show();
});
$('.seach_list li a').click(function(){
$('.seach_page2').hide();
$('.jigou_list').show();
});

});

</script>