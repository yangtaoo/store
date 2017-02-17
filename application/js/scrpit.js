$(document).ready(function(){ 

//分类页面 点击展开显示小分类
$('.fenlei_box p').click(function(){ 
$('.fenlei_box ul').hide();
$(this).nextAll().show();
}); 


//搜索框 输入内容后 执行
$('.seach .txt').keyup(function(){
	$('.seach_page1').hide();
	$('.seach_page2').show();
	$(this).css('width','76%');
	$(this).nextAll().show();
});



}); 
