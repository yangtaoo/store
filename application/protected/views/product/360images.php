
<style type="text/css">
    * {margin:0; padding:0; list-style:none;}
    body {background:#fef4e5; color:#fff; height:100%; }
    .img { position:absolute; overflow:hidden;  top:50%; width:100%; z-index:333;}
    .images1 img { width:100%;}
    .tishi {z-index:777; top:50%; position:absolute; text-align:center; width:100%;}
    .tishi img {height:100%;}
    #load_img {position:absolute; width:100%; z-index:888; top:50%;  margin-top:-130px;   text-align:center;   } 
    #load_text { color:#e48d03; padding-top:90px; line-height:1.6rem; width:100%;  position:absolute; z-index:888; top:50%; text-align:center;margin-top:-120px;z-index:999; }
    #load_text b {  font-size:1.6rem; font-family:Arial, Helvetica, sans-serif; display:block;  }
    #load_img img { width:260px;
        -webkit-animation:circle 10s infinite linear;/*匀速 循环*/}
    @-webkit-keyframes circle{
        0%{ transform:rotate(0deg); }
        100%{ transform:rotate(360deg); }
    }
.kong5 { position:absolute; width:100%; left:0; top:0; z-index:1; }
.kong5 img  {width:100%;}
    @media screen and (max-width: 500px) { 
        .tishi { height:300px; margin-top:-150px;
        }
    }
    @media screen and (max-width: 400px) { 
        .tishi { height:250px; margin-top:-125px;
        }
    }
    @media screen and (max-width: 330px) { 
        .tishi { height:220px; margin-top:-110px;
        }
    }
    .bg {background:#000; filter:alpha(opacity=60);-moz-opacity:0.6; opacity:0.6; height:100%; position:absolute; width:100%; z-index:666; } 
</style>
<script type="text/javascript">
    window.onload = function () {
		var b= $(window).height();
        var h = $(".images1 img").height();
		var m = b-h;
        $(".images1").css("margin-top", m / 2 + "px");
        $("body").mouseover(function () {
            $(".bg").hide();
            $(".tishi").hide();
        });
    };

    var loaded = 0;
	var bb= $(window).height();
    var imageNum = <?php echo count($product360Images) ?>;
    function imageLoad() {
        loaded++;
        var loadText = "" + parseInt(loaded / imageNum * 100) + "%";
        $("#load_text b").html(loadText);
        if (loaded == imageNum) {
            $("#load_text").hide();
            $("#load_img").hide();
            $(".kong5").hide();
            $("body").css("background-color","#000000");
            $("#image_div").show();
        }
    }
</script>
<div id="load_text">加载中<b>0%</b></div>
<div id="load_img">
	<p><img src="/images/quan0.png" /></p>
</div>
<div id="image_div" style="display:none;">
    <div class="tishi"><img src="/images/touch2.png" /></div>
    <div class="bg"></div>
    <div id="images1" class="images1">
        <?php foreach ($product360Images as $key => $val) { ?>
            <img<?php echo $key != 0 ? ' style="display:none;"' : '' ?> number=<?php echo $key + 1 ?> src="<?php echo $val['image_url'] ?>" onload="imageLoad()" />
        <?php } ?>
    </div>
</div>

<div class="kong5"><img src="/images/loading_bjt3.jpg"></div>
<script type="text/javascript">
    (function () {
        var el = document.querySelector('.images1');

        var startPosition, endPosition, deltaX, oldDeltaX, deltaY, oldDeltaY, moveLength, goTo;
        oldDeltaX = 0;
        oldDeltaY = 0;

        $(".tishi").bind('touchstart', function (e) {
            $('.bg').hide();
            $('.tishi').hide();
        });

        el.addEventListener('touchstart', function (e) {
            var touch = e.touches[0];
            startPosition = {
                x: touch.pageX,
                y: touch.pageY
            }
        });
        el.addEventListener('touchmove', function (e) {
            e.preventDefault();
            var touch = e.touches[0];
            endPosition = {
                x: touch.pageX,
                y: touch.pageY
            }

            deltaX = endPosition.x - startPosition.x;
            deltaY = endPosition.y - startPosition.y;
            moveLength = Math.sqrt(Math.pow(Math.abs(deltaX), 2) + Math.pow(Math.abs(deltaY), 2));
            goTo = deltaX < oldDeltaX ? 'left' : 'right';
            imageClick(goTo, 1);
            if (moveLength > 0 && (moveLength / 10) == parseInt(moveLength / 10)) {

            }
            oldDeltaX = deltaX;
            oldDeltaY = deltaY;
            console.log(goTo);
        });
    })();


    function imageClick(type, id) {
        var images = $("#images" + id).find('img');
        var showNumber = 1;
        images.each(function () {
            if ($(this).css('display') != 'none') {
                $(this).hide();
                showNumber = $(this).attr('number');
            }
        });
        if (type == 'left') {
            showNumber--;
            showNumber = showNumber < 1 ? images.length : showNumber;
        } else {
            showNumber++;
            showNumber = showNumber > images.length ? 1 : showNumber;
        }
        showNumber--;
        $(images[showNumber]).show();
    }
</script>