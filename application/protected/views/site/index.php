<section>
    <div class="banner_molie" >
        <div id="focus" class="focus">
            <div class="hd">
                <ul></ul>
            </div>
            <div class="bd">
                <b><a href="/search/homeSearch"><img src="/images/index_seach.png" /></a></b>
                <ul>
                <?php foreach ($homeImg as $val): ?>
                    <li><a href="<?php echo $val['img_link']; ?>">
                    <img _src="<?php echo $val['img_url']; ?>" src="<?php echo $val['img_url']; ?>"/></a></li>
                <?php endforeach;?>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            TouchSlide({
                slideCell: "#focus",
                titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                mainCell: ".bd ul",
                effect: "left",
                autoPlay: true, //自动播放
                autoPage: true, //自动分页
                switchLoad: "_src" //切换加载，真实图片路径为"_src"
            });
        </script>
    </div>
    <div class="index_fenlei main">
        <h2 class="index_tit ft30"><p><span>热门拍品</span></p></h2>
        <ul>
            <?php foreach ($tagsGoods as $val): ?>
            <li><a href="/auction/auctionGoodsDetail?id=<?php echo $val['id']; ?>&is_auction=no"><img src="<?php echo $val['img']; ?>" onerror="javascript:this.src='/images/nopic.jpg';"></a></li>
        <?php endforeach;?>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="index_fenlei main">
        <h2 class="index_tit ft30"><p><span>热门分类</span></p></h2>
        <ul>
            <?php foreach ($category as $val) {?>
            <li><a href="/category/auctiongoods?id=<?php echo $val['id'] ?>">
            <img src="<?php echo $val['tags_img'] ?>" title="<?php echo $val['name']; ?>" onerror="javascript:this.src='/images/nopic.jpg';" />
            </a></li>
            <?php }?>
            <div class="clear"></div>
        </ul>
    </div>
    <div class="index_jigou main">
        <p class="index_tit ft30">
        <a href="/agency/index">Hi，我们已有<b><?php echo $agencyNum['cnt'] ?></b>个机构入驻<img src="/images/jiantou1.jpg"/></a>
        </p>
        <ul>
            <?php foreach ($agencys as $val) {?>
            <li><a href="/agency/agencyDetail?id=<?php echo $val['id'] ?>"><img src="<?php echo $val['logo'] ?>" onerror="javascript:this.src='/images/nopic.jpg';" /><h3 class="ft30"><?php echo $val['name'] ?></h3><p class="ft26"><?php echo $val['count'] ?>件藏品</p></a></li>
            <?php }?>
            <div class="clear"></div>
        </ul>
    </div>
    <?php foreach ($categoryGoodsList as $val) {?>
    <div class="index_ciqi">
        <div class="tit_img">
        <a href="/category/auctiongoods?id=<?php echo $val['id'] ?>">
        <img src="<?php echo $val['home_list_img']; ?>"  width="100%" />
        </a>
        </div>
        <div class="main2">
            <?php foreach ($val['goodsList'] as $v) {?>
            <div class="img_box">
                <p class="<?php echo in_array($v['id'], $userConcern) ? 'love_yes' : 'love'; ?>">
                <em onclick="concern(this,<?php echo $v['id'] ?>)"><img src="/images/love.png" /></em>
                <i onclick="cancelConcern(this,<?php echo $v['id'] ?>)"><img src="/images/love_yes.png" /></i>
                </p>
                <a href="/auction/auctionGoodsDetail?id=<?php echo $v['id'] ?>&is_auction=no">
                    <p class="img"><img src="<?php echo $v['img'] ?>" onerror="javascript:this.src='/images/nopic.jpg';" /></p>
                    <h3 class="ft34"><?php echo $v['name'] ?></h3>
                    <p class="money"><i>￥</i><?php echo number_format($v['min_price']) ?>-<i>￥</i><?php echo number_format($v['max_price']) ?></p>
                    <p class="ft26"><?php echo $v['agency_name'] ?></p>
                </a>
            </div>
            <?php }?>
            <div class="clear"></div>
        </div>
    </div>
    <?php }?>
    <div class="kong"></div>
</section>
<script type="text/javascript">
    //关注拍品
    function concern(event,id) {
        $.post('/user/userConcern', {id: id,type:1}, function(data, textStatus, xhr) {
            var obj=eval('(' + data + ')');
            if(obj.status){
               $(event).parent('p').prop('class', 'love_yes');
            }else{
                alert(obj.msg);
            }
        });
    }

    //取消关注
    function cancelConcern(event,id) {
        $.post('/user/cancelConcern', {id: id,type:1}, function(data, textStatus, xhr) {
            var obj=eval('(' + data + ')');
            if(obj.status){
               $(event).parent('p').prop('class', 'love');
            }else{
                alert(obj.msg);
            }
        });
    }
</script>
<?php include __DIR__ . '/../public/footer.php';?>