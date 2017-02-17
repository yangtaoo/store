<section>
    <div class="main3">
    <?php foreach ($auctionList as $val) {?>
        <div class="img_box2">
            <a href="/auction/Detail?id=<?php echo $val['id'] ?>">
                <?php if ($val['start_time'] > time()) {?>
                <div class="time weikai"><b class="ft26">未开始</b><span  class="ft26"><?php echo date('m/d', $val['start_time']) ?>始</span></div>
                <?php } elseif ($val['end_time'] < time()) {?>
                <div class="time weikai"><b class="ft26">已结束</b><span  class="ft26"><?php echo date('m/d', $val['end_time']) ?>完</span></div>
                <?php } else {?>
                <div class="time kai"><b class="ft26">拍卖中</b><span  class="ft26"><?php echo date('m/d', $val['end_time']) ?>完</span></div>
                <?php }?>
                <p class="img"><img src="<?php echo $val['auction_img'] ?>" /></p>
                <div class="info">
                    <h3 class="ft34"><?php echo $val['name'] ?></h3>
                    <p class="ft26"><span class="fl"><?php echo $val['agency_name'] ?></span><span class="fr"><?php echo $val['count']; ?>人围观</span><div class="clear"></div></p>
                </div>
            </a>
        </div>
    <?php }?>
        <div class="clear"></div>
    </div>
<div class="kong"></div>
</section>