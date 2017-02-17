<!DOCTYPE html>
<html>
    <head>
        <title>腾睿互动微信解决方案－SAAS后台管理系统</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/css/bootstrap-admin-theme-change-size.css">

        <!-- Vendors -->
        <!-- (...) -->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <?php echo $content; ?>
    
    <script type="text/javascript">
        function searchGo(){

            $("#searchForm").submit();

        }
    </script>
</html>