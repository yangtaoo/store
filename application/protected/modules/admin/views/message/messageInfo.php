<body class="bootstrap-admin-with-small-navbar">
    <!-- small navbar -->
    <?php include __DIR__ . "/../public/nav.php"?>

    <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            <!-- left, vertical navbar -->
            <?php include __DIR__ . "/../public/left.php"?>

            <!-- content -->
            <div class="main">
                <div class="row">
                    <div class="">
                        <div class="page-header bootstrap-admin-content-title">
                            <h1>查看留言</h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="">

                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" method="post">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">留言用户</label>
                                            <div class="col-lg-10">
                                                <div class="pt7"><?php echo $row['nickname'] ?></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">头像</label>
                                            <div class="col-lg-10">
                                                <div class="pt7"><img src="<?php echo $row['headimgurl'] ?>" alt="-" width="60" height="60"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">姓名</label>
                                            <div class="col-lg-10">
                                                <div class="pt7"><?php echo $row['name'] ?></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">手机</label>
                                            <div class="col-lg-10">
                                                <div class="pt7"><?php echo $row['phone'] ?></div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">留言时间</label>
                                            <div class="col-lg-10">
                                                <div class="pt7"><?php echo date('Y-m-d H:i', $row['add_time']) ?></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">留言内容</label>
                                            <div class="col-lg-10">
                                                <div class="pt7"><?php echo $row['content'] ?></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">&nbsp;</label>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput"></label>
                                            <div class="col-lg-10">
                                                <button type="submit" onClick="history.back();" class="btn btn-big btn-primary">返 回</button>
                                            </div>
                                        </div>

                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include __DIR__ . "/../public/foot.php"?>
</body>