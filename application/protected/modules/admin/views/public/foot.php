<div class="navbar navbar-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <footer role="contentinfo">
                    技术支持-成都腾睿互动科技有限公司
                </footer>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/bootstrap-admin-theme-change-size.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	$('.fangke').hover(function(){
		$(".fangke .bg").stop().animate({
			width:'300'
		});
		var timeout = setTimeout(function() {
			$(".fangke b").css("color","#fff");
			$(".fangke p").css("color","#fff");
        }, 250);
		},function(){
			$(".fangke .bg").stop().animate({
				width:'0'
			});
			var timeout = setTimeout(function() {
				$(".fangke b").css("color","#444");
				$(".fangke p").css("color","#888");
		}, 250);
		});

	$('.hongbao').hover(function(){
		$(".hongbao .bg").stop().animate({
			width:'300'
		});
		var timeout = setTimeout(function() {
			$(".hongbao b").css("color","#fff");
			$(".hongbao p").css("color","#fff");
        }, 250);
		},function(){
			$(".hongbao .bg").stop().animate({
				width:'0'
			});
			var timeout = setTimeout(function() {
				$(".hongbao b").css("color","#444");
				$(".hongbao p").css("color","#888");
			}, 250);
		});

  
	$('.liuyan').hover(function(){
		$(".liuyan .bg").stop().animate({
			width:'300'
		});
		var timeout = setTimeout(function() {
			$(".liuyan b").css("color","#fff");
			$(".liuyan p").css("color","#fff");
        }, 250);
		},function(){
			$(".liuyan .bg").stop().animate({
				width:'0'
			});
			var timeout = setTimeout(function() {
				$(".liuyan b").css("color","#444");
				$(".liuyan p").css("color","#888");
			}, 250);
		});
 
});
</script>