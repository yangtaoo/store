<!--必要样式-->

<link href="http://hovertree.com/texiao/bootstrap/4/css/city-picker.css" rel="stylesheet" type="text/css" />

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
                            <h1 class="fl">添加机构</h1><span class="fr">
                            <button class="btn xiao btn-default" onclick="location.href='/admin/Agency/index'">&lt; 返回</button></span>
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

        <div class="form-group">
            <label class="col-lg-2 control-label" >机构名称</label>
            <div class="col-lg-10">
                <input class="form-control" name="name" required="" type="text" value="<?php echo $param['name']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" >机构负责人</label>
            <div class="col-lg-10">
                <input class="form-control" required="" name="responsible" type="text" value="<?php echo $param['responsible']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" >机构电话</label>
            <div class="col-lg-10">
                <input class="form-control" name="phone" required="" type="text" value="<?php echo $param['phone']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" >机构邮箱</label>
            <div class="col-lg-10">
                <input class="form-control" name="email" type="text" value="<?php echo $param['email']; ?>">
            </div>
        </div>
<?php if (!empty($param['logo'])) {?>
    <div class="form-group" id="img_url">
        <label class="col-lg-2 control-label" >当前图片</label>
        <div class="col-lg-10">
            <img src="<?php echo $param['logo'] ?>" style="width: 100px;height: 100px" /><a href="javascript:void(0)" onClick="$('#img_url').remove();">删除当前图片</a>
        </div>
        <input type="hidden" name="logo" value="<?php echo $param['logo']; ?>" />
    </div>
<?php }?>
<div class="form-group">
        <label class="col-lg-2 control-label" >机构LOGO</label>
    <div class="col-lg-10">
        <input type="file" <?php if (empty($param['logo'])) {
    echo 'required=""';
}
?> name="upload_img" />
        <p class="help-block">图片尺寸为135*135</p>
    </div>
</div>
<div class="form-group">
        <label class="col-lg-2 control-label" >所在地区</label>
    <div class="col-lg-10">
        <input id="city-picker3" required="" class="form-control" readonly type="text" value="<?php echo $param['province'] . '/' . $param['city'] . '/' . $param['area']; ?>" data-toggle="city-picker" name="groupAddr">
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label">详细地址</label>
        <div class="col-lg-10">
<textarea rows="6" name="address" required="" class="form-control textarea-wysihtml5" cols="40" style="resize:none;"><?php echo $param['address']; ?></textarea>
<p class="help-block">请填写详细地址</p>
        </div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label">机构简介</label>
<div class="col-lg-10">
<textarea rows="6" name="intro" class="form-control textarea-wysihtml5" cols="40" style="resize:none;"><?php echo $param['intro']; ?></textarea>
<p class="help-block">请输入机构简单描述</p>
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label" >机构详细介绍</label>
<div class="col-lg-10">
<textarea id="ckeditor_full" name="account"><?php echo $param['account']; ?></textarea>
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label" >排序</label>
<div class="col-lg-10">
<input class="form-control" name="sort" type="number" value="<?php echo $param['sort']; ?>">
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label" >机构类型</label>
<div class="col-lg-10">
<label class="radio-inline">
<input name="agency_type" type="radio" value="1" class="agency_type">拍卖机构</label>
<label class="radio-inline">
<input name="agency_type" type="radio" value="2" class="agency_type">博物馆</label>
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label" >是否使用</label>
<div class="col-lg-10">
<label class="radio-inline">
<input name="status" type="radio" value="1" class="status">是</label>
<label class="radio-inline">
<input name="status" type="radio" value="0" class="status">否</label>
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
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/vendors/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/vendors/ckeditor/adapters/jquery.js"></script>
<script src="http://hovertree.com/texiao/bootstrap/4/js/city-picker.data.js"></script>
<script src="http://hovertree.com/texiao/bootstrap/4/js/city-picker.js"></script>
<script type="text/javascript">
            $(function() {

                // $('.datepicker').datepicker({ format: 'yyyy-mm-dd' });
                $('textarea#ckeditor_full').ckeditor({
                    height: '200px'
                });

                $('.status').val([<?php echo $param['status']; ?>]);
                $('.agency_type').val([<?php echo $param['agency_type']; ?>]);
            });
</script>
</body>
