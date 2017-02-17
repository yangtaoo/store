<footer>
	<a href="/" id="hover_home" title="首页"><em><img src="/images/footer_1.jpg" /></em><i><img src="/images/footer_12.jpg" /></i></a>
	<a href="/category" id="hover_category" title="分类"><em><img src="/images/footer_2.jpg" /></em><i><img src="/images/footer_22.jpg" /></i></a>
	<a href="/auction" id="hover_auction" title="拍卖"><em><img src="/images/footer_3.jpg" /></em><i><img src="/images/footer_32.jpg" /></i></a>
	<a href="/agency" id="hover_agency" title="机构"><em><img src="/images/footer_4.jpg" /></em><i><img src="/images/footer_42.jpg" /></i></a>
	<a href="/userCenter" id="hover_user_center" title="我的"><em><img src="/images/footer_5.jpg" /></em><i><img src="/images/footer_52.jpg" /></i></a>
</footer>
<script type="text/javascript">
	var hover='<?php echo $_SERVER['REQUEST_URI']; ?>'.split("/");
		hover=hover[1].toLowerCase();
	switch(hover){
		case 'category':
			$('#hover_category').addClass('hover');
			break;
		case 'auction':
			$('#hover_auction').addClass('hover');
			break;
		case 'agency':
			$('#hover_agency').addClass('hover');
			break;
		case 'usercenter':
			$('#hover_user_center').addClass('hover');
			break;
		default:
			$('#hover_home').addClass('hover');
	}
</script>