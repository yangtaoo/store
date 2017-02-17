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
                        <h1>基础设置</h1>
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
                                        <label class="col-lg-2 control-label" for="focusedInput">网站名称</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="website_name" name="website_name" value="<?php echo isset($baseSet['website_name']) ? $baseSet['website_name'] : '' ?>" type="text" placeholder="请输入网站名称..."></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput">网站标题</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="website_title" name="website_title" value="<?php echo isset($baseSet['website_title']) ? $baseSet['website_title'] : '' ?>" type="text" placeholder="请输入网站标题..."></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput">网站关键字</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="website_keywords" name="website_keywords" value="<?php echo isset($baseSet['website_keywords']) ? $baseSet['website_keywords'] : '' ?>" type="text" placeholder="请输入网站关键字...">
                                            <p class="help-block">多个关键字之间用英文逗号(,)隔开</p>
                                        </div>
                                    </div>
                                    <?php if (!empty($baseSet['website_image'])) {?>
                        <div class="form-group" id="website_image">
                            <label class="col-lg-2 control-label" >当前图片</label>
                            <div class="col-lg-10">
                                <img src="<?php echo $baseSet['website_image'] ?>
                                " style="width: 80px;height: 80px" />
                                <a href="javascript:void(0)" onClick="$('#website_image').remove();">删除当前图片</a>
                            </div>
                            <input type="hidden" name="website_img" value="<?php echo $baseSet['website_image'] ?>" /></div>
                        <?php }?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" >网站LOGO</label>
                            <div class="col-lg-10">
                                <input type="file" name="website_image" />
                                <p class="help-block">不上传则默认使用当前图片</p>
                            </div>
                        </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput">网站描述</label>
                                        <div class="col-lg-10">
                                            <textarea id="website_description" name="website_description" class="form-control textarea-wysihtml5" placeholder="请输入网站描述..." style="width: 100%; height: 200px"><?php echo isset($baseSet['website_description']) ? $baseSet['website_description'] : '' ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" >关于我们</label>
                                        <div class="col-lg-10">
                                        <textarea id="ckeditor_full" name="site_introduction"><?php echo isset($baseSet['site_introduction']) ? $baseSet['site_introduction'] : '' ?></textarea>
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
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/vendors/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/vendors/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
     $(function(){
        $('textarea#ckeditor_full').ckeditor({
                    height: '200px'
                });
     })
</script>
