<section>
    <div class="jigou">
        <div class="seach">
            <p class="ft26"><a href="/search/index">搜索拍卖机构或者博物馆</a></p>
        </div>
        <div id="leftTabBox" class="tabBox">
            <div class="hd tab_tit">
                <ul>
                    <li><a href="#">拍卖机构</a></li>
                    <li><a href="#">博物馆</a></li>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="bd jigou_list">

                <ul>
                <?php foreach ($agencyList as $val): if ($val['agency_type'] == 1): ?>

			                    <div class="xx_jigou"><a href="Agency/agencyDetail?id=<?php echo $val['id'] ?>">
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
			                <?php endif;endforeach;?>

                </ul>
                                    <!--以下是博物馆 -->

                <ul>
                   <?php foreach ($agencyList as $val): if ($val['agency_type'] == 2): ?>

		                        <div class="xx_jigou"><a href="Agency/agencyDetail?id=<?php echo $val['id'] ?>">
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
		                    <?php endif;endforeach;?>

                </ul>

            </div>
        </div>
        <script type="text/javascript">TouchSlide({slideCell: "#leftTabBox"});</script>

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
</script>
<?php include __DIR__ . '/../public/footer.php';?>