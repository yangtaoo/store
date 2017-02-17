
<link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/vendors/ztree/css/zTreeStyle/zTreeStyle.css">
<style type="text/css">
    .auction_size{
        width: 15.3%;
    }
</style>

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
                            <h1 class="fl">添加拍品</h1><span class="fr">
                            <button class="btn xiao btn-default" onclick="location.href='/admin/AuctionGoods/index'">&lt; 返回</button></span>
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
            <label class="col-lg-2 control-label" >拍品名称</label>
            <div class="col-lg-10">
                <input class="form-control" name="name" required="" type="text" value="<?php echo $param['name']; ?>">
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
        <label class="col-lg-2 control-label" style="width:14%;">所属拍卖会</label>
        <select name="auction_id" style="width: 150px;" id="auction">
            <option value="0">请选择拍卖会</option>
                <?php foreach ($auction as $val) {?>
                <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                <?php }?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-2 control-label" >所属分类</label>
    <div class="col-lg-10">
        <input type="hidden" name="category_id" value="0" id="category_id">
        <input class="form-control" id="category_name" type="text" value="请选择" readonly="">
        <ul id="treeDemo" class="ztree"></ul>
    </div>
</div>

<?php if (!empty($param['img'])) {?>
    <div class="form-group" id="img_url">
        <label class="col-lg-2 control-label" >当前图片</label>
        <div class="col-lg-10">
            <img src="<?php echo $param['img'] ?>" style="width: 200px;height:200px" /><a href="javascript:void(0)" onClick="$('#img_url').remove();">删除当前图片</a>
        </div>
        <input type="hidden" name="img" value="<?php echo $param['img']; ?>" />
    </div>
<?php }?>
<div class="form-group">
        <label class="col-lg-2 control-label" >拍品图片</label>
    <div class="col-lg-10">
        <input type="file" <?php if (empty($param['img'])) {
    echo 'required=""';
}
?> name="upload_img" />
        <p class="help-block">图片尺寸为290*290</p>
    </div>
</div>

        <div class="form-group">
            <label class="col-lg-2 control-label" >所属年代</label>
            <div class="col-lg-10">
                <input class="form-control" name="decade" required="" type="text" value="<?php echo $param['decade']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" >预计最低价</label>
            <div class="col-lg-10">
                <input class="form-control" name="min_price" required="" type="number" value="<?php echo $param['min_price']; ?>" min="0">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" >预计最高价</label>
            <div class="col-lg-10">
                <input class="form-control" name="max_price" required="" type="number" value="<?php echo $param['max_price']; ?>" min="0">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" >起拍价格</label>
            <div class="col-lg-10">
                <input class="form-control" name="start_price" required="" type="number" value="<?php echo $param['start_price']; ?>" min="0">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" >交易价格</label>
            <div class="col-lg-10">
                <input class="form-control" name="trade_price" type="number" value="$val['trade_price'] > 0 ? $val['trade_price'] : ''" min="0">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" >拍品重量(千克)</label>
            <div class="col-lg-10">
                <input class="form-control" name="weight" required="" type="number" value="<?php echo $param['weight']; ?>" min="0">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" >拍品尺寸(厘米)</label>
            <label class="col-lg-2 control-label" style="width:0px;">长:</label>
            <div class="col-sm-2 auction_size">
                <input class="form-control" name="size[long]" required="" type="number" value="<?php echo $param['size']['long']; ?>" min="0">
            </div>
            <label class="col-lg-1 control-label" style="width:0px;">宽:</label>
            <div class="col-sm-2 auction_size">
                <input class="form-control" name="size[width]" required="" type="number" value="<?php echo $param['size']['width']; ?>" min="0">
            </div>
            <label class="col-lg-1 control-label" style="width:0px;">高:</label>
            <div class="col-sm-2 auction_size">
                <input class="form-control" name="size[height]" required="" type="number" value="<?php echo $param['size']['height']; ?>" min="0">
            </div>
        </div>

<div class="form-group">
<label class="col-lg-2 control-label">拍品简介</label>
<div class="col-lg-10">
<textarea rows="6" name="intro" class="form-control textarea-wysihtml5" cols="40" style="resize:none;"><?php echo $param['intro']; ?></textarea>
<p class="help-block">请输入拍品简单描述</p>
</div>
</div>

<div class="form-group">
<label class="col-lg-2 control-label" >拍品详细介绍</label>
<div class="col-lg-10">
<textarea id="ckeditor_full" name="details"><?php echo $param['details']; ?></textarea>
</div>
</div>

<div class="form-group">
            <label class="col-lg-2 control-label" >排序</label>
            <div class="col-lg-10">
                <input class="form-control" name="sort" type="number" value="<?php echo $param['sort']; ?>" min="0">
            </div>
        </div>
<div class="form-group">
<label class="col-lg-2 control-label" >是否展示</label>
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
<script src="<?php echo $this->module->assetsUrl; ?>/vendors/ztree/js/jquery.ztree.core.min.js"></script>
<script src="<?php echo $this->module->assetsUrl; ?>/vendors/ztree/js/jquery.ztree.excheck.js"></script>
<script src="<?php echo $this->module->assetsUrl; ?>/vendors/layer/layer.js"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/vendors/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/vendors/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
            $(function() {

        //会显单选框
        $(':input[type=radio]').val([<?php echo $param['status']; ?>]);
        //会显下拉框
        $('#agency').val(['<?php echo !empty($param['agency_name']) ? $param['agency_id'] . '/' . $param['agency_name'] : ''; ?>']);

        $('#auction').val([<?php echo $param['auction_id'] ?>]);

                $('textarea#ckeditor_full').ckeditor({
                    height: '200px'
                });
                //基本配置
                var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "pid",
                    }
                },
                    callback: {
                        onClick: function (event, treeid, tree_node) {
                        $('#category_id').val(tree_node.id);
                        $('#category_name').val(tree_node.name);
                        },
                        beforeClick: function (treeid, tree_node) {
                            //如果选择的是枝干节点,就返回false,不允许选择
                            if (tree_node.isParent) {
                                layer.msg('不能选择枝干节点', {icon: 5, time: 1000});
                                return false;
                            }
                        },
                    },
            };
            //准备节点数据
            var zNodes = <?php echo $category; ?>;
            //将html节点初始化成ztree的效果
            var ztree_obj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            //ztree会显
            var category_node = ztree_obj.getNodeByParam('id', <?php echo $param['category_id'] ?>);
            //展开所有的ztree节点
            ztree_obj.expandAll(true);

            ztree_obj.selectNode(category_node);
            $('#category_id').val(category_node.id);
            $('#category_name').val(category_node.name);

            });
</script>
</body>
