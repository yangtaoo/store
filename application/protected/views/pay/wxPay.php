<script type="text/javascript">
    //调用微信JS api 支付
    function jsApiCall() {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            <?php echo $jsApiParameters; ?>,
            function (res) {
                WeixinJSBridge.log(res.err_msg);
                if (res.err_msg == "get_brand_wcpay_request:ok") {
                    $.ajax({
                        type:'post',
                        url:'/order/AjaxOrderPay',
                        data:{ 'order_id':<?php echo $orderId ?> },
                        error:function(errormsg){
                            alert(errormsg);
                        },
                        success:function(msg){
                            if(msg.error == 1){
                                alert(msg.message);
                            }else{
                                alert("购买成功！");
                                window.location.href="/class";
                            }
                        }
                    });
                } else {
                    window.history.go(-1);
                    //alert('报名失败');
                }
            }
        );
    }
    function callpay() {
        if (typeof WeixinJSBridge == "undefined") {
            if (document.addEventListener) {
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            } else if (document.attachEvent) {
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        } else {
            jsApiCall();
        }
    }
    callpay();
</script>
<br>
<br>
<br>