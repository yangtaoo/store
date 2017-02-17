
<body class="bootstrap-admin-with-small-navbar">
<!-- small navbar -->
<?php include __DIR__ . "/../public/nav.php"?>

<div class="container">
<!-- left, vertical navbar & content -->
<div class="row">
<!-- left, vertical navbar -->
<?php include __DIR__ . "/../public/left.php"?>
<!-- 地址样式 -->
<link href="http://hovertree.com/texiao/bootstrap/4/css/city-picker.css" rel="stylesheet" type="text/css" />
<!-- content -->
<div class="main">

<div class="panel panel-default bootstrap-admin-no-table-panel">
    <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
        <div id="rootwizard">

                <div class="page-header bootstrap-admin-content-title">
                            <h1 class="fl">添加拍品会</h1><span class="fr">
                            <button class="btn xiao btn-default" onClick="location.href='/admin/Auction/index'">&lt; 返回</button></span>
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
            <label class="col-lg-2 control-label" >拍品会名称</label>
            <div class="col-lg-10">
                <input class="form-control" name="name" required type="text" value="<?php echo $param['name']; ?>">
            </div>
        </div>
<div class="form-group">
        <label class="col-lg-2 control-label" >所属机构</label>
    <div class="col-lg-10">
        <select name="agency" style="width: 150px;" id="agency">
            <option value="0">请选择机构</option>
                <?php foreach ($agency as $val) {?>
                <option value="<?php echo $val['id'] . '/' . $val['name']; ?>"><?php echo $val['name']; ?></option>
                <?php }?>
        </select>
    </div>
</div>
        <div class="form-group">
            <label class="col-lg-2 control-label" >开始时间</label>
            <div class="col-lg-10">
                <input placeholder="开始日期" class="form-control layer-date" id="start" name="start_time" value="<?php echo !empty($param['start_time']) ? date('Y-m-d H:i', $param['start_time']) : ''; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" >结束时间</label>
            <div class="col-lg-10">
                <input placeholder="结束日期" class="form-control layer-date" id="end" name="end_time" value="<?php echo !empty($param['end_time']) ? date('Y-m-d H:i', $param['end_time']) : ''; ?>">
            </div>
        </div>
<?php if (!empty($param['auction_img'])) {?>
    <div class="form-group" id="img_url">
        <label class="col-lg-2 control-label" >当前图片</label>
        <div class="col-lg-10">
            <img src="<?php echo $param['auction_img'] ?>" style="width: 200px;height:200px" /><a href="javascript:void(0)" onClick="$('#img_url').remove();">删除当前图片</a>
        </div>
        <input type="hidden" name="auction_img" value="<?php echo $param['auction_img']; ?>" />
    </div>
<?php }?>
<div class="form-group">
        <label class="col-lg-2 control-label" >拍品会首页图</label>
    <div class="col-lg-10">
        <input type="file" <?php if (empty($param['auction_img'])) {
    echo 'required=""';
}
?> name="upload_img" />
        <p class="help-block">图片尺寸为590*260</p>
    </div>
</div>

<div class="form-group">
        <label class="col-lg-2 control-label" >拍卖地址</label>
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
<label class="col-lg-2 control-label">拍品会简介</label>
<div class="col-lg-10">
<textarea rows="6" name="intro" class="form-control textarea-wysihtml5" cols="40" style="resize:none;"><?php echo $param['intro']; ?></textarea>
<p class="help-block">请输入拍品会简单描述</p>
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label" >是否启用</label>
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
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/vendors/layer/laydate/laydate.js"></script>
<script src="http://hovertree.com/texiao/bootstrap/4/js/city-picker.data.js"></script>
<script src="http://hovertree.com/texiao/bootstrap/4/js/city-picker.js"></script>
<script type="text/javascript">
            $(function() {
                        var start = {
                            elem: "#start",
                            format: "YYYY/MM/DD hh:mm:ss",
                            min: laydate.now(),
                            max: "2099-06-16 23:59:59",
                            istime: true,
                            istoday: false,
                            choose: function(datas) {
                                end.min = datas;
                                end.start = datas
                            }
                        };
                        var end = {
                            elem: "#end",
                            format: "YYYY/MM/DD hh:mm:ss",
                            min: laydate.now(),
                            max: "2099-06-16 23:59:59",
                            istime: true,
                            istoday: false,
                            choose: function(datas) {
                                start.max = datas
                            }
                        };
                        laydate(start);
                        laydate(end);
            });
                //会显单选框
                $(':input[type=radio]').val([<?php echo $param['status']; ?>]);
                //会显下拉框
                $('#agency').val(['<?php echo !empty($param['agency_name']) ? $param['agency_id'] . '/' . $param['agency_name'] : ''; ?>']);
</script>
</body>
