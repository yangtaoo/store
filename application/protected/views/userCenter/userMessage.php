
<section>
<div class="liuyan">
    <form method="post">
    	<h3 class="ft30">姓名</h3>
    	<input name="name" type="text" value="<?php echo $data['name'] ?>" class="txt ft34"  placeholder="请输入您的姓名" required="" />
    	<h3 class="ft30">手机号</h3>
    	<input name="phone" class="txt ft34 " value="<?php echo $data['phone'] ?>" maxlength="11" type="tel" placeholder="请输入您的手机号码" required=""/>
    	<h3 class="ft30">我要留言</h3>
    	<textarea name="content" class="ft34 " required=""><?php echo $data['content'] ?></textarea>
    	<input type="submit" class="btn ft34" value="确认"/>
    </form>
</div>
</section>