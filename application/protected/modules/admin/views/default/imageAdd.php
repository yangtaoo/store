
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

<div class="panel panel-default bootstrap-admin-no-table-panel">
    <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
        <div id="rootwizard">
        
        
    <div class="page-header bootstrap-admin-content-title">
                            <h1 class="fl">添加图片</h1><span class="fr"><button class="btn xiao btn-default" onClick="location.href='/admin/Default/imageList'">< 返回</button></span>
                            <div class="clear"></div>
                        </div>
                 
                 
<?php if ($status['status'] === true) {?>
    <div class="alert alert-success">
        <a class="close" data-dismiss="alert" href="#">×</a>
        <strong>Success!</strong> <?php echo $status['message'] ?>
    </div>
<?php }?>
            <?php if ($status['status'] === false) {?>
    <div class="alert alert-danger">
        <a class="close" data-dismiss="alert" href="#">×</a>
        <strong>Error!</strong> <?php echo $status['message'] ?>
    </div>
            <?php }?>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
<fieldset>

        <?php if (!empty($param['img_url'])) {?>
    <div class="form-group" id="img_url">
        <label class="col-lg-2 control-label" >当前图片</label>
        <div class="col-lg-10">
            <img src="<?php echo $param['img_url'] ?>" style="height: 100px" /><a href="javascript:void(0)" onClick="$('#img_url').remove();">删除当前图片</a>
        </div>
        <input type="hidden" name="img_url" value="<?php echo $param['img_url']; ?>" />
    </div>
<?php }?>
<div class="form-group">
        <label class="col-lg-2 control-label" >图片</label>
    <div class="col-lg-10">
        <input type="file" <?php if (empty($param['img_url'])) {
    echo 'required=""';
}
?> name="upload_img" />
        <p class="help-block">图片尺寸为750*450</p>
    </div>
</div>
        <div class="form-group">
            <label class="col-lg-2 control-label" >ALT</label>
            <div class="col-lg-10">
                <input class="form-control" name="alt" type="text" value="<?php echo $param['alt']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" >图片链接</label>
            <div class="col-lg-10">
                <input class="form-control" name="img_link" type="text" value="<?php echo $param['img_link']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" >描述</label>
            <div class="col-lg-10">
                <input class="form-control" name="intro" type="text" value="<?php echo $param['intro']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" >排序</label>
            <div class="col-lg-10">
                <input class="form-control" name="sort" required type="text" value="<?php echo $param['sort']; ?>">
            </div>
        </div>

            <div class="form-group">
            <label class="col-lg-2 control-label" >是否使用</label>
            <div class="col-lg-10">
            <label class="radio-inline">
            <input name="status" type="radio" value="1">是</label>
            <label class="radio-inline">
            <input name="status" type="radio" value="0">否</label>
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
</div>

    <!-- footer -->
    <?php include __DIR__ . "/../public/foot.php"?>

<!-- <link rel="stylesheet" media="screen" href="<?php //echo $this->module->assetsUrl; ?>/vendors/bootstrap-datepicker/css/datepicker.css">
<link rel="stylesheet" media="screen" href="<?php //echo $this->module->assetsUrl; ?>/css/datepicker.fixes.css">
<script type="text/javascript" src="<?php //echo $this->module->assetsUrl; ?>/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> -->
<script type="text/javascript">
            $(function() {
                $(':input[type=radio]').val([<?php echo $param['status']; ?>])
            });
</script>
</body>
