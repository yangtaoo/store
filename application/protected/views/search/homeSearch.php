<section>
<div class="jigou">
	<div class="seach">
    <form action="/search/searchResult" method="get">
    	<input name="keyword" type="text" class="txt" placeholder="请输入您要搜索的内容" />
        <input type="submit" class="btn" value="搜索" style="display:none;" />
        <div class="clear"></div>
    </form>
    </div>

     <!--搜索页 默认效果  开始-->
     <div class="seach_page1">
         <h3 class="seach_tit ft26 ">热门搜索</h3>
         <div class="seach_hot ft26">
        <?php foreach ($tagsSearch as $val): ?>
	            <a href="/search/searchResult?keyword=<?php echo $val; ?>"><?php echo $val; ?></a>
	    <?php endforeach;?>
        </div>
         <h3 class="seach_tit ft26">历史搜索</h3>
        <div class="seach_lishi">
            <ul>
              <?php foreach ($searchHistory as $val): ?>
                    <li><a href="/search/searchResult?keyword=<?php echo $val; ?>"><?php echo $val; ?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
     <!--结束-->

     <!--当搜索框里面输入一个文字后就显示这里  开始-->
     <div class="seach_page2" style="display:none;">
        <!-- <div class="seach_list sl2 ft30">
            <ul>
                <li><a href="#">我是搜索的内容哟</a></li>
                <li><a href="#">我是搜索的内容哟</a></li>
                <li><a href="#">我是搜索的内容哟</a></li>
                <li><a href="#">我是搜索的内容哟</a></li>
            </ul>
        </div> -->
    </div>
     <!--结束-->


</div>

</section>