<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo BaseModel::getInstance()->getSiteName('website_title') . $this->title; ?></title>
        <meta name="keywords" content="<?php echo BaseModel::getInstance()->getSiteName('website_keywords'); ?>" />
        <meta name="description" content="<?php echo BaseModel::getInstance()->getSiteName('website_description'); ?>"/>
        <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport" />
        <link rel="stylesheet" href="/css/style85.css">
        <script src="/js/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="/js/scrpit.js"></script>
        <script type="text/javascript"  src="/js/TouchSlide.1.1.js"></script>

    </head>
        <body>
            <?php echo $content; ?>

        </body>
</html>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
<script type="text/javascript">
<?php $param = static::$shareParam;?>
    wx.config({
        debug:false,
        appId:'<?php echo $param['config']['app_id']; ?>',
        timestamp:'<?php echo $param['config']['timestamp']; ?>',
        nonceStr:'<?php echo $param['config']['nonceStr']; ?>',
        signature:'<?php echo $param['config']['signature']; ?>',
        jsApiList:['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone']
    });

   wx.ready(function(){
     //分享朋友圈设置
    wx.onMenuShareTimeline({
        <?php echo !empty($param['param']['title']) ? "title:'" . $param['param']['title'] . "',\r\n" : ''; ?>
        <?php echo !empty($param['param']['link']) ? "link:'" . $param['param']['link'] . "',\r\n" : ''; ?>
        <?php echo !empty($param['param']['img_url']) ? "imgUrl:'" . $param['param']['img_url'] . "',\r\n" : ''; ?>
        success:function(){
        },
        cancel:function(){

        }
    });
    //分享QQ空间
    wx.onMenuShareQZone({
        title:'<?php echo isset($param['param']['title']) ? $param['param']['title'] : ''; ?>',
        desc:'<?php echo isset($param['param']['desc']) ? $param['param']['desc'] : ''; ?>',
        link:'<?php echo isset($param['param']['link']) ? $param['param']['link'] : ''; ?>',
        imgUrl:'<?php echo isset($param['param']['img_url']) ? $param['param']['img_url'] : ''; ?>',
        success:function(){
        },
        cancel:function(){

        }
    });
    //分享到腾讯微博
    wx.onMenuShareWeibo({
        title:'<?php echo isset($param['param']['title']) ? $param['param']['title'] : ''; ?>',
        desc:'<?php echo isset($param['param']['desc']) ? $param['param']['desc'] : ''; ?>',
        link:'<?php echo isset($param['param']['link']) ? $param['param']['link'] : ''; ?>',
        imgUrl:'<?php echo isset($param['param']['img_url']) ? $param['param']['img_url'] : ''; ?>',
        success:function(){
        },
        cancel:function(){

        }
    });
    //分享到朋友
    wx.onMenuShareAppMessage({
        title:'<?php echo isset($param['param']['title']) ? $param['param']['title'] : ''; ?>',
        desc:'<?php echo isset($param['param']['desc']) ? $param['param']['desc'] : ''; ?>',
        link:'<?php echo isset($param['param']['link']) ? $param['param']['link'] : ''; ?>',
        imgUrl:'<?php echo isset($param['param']['img_url']) ? $param['param']['img_url'] : ''; ?>',
        success:function(){
        },
        cancel:function(){

        }
    });
    //分享到QQ
    wx.onMenuShareQQ({
        title:'<?php echo isset($param['param']['title']) ? $param['param']['title'] : ''; ?>',
        desc:'<?php echo isset($param['param']['desc']) ? $param['param']['desc'] : ''; ?>',
        link:'<?php echo isset($param['param']['link']) ? $param['param']['link'] : ''; ?>',
        imgUrl:'<?php echo isset($param['param']['img_url']) ? $param['param']['img_url'] : ''; ?>',
        success:function(){
        },
        cancel:function(){

        }
    });
   });
</script>
