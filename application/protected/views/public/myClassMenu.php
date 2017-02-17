<div class="title_tab t2"><a href="javascript:void(0)" onclick="classShowChange(this,'myClass')" class="hover">已预约</a><a href="javascript:void(0)" onclick="classShowChange(this,'myFinishClass')" >已完成</a><a href="javascript:void(0)" onclick="classShowChange(this,'myQueue')" >已排队</a><a href="javascript:void(0)" onclick="classShowChange(this,'myNotFinishClass')" >已旷课</a></div>
<script type="text/javascript">
    function classShowChange(obj,type){
        $(".title_tab").find('a').removeClass('hover');
        $(obj).addClass('hover');
        $(".main").hide();
        $("#"+type).fadeIn(200);
    }
    
</script>