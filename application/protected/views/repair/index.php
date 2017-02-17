<section>
    <div class="title"><h1>苹果</h1><div class="clear"></div></div>
    <div class="content">
        <?php foreach ($size as $key => $val) { ?>
            <div class="img_box ">
                <a href="Repair/check?size=<?php echo $key ?>">
                    <div class="img"><img src="<?php echo $val['img'] ?>" ></div>
                    <p class="text"><?php echo $val['name'] ?></p>
                </a>
            </div>
        <?php } ?>
    </div>

</section> 