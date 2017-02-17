<section>
    <div class="fenlei">
    <?php foreach ($category as $val): ?>
        <div class="fenlei_box">
            <p><img src="<?php echo $val['list_img']; ?>" width="100%" /></p>
            <ul style="display:none;">
                <span><img src="/images/sanjiao.png" /></span>
                <?php if (isset($val['child'])) {foreach ($val['child'] as $v) {?>
                <li><a href="/Category/auctiongoods?id=<?php echo $v['id']; ?>"><?php echo $v['name']; ?></a></li>
                <?php }}?>
                <div class="clear"></div>
            </ul>
        </div>
    <?php endforeach;?>
<div class="kong"></div>
</section>
<?php include __DIR__ . '/../public/footer.php';?>