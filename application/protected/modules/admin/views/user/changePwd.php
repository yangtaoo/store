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
                            <h1>修改密码</h1>
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
                        <div class="panel panel-default bootstrap-admin-no-table-panel">
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" method="post">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">旧密码</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="old_pwd" name="old_pwd" style="width:300px;" value="<?php echo isset($pwdInfo['old_pwd']) ? $pwdInfo['old_pwd'] : '' ?>" type="password" placeholder="请输入当前密码...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">新密码</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="new_pwd" name="new_pwd" style="width:300px;"  value="<?php echo isset($pwdInfo['new_pwd']) ? $pwdInfo['new_pwd'] : '' ?>" type="password" placeholder="请输入新密码...">
                                                    <p class="help-block">英文、数字、特殊字符组成的6-12位密码</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">新密码验证</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="re_new_pwd" name="re_new_pwd" style="width:300px;"  value="<?php echo isset($pwdInfo['re_new_pwd']) ? $pwdInfo['re_new_pwd'] : '' ?>" type="password" placeholder="请重复新密码...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput"></label>
                                            <div class="col-lg-10">

                                                <button type="submit" class="btn btn-primary">提 交</button>
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
    <?php include __DIR__ . "/../public/foot.php" ?>
</body>