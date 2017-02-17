<section>
    <div class="jigou">
        <div class="seach">
            <form action="/search/search" method="get">
                <input name="keyword" type="text" class="txt" placeholder="搜索拍卖机构或者博物馆" />
                <input name="" type="submit" class="btn" value="搜索" style="display:none;" />
                <div class="clear"></div>
            </form>
        </div>

        <!--搜索页 默认效果 开始-->
        <div class="seach_page1">
            <h3 class="seach_tit ft30 ">热门搜索</h3>
            <div class="seach_hot ft26">
            <?php foreach ($tagsSearch as $val): ?>
                <a href="/search/search?keyword=<?php echo $val; ?>"><?php echo $val; ?></a>
            <?php endforeach;?>
            </div>
            <h3 class="seach_tit ft30">历史搜索</h3>
            <div class="seach_lishi">
                <ul>
                    <?php foreach ($searchHistory as $val): ?>
                    <li><a href="/search/search?keyword=<?php echo $val; ?>"><?php echo $val; ?></a></li>
                <?php endforeach;?>
                </ul>
            </div>
        </div>
        <!--搜索页 默认效果 结束-->

        <!--当搜索框里面输入一个文字后就显示这里  开始-->
        <div class="seach_page2" style="display:none;">
            <!-- <div class="seach_list">
                <ul>
                    <li><a href="#">我是输入后显示的内容</a></li>
                    <li><a href="#">腾睿文化集团</a></li>
                    <li><a href="#">故宫博物院</a></li>
                    <li><a href="#">保利拍卖</a></li>
                </ul>
            </div> -->
        </div>
        <!--当搜索框里面输入一个文字后就显示这里  结束-->

    </div>

</section>
<?php include __DIR__ . '/../public/footer.php';?>