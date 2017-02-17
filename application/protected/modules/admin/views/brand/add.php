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

                <div class="panel panel-default bootstrap-admin-no-table-panel">
                    <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                        
                        <div id="rootwizard">
                            <div class="page-header bootstrap-admin-content-title">
                                            <h1 class="fl">添加品牌</h1><span class="fr">
                                            <button class="btn xiao btn-default" onclick="location.href='/admin/brand'">&lt; 返回品牌列表</button></span>
                                            <div class="clear"></div>
                                        </div>
                            <?php if ($status['status'] === true) { ?>
                                <div class="alert alert-success">
                                    <a class="close" data-dismiss="alert" href="#">×</a>
                                    <strong>Success!</strong> <?php echo $status['message'] ?>
                                </div>
                            <?php } ?>
                            <?php if ($status['status'] === false) { ?>
                                <div class="alert alert-danger">
                                    <a class="close" data-dismiss="alert" href="#">×</a>
                                    <strong>Error!</strong> <?php echo $status['message'] ?>
                                </div>
                            <?php } ?>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <form class="form-horizontal" method="post" enctype="multipart/form-data" >
                                        <input type="hidden" name="id" value="<?php echo $id ?>" />
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" >品牌名</label>
                                                <div class="col-lg-10">
                                                    <input class="form-control" name="brand_name" type="text" value="<?php echo $param['brand_name'] ?>">
                                                </div>
                                            </div>
                                            <?php if (!empty($param['brand_logo'])) { ?>
                                                <div class="form-group" id="img_url">
                                                    <label class="col-lg-2 control-label" >当前品牌图片</label>
                                                    <div class="col-lg-10">
                                                        <img src="<?php echo $param['brand_logo'] ?>" style="width: 200px;height: 200px" /><a href="javascript:void(0)" onClick="$('#img_url').remove();">删除当前图片</a>
                                                    </div>
                                                    <input type="hidden" name="brand_logo" value="<?php echo $param['brand_logo'] ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-2 control-label" >替换品牌logo</label>
                                                    <div class="col-lg-10">
                                                        <input type="file" name="brand_logo_file" />
                                                        <p class="help-block">请上传logo图片</p>
                                                    </div>
                                                </div>
                                            <?php }else{ ?>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" >品牌logo</label>
                                                <div class="col-lg-10">
                                                    <input type="file" name="brand_logo_file" />
                                                    <p class="help-block">请上传logo图片</p>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">品牌描述</label>
                                                <div class="col-lg-10">
                                                    <textarea rows="6" name="brand_info" class="form-control textarea-wysihtml5"cols="40" ><?php echo $param['brand_info'] ?></textarea>
                                                    <p class="help-block">品牌描述信息</p>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput"></label>
                                                <div class="col-lg-10">

                                                    <button type="submit" class="btn btn-primary">提 交</button>
                                                    <button type="button" onClick="history.go(-1)" class="btn btn-danger">返 回</button>
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
    </div>

    <!-- footer -->
    <?php include __DIR__ . "/../public/foot.php" ?>

</body>
