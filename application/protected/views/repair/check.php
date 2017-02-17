<section>
  <div  class="moblie_tit">
      <select name="" onchange="window.location.href='?size='+this.value">
            <?php foreach($size as $key => $val){ ?>
          <option value="<?php echo $key; ?>"<?php echo $key == $sizeType ? ' selected' : '' ?>><?php echo $val['name'] ?></option>
            <?php } ?>
        </select>
        <p><a href="javascript:void(0);" class="hover">正面</a><a href="javascript:void(0);">背面</a><a href="javascript:void(0);">底部</a></p>
        <div class="clear"></div>
    </div>
    <?php if($sizeType == 'iPhone4'){ ?>
   <div class="moblie" id="iphone4">
   	<ul id="m_zhengmian">
    <img src="/images/iphone4-front.png"><a href="javascript:void(0);" repair_name="耳机接口" repair_content="耳机接口" repair_price="120" class="a_erji" title="耳机接口"></a>
    <a href="javascript:void(0);" repair_name="睡眠/唤醒按钮" repair_content="睡眠/唤醒按钮" repair_price="120" class="a_shuimian" title="睡眠/唤醒按钮"></a>
    <a href="javascript:void(0);" repair_name="响铃/静音开关 音量按钮" repair_content="响铃/静音开关 音量按钮" repair_price="120" class="a_yingliang" title="响铃/静音开关 音量按钮"></a>
    <a href="javascript:void(0);" repair_name="FaceTime摄像头 听筒" repair_content="FaceTime摄像头 听筒" repair_price="120" class="a_shexiangtou" title="FaceTime摄像头 听筒"></a>
    <a href="javascript:void(0);" repair_name="Multi-Touch 显示屏" repair_content="Multi-Touch 显示屏" repair_price="200" class="a_xianshiping" title="Multi-Touch 显示屏"></a>
    <a href="javascript:void(0);" repair_name="中框" repair_content="中框" repair_price="100" class="a_zhongkuang" title="中框"></a>
    <a href="javascript:void(0);" repair_name="主屏幕按钮" repair_content="主屏幕按钮" repair_price="100" class="a_home" title="主屏幕按钮"></a>
    </ul>
   	<ul class="hide" id="m_beimian">
   	<img src="/images/iphone4-back.png">
    <a href="javascript:void(0);" repair_name="iSight 摄像头" repair_content="iSight 摄像头" repair_price="150" class="a_shexiangtou2" title="iSight摄像头"></a>
    <a href="javascript:void(0);" repair_name="电池" repair_content="电池" repair_price="130" class="a_dianchi" title="电池"></a>
    <a href="javascript:void(0);" repair_name="后盖" repair_content="后盖" repair_price="40" class="a_hougai" title="后盖"></a>
    </ul>
   
   	<ul class="hide" id="m_dibu">
   	<img src="/images/iphone4-footer.png">
    <a href="javascript:void(0);" repair_name="数据线接口麦克风" repair_content="数据线接口麦克风" repair_price="100" class="a_shujuxian" title="数据线接口麦克风"></a>
    <a href="javascript:void(0);" repair_name="扬声器" repair_content="扬声器" repair_price="120" class="a_yangshengqi" title="扬声器"></a>
    </ul>
   </div>
    <?php } ?>
   
    <?php if($sizeType == 'iPhone4s'){ ?>
    <div class="moblie" id="iphone4s">
   	<ul id="m_zhengmian">
    <img src="/images/iphone4s-front.png"><a href="javascript:void(0);" repair_name="耳机接口" repair_content="耳机接口" repair_price="130" class="a_erji" title="耳机接口"></a>
    <a href="javascript:void(0);" repair_name="睡眠/唤醒按钮" repair_content="睡眠/唤醒按钮" repair_price="130" class="a_shuimian" title="睡眠/唤醒按钮"></a>
    <a href="javascript:void(0);" repair_name="响铃/静音开关 音量按钮" repair_content="响铃/静音开关 音量按钮" repair_price="130" class="a_yingliang" title="响铃/静音开关 音量按钮"></a>
    <a href="javascript:void(0);" repair_name="后盖" repair_content="FaceTime摄像头 听筒" repair_price="130" class="a_shexiangtou" title="FaceTime摄像头 听筒"></a>
    <a href="javascript:void(0);" repair_name="Multi-Touch 显示屏" repair_content="Multi-Touch 显示屏" repair_price="130" class="a_xianshiping" title="Multi-Touch 显示屏"></a>
    <a href="javascript:void(0);" repair_name="中框" repair_content="中框" repair_price="130" class="a_zhongkuang" title="中框"></a>
    <a href="javascript:void(0);" repair_name="主屏幕按钮" repair_content="主屏幕按钮" repair_price="130" class="a_home" title="主屏幕按钮"></a>
    </ul>
   	<ul class="hide" id="m_beimian">
   	<img src="/images/iphone4s-back.png">
    <a href="javascript:void(0);" repair_name="iSight摄像头" repair_content="iSight摄像头" repair_price="200" class="a_shexiangtou2" title="iSight摄像头"></a>
    <a href="javascript:void(0);" repair_name="电池" repair_content="电池" repair_price="120" class="a_dianchi" title="电池"></a>
    <a href="javascript:void(0);" repair_name="后盖" repair_content="后盖" repair_price="40" class="a_hougai" title="后盖"></a>
    </ul>
   
   	<ul class="hide" id="m_dibu">
   	<img src="/images/iphone4s-footer.png">
    <a href="javascript:void(0);" repair_name="数据线接口麦克风" repair_content="数据线接口麦克风" repair_price="100" class="a_shujuxian" title="数据线接口麦克风"></a>
    <a href="javascript:void(0);" repair_name="扬声器" repair_content="扬声器" repair_price="120" class="a_yangshengqi" title="扬声器"></a>
    </ul>
   </div>
    <?php } ?>
    
    <?php if($sizeType == 'iPhone5'){ ?>
    <div class="moblie" id="iphone5">
   	<ul id="m_zhengmian">
    <img src="/images/iphone5-front.png"><a href="javascript:void(0);" repair_price="160" class="a_shuimian" title="睡眠/唤醒按钮"></a>
    <a href="javascript:void(0);" class="a_yingliang" repair_price="160" title="响铃/静音开关 音量按钮"></a>
    <a href="javascript:void(0);" class="a_shexiangtou" repair_price="120" title="FaceTime摄像头 听筒"></a>
    <a href="javascript:void(0);" class="a_xianshiping" repair_price="300" title="Multi-Touch 显示屏"></a>
    <a href="javascript:void(0);" class="a_zhongkuang" repair_price="160" title="中框"></a>
    <a href="javascript:void(0);" class="a_home" repair_price="120" title="主屏幕按钮"></a>
    </ul>
   	<ul class="hide" id="m_beimian">
   	<img src="/images/iphone5-back.png">
    <a href="javascript:void(0);" class="a_shexiangtou2" repair_price="150" title="iSight摄像头"></a>
    <a href="javascript:void(0);" class="a_dianchi" repair_price="180" title="电池"></a>
   	</ul>
   
   	<ul class="hide" id="m_dibu">
   	<img src="/images/iphone5-footer.png">
    <a href="javascript:void(0);" class="a_erji" repair_price="150" title="Lighrtning接口 耳机接口 麦克风"></a>
    <a href="javascript:void(0);" class="a_yangshengqi" repair_price="150" title="扬声器"></a>
    </ul>
   </div>
    <?php } ?>
    
    <?php if($sizeType == 'iPhone5c'){ ?>
    <div class="moblie" id="iphone5c">
   	<ul id="m_zhengmian">
    <img src="/images/iphone5c-front.png"><a href="javascript:void(0);" repair_price="150"class="a_shuimian" title="睡眠/唤醒按钮"></a>
    <a href="javascript:void(0);" repair_price="150"class="a_yingliang" title="响铃/静音开关 音量按钮"></a>
    <a href="javascript:void(0);" repair_price="120"class="a_shexiangtou" title="FaceTime摄像头 听筒"></a>
    <a href="javascript:void(0);" repair_price="300"class="a_xianshiping" title="Multi-Touch 显示屏"></a>
    <a href="javascript:void(0);" repair_price="150"class="a_zhongkuang" title="中框"></a>
    <a href="javascript:void(0);" repair_price="120"class="a_home" title="主屏幕按钮"></a>
    </ul>
   	<ul class="hide" id="m_beimian">
   	<img src="/images/iphone5c-back.png">
    <a href="javascript:void(0);" repair_price="150"class="a_shexiangtou2" title="iSight 摄像头 True Tone 闪光灯"></a>
    <a href="javascript:void(0);" repair_price="180"class="a_dianchi" title="内置充电电池"></a>
   	</ul>
   
   	<ul class="hide" id="m_dibu">
   	<img src="/images/iphone5c-footer.png">
    <a href="javascript:void(0);" repair_price="150"class="a_erji" title="Lighrtning接口 耳机接口 麦克风"></a>
    <a href="javascript:void(0);" repair_price="150"class="a_yangshengqi" title="扬声器"></a>
    </ul>
   </div>
    <?php } ?>
    
    <?php if($sizeType == 'iPhone5s'){ ?>
    <div class="moblie" id="iphone5s">
   	<ul id="m_zhengmian">
    <img src="/images/iphone5s-front.png"><a href="javascript:void(0);" repair_price="150" class="a_shuimian" title="睡眠/唤醒按钮"></a>
    <a href="javascript:void(0);" repair_price="150" class="a_yingliang" title="响铃/静音开关 音量按钮"></a>
    <a href="javascript:void(0);" repair_price="120" class="a_shexiangtou" title="FaceTime摄像头 听筒"></a>
    <a href="javascript:void(0);" repair_price="400" class="a_xianshiping" title="Multi-Touch 显示屏"></a>
    <a href="javascript:void(0);" repair_price="150" class="a_zhongkuang" title="中框"></a>
    <a href="javascript:void(0);" repair_price="150" class="a_home" title="主屏幕按钮"></a>
    </ul>
   	<ul class="hide" id="m_beimian">
   	<img src="/images/iphone5s-back.png">
    <a href="javascript:void(0);" repair_price="320" class="a_shexiangtou2" title="iSight摄像头"></a>
    <a href="javascript:void(0);" repair_price="180" class="a_dianchi" title="电池"></a>
   	</ul>
   
   	<ul class="hide" id="m_dibu">
   	<img src="/images/iphone5s-footer.png">
    <a href="javascript:void(0);" repair_price="150" class="a_erji" title="Lighrtning接口 耳机接口 麦克风"></a>
    <a href="javascript:void(0);" repair_price="150" class="a_yangshengqi" title="扬声器"></a>
    </ul>
   </div>
    <?php } ?>
    
    <?php if($sizeType == 'iPhone6'){ ?>
    <div class="moblie" id="iphone6">
   	<ul id="m_zhengmian">
    <img src="/images/iphone6-front.png"><a href="javascript:void(0);" repair_price="250" class="a_shuimian" title="睡眠/唤醒按钮"></a>
    <a href="javascript:void(0);" repair_price="250" class="a_yingliang" title="响铃/静音开关 音量按钮"></a>
    <a href="javascript:void(0);" repair_price="300" class="a_shexiangtou" title="FaceTime摄像头 听筒"></a>
    <a href="javascript:void(0);" repair_price="900" class="a_xianshiping" title="Multi-Touch 显示屏"></a>
    <a href="javascript:void(0);" repair_price="250" class="a_zhongkuang" title="中框"></a>
    <a href="javascript:void(0);" repair_price="300" class="a_home" title="主屏幕按钮"></a>
    </ul>
   	<ul class=" " id="m_beimian">
   	<img src="/images/iphone6-back.png">
    <a href="javascript:void(0);" repair_price="520" class="a_shexiangtou2" title="iSight摄像头"></a>
    <a href="javascript:void(0);" repair_price="250" class="a_dianchi" title="电池"></a>
   	</ul>
   
   	<ul class=" " id="m_dibu">
   	<img src="/images/iphone6-footer.png">
    <a href="javascript:void(0);" repair_price="230" class="a_erji" title="Lighrtning接口 耳机接口 麦克风"></a>
    <a href="javascript:void(0);" repair_price="250" class="a_yangshengqi" title="扬声器"></a>
    </ul>
   </div>
    <?php } ?>
    
    <?php if($sizeType == 'iPhone6Plus'){ ?>
    <div class="moblie" id="iphone6plus">
   	<ul id="m_zhengmian">
    <img src="/images/iphone6plus-front.png"><a href="javascript:void(0);" repair_price="230" class="a_shuimian" title="睡眠/唤醒按钮"></a>
    <a href="javascript:void(0);" repair_price="250" class="a_yingliang" title="响铃/静音开关 音量按钮"></a>
    <a href="javascript:void(0);" repair_price="330" class="a_shexiangtou" title="FaceTime摄像头 听筒"></a>
    <a href="javascript:void(0);" repair_price="1400" class="a_xianshiping" title="Multi-Touch 显示屏"></a>
    <a href="javascript:void(0);" repair_price="250" class="a_zhongkuang" title="中框"></a>
    <a href="javascript:void(0);" repair_price="320" class="a_home" title="主屏幕按钮"></a>
    </ul>
   	<ul class="hide" id="m_beimian">
   	<img src="/images/iphone6plus-back.png">
    <a href="javascript:void(0);" repair_price="600" class="a_shexiangtou2" title="iSight摄像头"></a>
    <a href="javascript:void(0);" repair_price="250" class="a_dianchi" title="电池"></a>
   	</ul>
   
   	<ul class="hide" id="m_dibu">
   	<img src="/images/iphone6plus-footer.png">
    <a href="javascript:void(0);" repair_price="230" class="a_erji" title="Lighrtning接口 耳机接口 麦克风"></a>
    <a href="javascript:void(0);" repair_price="300" class="a_yangshengqi" title="扬声器"></a>
    </ul>
   </div>
    <?php } ?>
    
</section> 

<!--维修报价--> 
<div class="demo_weixiu" style="display: none;">
	<h1>故障维修<a href="javascript:void(0)" class="close3"><img src="/images/close.png"></a></h1>
	<table width="100%" border="0" cellspacing="1" >
  <tr>
    <th scope="row" width="30%">损坏部位</th>
    <td id="repair_name">耳机接口 </td>
  </tr>
  <tr> 
    <th scope="row">维修内容</th>
    <td id="repair_content">耳机接口</td>
  </tr>
  <tr>
    <th scope="row">维修报价</th>
    <td><span id="repair_price">￥150</span></td>
  </tr>
</table>

</div>
<div class="bg" style="display: none"></div>