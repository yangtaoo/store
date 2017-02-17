<section>
<div class="main3">
	<div class="jigou">
        <?php foreach ($agencyList as $val): ?>
            <div class="xx_jigou"><a href="/Agency/agencyDetail?id=<?php echo $val['id'] ?>">
                <img src="<?php echo $val['logo'] ?>" />
                <div class="info">
                    <p class="ft34"><?php echo $val['name'] ?></p>
                    <p class="ft26"><?php echo $val['count'] ?>件拍品</p>
                </div>
                </a>
                    <span class="a_guanzhu ygz" onclick="cancelConcern(this,<?php echo $val['id'] ?>)">已关注</span>
                <div class="clear"></div>
             </div>
         <?php endforeach;?>
   </div>
</section>
<script type="text/javascript">
    //取消关注机构
    function cancelConcern(event,id){
        if(confirm('确定不在关注')){
            $.post('/user/cancelConcern', {id:id,type:3}, function(data, textStatus, xhr) {
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