<script type="text/javascript">
    var basePath = '<?php echo $this->module->assetsUrl; ?>';
</script>
<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
    <div class="container">
        <div class="row">
            <div class=" ">
                <div class="collapse navbar-collapse">
                    <div class="logo">
                        <a href="/admin"><img src="<?php echo $this->module->assetsUrl; ?>/images/logo-cont.png" /></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> <?php echo Yii::app()->session['accountInfo']['AccountName']; ?> <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/User/ChangePwd">修改密码</a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="/admin/Login/LoginOut">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/admin">后台管理</a>
                </div>
                <div class="collapse navbar-collapse main-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown">系统管理 <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/User/ChangePwd">密码修改</a></li>
                                <li><a href="/admin/baseSet/index">基础设置</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown">用户数据 <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/User/index">用户管理</a></li>
                                <li><a href="/admin/message/index">留言反馈</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>