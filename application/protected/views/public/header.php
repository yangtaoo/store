<header>
    <div class="user"><a href="/userCenter"><img src="<?php echo Yii::app()->session['userInfo']['headimgurl'] ? Yii::app()->session['userInfo']['headimgurl'] : '/images/user.jpg'; ?>"></a></div>
    <div class="weizhi"><img src="/images/icon_weizhi.png" />
        <select>
            <option value="合肥">合肥</option>
        </select>
        <select style="display:none;">
            <option value="金牛万达店">金牛万达店</option> 
            <option value="锦华万达店">万达店</option>
        </select></div>
</header> 