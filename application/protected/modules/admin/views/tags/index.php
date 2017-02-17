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
                        <h1>搜索热门设置</h1>
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
                                        <label class="col-lg-2 control-label" for="focusedInput">首页热门标签</label>
                                        <div class="col-lg-10">
                                            <textarea id="website_description" name="home_tags_tag" class="form-control textarea-wysihtml5" placeholder="请输入热门搜索关键字..." style="width: 100%; height: 200px"><?php echo isset($tagsSet['home_tags_tag']) ? $tagsSet['home_tags_tag'] : '' ?></textarea>
                                            <p class="help-block">多个关键字之间用英文逗号(,)隔开</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput">机构热门标签</label>
                                        <div class="col-lg-10">
                                            <textarea id="website_description" name="agency_tags_tag" class="form-control textarea-wysihtml5" placeholder="请输入热门搜索关键字..." style="width: 100%; height: 200px"><?php echo isset($tagsSet['agency_tags_tag']) ? $tagsSet['agency_tags_tag'] : '' ?></textarea>
                                            <p class="help-block">多个关键字之间用英文逗号(,)隔开</p>
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
<?php include __DIR__ . "/../public/foot.php"?></body>