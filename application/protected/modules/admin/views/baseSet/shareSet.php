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
                        <h1>分享设置</h1>
                    </div>
                </div>
            </div>

            <?php if ($updateStatu === true) {?>
            <div class="alert alert-success">
                <a class="close" data-dismiss="alert" href="#">×</a> <strong>Success!</strong>
                数据更新成功！
            </div>
            <?php }?>
            <?php if ($updateStatu === false) {?>
            <div class="alert alert-danger">
                <a class="close" data-dismiss="alert" href="#">×</a> <strong>Error!</strong>
                数据更新失败！
            </div>
            <?php }?>
            <div class="row">
                <div class=" ">
                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput">分享标题</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="title" value="<?php echo isset($param['title']) ? $param['title'] : '' ?>" type="text" placeholder="请输入分享标题..."></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput">分享描述</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" name="desc" value="<?php echo isset($param['desc']) ? $param['desc'] : '' ?>" type="text" placeholder="请输入分享描述..."></div>
                                    </div>

                       <?php if (!empty($param['img_url'])) {?>
                        <div class="form-group" id="img_url">
                            <label class="col-lg-2 control-label" >当前图片</label>
                            <div class="col-lg-10">
                                <img src="<?php echo $param['img_url'] ?>
                                " style="width: 80px;height: 80px" />
                                <a href="javascript:void(0)" onClick="$('#img_url').remove();">删除当前图片</a>
                            </div>
                            <input type="hidden" name="img_url" value="<?php echo $param['img_url'] ?>" /></div>
                        <?php }?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" >分享图标</label>
                            <div class="col-lg-10">
                                <input type="file" name="upload_img" />
                                <p class="help-block">不上传则默认使用当前图片</p>
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
<?php include __DIR__ . "/../public/foot.php"?>
</body>
