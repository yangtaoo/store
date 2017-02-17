
<section>
<div class="xiangxi">
    <div class="img">
    	<p>
            <img src="<?php echo $data['img'] ?>" />
            <?php if ($product360ImagesCnt['cnt'] > 0) {?>
		<div  class="contain">
                    <a href="/product/360Images?id=<?php echo $data['id']; ?>">
		    <b><img class="donut donut-back"  src="/images/kanle360.png" alt="Donut back" /></b>
                    </a>
                </div>
            <?php } ?>
        </p>
	</div> 
	<div class="caozuo_bar cb1">
		<p class="love_yes">
      		<em onclick="concern(this,<?php echo $data['id'] ?>,1)" <?php echo in_array($data['id'], $goodsConcernId) ? 'style="display:none;"' : ''; ?>><img src="/images/love.png" />关注</em>
      		<i onclick="cancelConcern(this,<?php echo $data['id'] ?>,1)" <?php echo in_array($data['id'], $goodsConcernId) ? '' : 'style="display:none;"'; ?>><img src="/images/love_yes.png" />已关注</i>
      	</p>
        <p style="display: <?php echo empty($remind['object_id']) ? 'block' : 'none'; ?>;" onclick="remind(<?php echo $data['id']; ?>,this)"><img src="/images/icon_tixing.png">提醒</p>
        <p style="display: <?php echo empty($remind['object_id']) ? 'none' : 'block'; ?>;" onclick="cancelRemind(<?php echo $data['id']; ?>,this)"><img src="/images/icon_tixing.png">已提醒</p>
      	<p class="fenxiang"><img src="/images/icon_fenxiang.png">分享</p>
    </div>
	<div class="caozuo_bar cb2" style="display:none;"><p><img src="/images/love.png">关注</p><p class="fenxiang"><img src="/images/icon_fenxiang.png">分享</p></div>
    <div class="info" style="margin-bottom:4%;">
    	<h1><?php echo $data['name']; ?></h1>

        <?php if (empty($is_auction)) {?>
        <p class="money2"><i>估价：￥</i><?php echo number_format($data['min_price']) ?>-<i>￥</i><?php echo number_format($data['max_price']) ?></p>
      <p class="money3"><i>成交价：￥</i><?php echo $data['trade_price'] > 0 ? number_format($data['trade_price']) : '暂无'; ?></p>
  <?php } else {?>
  <p class="money2"><i>估价：￥</i><?php echo number_format($data['min_price']) ?>-<i>￥</i><?php echo number_format($data['max_price']) ?></p>
  <p class="money3"><i>成交价：￥</i><?php echo $data['trade_price'] > 0 ? number_format($data['trade_price']) : '暂无'; ?></p>
  <?php }?>
    </div>
     <div class="jieshao ft34">
        <div class="jieshao_text">
        	<p><a href="/category/auctiongoods?id=<?php echo $data['category_id']; ?>"><span class="sp_1">类&nbsp;&nbsp;&nbsp;别</span><span class="sp_2"><?php echo $data['category_name'] ?></span></a></p>
        	<p><span class="sp_1">年&nbsp;&nbsp;&nbsp;代</span><span class="sp_2"><?php echo $data['decade'] ?></span></p>
        	<p><span class="sp_1">尺&nbsp;&nbsp;&nbsp;寸</span><span class="sp_2">长<?php echo $data['size']['long'] ?>cm 宽<?php echo $data['size']['width'] ?>cm 高<?php echo $data['size']['height'] ?>cm</span></p>
        	<p><span class="sp_1">重&nbsp;&nbsp;&nbsp;量</span><span class="sp_2"><?php echo $data['weight'] ?>kg</span></p>
        	<p style="border:0;"><span class="sp_1">描&nbsp;&nbsp;&nbsp;述</span>
            <span class="sp_2"><?php echo $data['intro']; ?></span></p>
        </div>
        <div class="jieshao_text2">
        	<p><a href="/Agency/agencyDetail?id=<?php echo $data['agency_id']; ?>"><span class="sp_1">拍卖公司</span><span class="sp_2"><?php echo $data['agency_name'] ?></span></a>
            </p>
            <?php if (!empty($data['auction_name'])): ?>
        	<p><a href="/auction/Detail?id=<?php echo $data['auction_id']; ?>"><span class="sp_1">拍卖会</span><span class="sp_2"><?php echo $data['auction_name']; ?></span></a></p>
        	<p><span class="sp_1">拍卖时间</span><span class="sp_2"><?php echo date('Y-m-d H:i', $data['start_time']); ?></span></p>
        	<p style="border:0;"><span class="sp_1">拍卖地点</span><span class="sp_2"><?php echo $data['province'] . '-' . $data['city'] . ' ' . $data['area'] . ' (' . $data['address'] . ')'; ?></span></p>
        <?php endif;?>
        </div>
     </div>
</div>
<div class="fenxiang_pupop" style="display:none;" >
	<p><img src="/images/fxts.png"></p>
	<em></em>
</div>
<div class="tixing_pupop" style="display:none;" >
	<div class="pupop_main">
		<div class="pupop_cont">
            <p>拍卖时间 2017-02-12 14:00</p>
            <h3>设置提醒时间</h3>
            <div class="tx_time">
            	<img src="/images/icon_naozhong2.png" width="24">
                <select>
                    <option value="0">3小时前</option>
                    <option value="0">6小时前</option>
                    <option value="1">一天前</option>
                </select>
            </div>
    	</div>
		<div class="pupop_btn"><button class="btn2" onclick="$('.tixing_pupop').hide();">取消</button><button type="submit" class="btn1">确定</button></div>
	</div>
	<em class="hei_bg"></em>
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
            if (type != 3) {
                $(event).css('display','none');
                $(event).next().css('display','block');
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
                $(event).css('display','none');
                $(event).prev().css('display','block');
            } else {
                $(event).css('display', 'none');
                $('#concern').css('display', 'block');
            }
            }else{
                alert(obj.msg);
            }
        });
    }

    //添加提醒
    function remind(id,event){
    	$.post('/user/remind', {id: id}, function(data, textStatus, xhr) {
            var obj=eval('(' + data + ')');
            if(obj.status){
            	alert('添加成功');
                $(event).css('display','none');
                $(event).next().css('display','block');
            }else{
                alert(obj.msg);
            }
        });
    }
	
    //取消提醒
    function cancelRemind(id,event){
    	$.post('/user/cancelRemind', {id: id}, function(data, textStatus, xhr) {
            var obj=eval('(' + data + ')');
            if(obj.status){
            	alert('取消成功');
                $(event).css('display','none');
                $(event).prev().css('display','block');
            }else{
                alert(obj.msg);
            }
        });
    }

    //设置提醒弹窗居中
	$(function(){
    var ts_h=$('.tixing_pupop').height();
    $('.tixing_pupop').css("margin-top","-"+ ts_h/2 +"px");
	})
	
	
    //分享
$(function(){
    $('.fenxiang').click(function(){
		$('.fenxiang_pupop').show();
    })
    $('.fenxiang_pupop').click(function(){
		$('.fenxiang_pupop').hide();
    })
})
</script>
