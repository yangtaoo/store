<link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/css/DT_bootstrap.css">
<link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/vendors/jGrowl/jquery.jgrowl.css">
<body class="bootstrap-admin-with-small-navbar">
    <!-- small navbar -->
    <?php include __DIR__ . "/../public/nav.php" ?>

    <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            <!-- left, vertical navbar -->
            <?php include __DIR__ . "/../public/left.php" ?>               

            <!-- content -->
            <div class="main">
                <div class="row">
                    <div class=" ">
                        <div class="page-header bootstrap-admin-content-title">
                            <h1>消费扣减</h1>
                        </div>
                    </div>
                </div>
                <?php if ($updateStatu['statu'] === 1) { ?>
                    <div class="alert alert-success">
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <strong>Success!</strong> <?php echo $updateStatu['message'] ?>
                    </div>
                <?php } ?>
                <?php if ($updateStatu['statu'] === 0) { ?>
                    <div class="alert alert-danger">
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <strong>Error!</strong> <?php echo $updateStatu['message'] ?>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class=" ">
                        <div class="panel panel-default">
                            <div class="bootstrap-admin-panel-content">
                                <div id="rootwizard">
                                    <div class="navbar">
                                        <div class="container">
                                            <ul class="nav nav-pills">
                                                <li><a href="/admin/User/index">会员列表</a></li>
                                                <li class="active"><a href="###">消费扣减</a></li>
                                            </ul>
                                            <div class="kong20"></div>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab1">
                                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="focusedInput">用户ID</label>
                                                    <div class="col-lg-10">
                                                        <?php echo $info['id'];?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="focusedInput">用户昵称</label>
                                                    <div class="col-lg-10">
                                                        <?php echo $info['nickname'];?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="focusedInput">过期时间</label>
                                                    <div class="col-lg-10">
                                                        <?php echo !empty($pluginInfo['expire_date']) ? $pluginInfo['expire_date'] : "过期";?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="focusedInput">可用次数</label>
                                                    <div class="col-lg-10">
                                                        <?php echo !empty($pluginInfo['available_times']) ? $pluginInfo['available_times'] : "过期";?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="name">扣减类型</label>
                                                    <div class="col-lg-10">
                                                        <select class="form-control" id="name" name="type">
                                                            <option value=0>天数</option>
                                                            <option value=1>次数</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="value">扣减值</label>
                                                    <div class="col-lg-10">
                                                        <input class="form-control" id="value" name="value" type="text" value=''>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label" for="focusedInput"></label>
                                                    <div class="col-lg-10">
                                                        <button type="submit" class="btn btn-primary">提 交</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include __DIR__ . "/../public/foot.php" ?>
    
</body>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/vendors/jGrowl/jquery.jgrowl.js"></script>