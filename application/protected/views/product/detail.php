<section>
    <div class="xiangxi">
        <div class="img"><a href="/product/360Images?id=<?php echo $productInfo['id'] ?>"><p><img src="<?php echo $productInfo['img'] ?>" /></p></a></div>
        <div class="info">
            <h1><?php echo $productInfo['name'] ?></h1>
            <p class="love_yes"><em><img src="/images/love.png" /></em><i><img src="/images/love_yes.png" /></i></p>
            <p class="money2"><i>￥</i><?php echo $productInfo['min_price'] ?>-<i>￥</i><?php echo $productInfo['max_price'] ?></p>
        </div>
        <div class="xx_jigou"><a href="<?php echo $productInfo['agency_id'] ?>"><img src="/images/jigou.jpg" /><p class="fl"><?php echo $productInfo['agency_name'] ?></p></a><a href="#" class="a_guanzhu">+ 关注</a>
            <div class="clear"></div>
        </div>
        <div class="jieshao">
            <div class="tit2">拍品介绍</div>
            <div class="jieshao_text">
                <p><span class="sp_1"><i>类别：</i><?php echo $productInfo['category_name'] ?></span><span class="sp_2"><i>年代：</i><?php echo $productInfo['decade'] ?></span><span class="sp_1"><i>重量：</i>10kg</span></p>
                <p><i>尺寸：</i>长<?php echo $productInfo['long'] ?>m 宽<?php echo $productInfo['width'] ?>cm 高<?php echo $productInfo['height'] ?>cm</p>
            </div>
            <div class="jieshao_main ft34">
                <?php $productInfo['details'] ?>
            </div>
        </div>
    </div>
</section>