<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>腾睿互动微信解决方案－SAAS后台管理系统</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
        <style type="text/css">
		body {background:url(<?php echo $this->module->assetsUrl; ?>/images/bodybg.jpg) no-repeat center center #423a4f;}
            .alert{
                margin: 0 auto 20px;
            }
			.logo_1 { text-align:center; height:30px;}
			.bootstrap-admin-login-form {max-width:500px;}
			.login_cont {width:360px; padding:30px 0 ; background:#fff; margin:0px auto; border-radius:10px;}
        </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bootstrap-admin-without-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    <form method="post" action="" class="bootstrap-admin-login-form">
                	<div class="logo_1"><img src="<?php echo $this->module->assetsUrl; ?>/images/logo-login.png" /></div>
                    <div class="login_cont">
                        <div class="form-group">
                            <input class="form-control" type="text" style="width:290px;" value="<?php echo $name ?>" name="username" required placeholder="用户名">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" style="width:290px;" value="<?php echo $pwd ?>" name="password" required placeholder="密码">
                        </div>
                        <div class="form-group" style="display:none;">
                            <label>
                                <input type="checkbox" name="remember_me">
                                记住我
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary" type="submit" style="width:290px;">登 录</button>
                        </div>
                        <p style="color:#fff; text-align:center; padding:20px 0;">版权所有：成都慧眼识藏文化有限公司</p><?php if($msg){ ?>
                    <div class="alert alert-info">
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                        <?php echo $msg; ?>
                    </div>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function() {
                // Setting focus
                $('input[name="email"]').focus();

                // Setting width of the alert box
                var alert = $('.alert');
                var formWidth = $('.bootstrap-admin-login-form').innerWidth();
                var alertPadding = parseInt($('.alert').css('padding'));

                if (isNaN(alertPadding)) {
                    alertPadding = parseInt($(alert).css('padding-left'));
                }

                $('.alert').width(formWidth - 2 * alertPadding);
            });
        </script>
    </body>
</html>
