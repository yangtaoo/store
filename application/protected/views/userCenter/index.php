<section>
    <div class="my">
        <div class="user ft34">
            <img src="<?php echo $userInfo['headimgurl']; ?>"><?php echo $userInfo['nickname']; ?>
        </div>
        <div class="my_data">
            <a href="<?php echo isset($concernCount[1]) ? '/userCenter/myAuctiongoods' : '#'; ?>">
            <p>
                <b class="ft50"><?php echo isset($concernCount[1]) ? $concernCount[1] : 0; ?></b><span class="ft26">拍品关注</span>
            </p>
            </a>
            <a href="<?php echo isset($concernCount[2]) ? '/userCenter/myAuction' : '#'; ?>">
            <p>
                <b class="ft50"><?php echo isset($concernCount[2]) ? $concernCount[2] : 0; ?></b><span class="ft26">拍卖会关注</span>
            </p>
            </a>
            <a href="<?php echo isset($concernCount[3]) ? '/userCenter/myAgency' : '#'; ?>">
            <p>
                <b class="ft50"><?php echo isset($concernCount[3]) ? $concernCount[3] : 0; ?></b><span class="ft26">机构关注</span>
            </p>
            </a>
            <div class="clear">
            </div>
        </div>
        <ul class="nav_list">
            <li class="ft34"><a href="/userCenter/userHistory"><img src="/images/wode_03.png">浏览历史</a></li>
        </ul>
        <ul class="nav_list">
            <li class="ft34"><a href="/userCenter/userMessage"><img src="/images/wode_07.png">我要留言</a></li>
            <div class="line"><p></p></div>
            <li class="ft34"><a href="/userCenter/about"><img src="/images/wode_10.png">关于我们</a></li>
        </ul>

    </div>
</section>
<?php include __DIR__ . '/../public/footer.php';?>