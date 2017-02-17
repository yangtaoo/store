<link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/vendors/ztree/css/zTreeStyle/zTreeStyle.css">

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

    <div class="page-header bootstrap-admin-content-title">
                            <h1 class="fl">添加分类</h1><span class="fr"><button class="btn xiao btn-default" onclick="location.href='/admin/Category/index'">< 返回</button></span>
                            <div class="clear"></div>
                        </div>
    <div id="rootwizard">
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
        <input type="hidden" name="id" value="<?php echo $id ?>" />
    <fieldset>
        <div class="form-group">
            <label class="col-lg-2 control-label" >分类名称</label>
                <div class="col-lg-10">
                    <input class="form-control" name="name" type="text" value="<?php echo $param['name'] ?>" required="">
                </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" >上级分类</label>
                <div class="col-lg-10">
                    <input type="hidden" name="pid" value="0" id="parent_id">
                    <input class="form-control" id="parent_name" type="text" value="请选择" readonly="">
                    <ul id="treeDemo" class="ztree"></ul>
                </div>
        </div>
        <?php if (!empty($param['list_img'])) {?>
    <div class="form-group list_img">
        <label class="col-lg-2 control-label" >当前图片</label>
        <div class="col-lg-10">
            <img src="<?php echo $param['list_img'] ?>" style="width: 550px;height: 150px" /><a href="javascript:void(0)" onClick="$('.list_img').remove();">删除当前图片</a>
        </div>
        <input type="hidden" name="list_img" value="<?php echo $param['list_img']; ?>" />
    </div>
<?php }?>
<div class="form-group">
        <label class="col-lg-2 control-label" >列表图片</label>
    <div class="col-lg-10">
        <input type="file" <?php if ((isset($param['level']) && $param['level'] == 1) || empty($param['name'])) {
    if (empty($param['list_img'])) {
        echo 'required=""';
    }
}
?> name="list_img" class="category_img" />
        <p class="help-block">图片尺寸为750*250</p>
    </div>
</div>
<?php if (!empty($param['home_list_img'])) {?>
    <div class="form-group home_list_img">
        <label class="col-lg-2 control-label" >当前图片</label>
        <div class="col-lg-10">
            <img src="<?php echo $param['home_list_img'] ?>" style="width: 550px;height: 145px" /><a href="javascript:void(0)" onClick="$('.home_list_img').remove();">删除当前图片</a>
        </div>
        <input type="hidden" name="home_list_img" value="<?php echo $param['home_list_img']; ?>" />
    </div>
<?php }?>
<div class="form-group">
        <label class="col-lg-2 control-label" >主页列表</label>
    <div class="col-lg-10">
        <input type="file" <?php if ((isset($param['level']) && $param['level'] == 1) || empty($param['name'])) {
    if (empty($param['home_list_img'])) {
        echo 'required=""';
    }
}
?> name="home_list_img" class="category_img" />
        <p class="help-block">图片尺寸为750*150</p>
    </div>
</div>
<?php if (!empty($param['tags_img'])) {?>
    <div class="form-group tags_img">
        <label class="col-lg-2 control-label" >当前图片</label>
        <div class="col-lg-10">
            <img src="<?php echo $param['tags_img'] ?>" style="width: 200px;height: 200px" /><a href="javascript:void(0)" onClick="$('.tags_img').remove();">删除当前图片</a>
        </div>
        <input type="hidden" name="tags_img" value="<?php echo $param['tags_img']; ?>" />
    </div>
<?php }?>
<div class="form-group">
        <label class="col-lg-2 control-label" >热门分类</label>
    <div class="col-lg-10">
        <input type="file" <?php if ((isset($param['level']) && $param['level'] == 1) || empty($param['name'])) {
    if (empty($param['tags_img'])) {
        echo 'required=""';
    }
}
?> name="tags_img" class="category_img" />
        <p class="help-block">图片尺寸为160*266</p>
    </div>
</div>
        <div class="form-group">
            <label class="col-lg-2 control-label" >分类描述</label>
                <div class="col-lg-10">
                    <input class="form-control" name="intro" type="text" value="<?php echo $param['intro'] ?>">
                </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" >分类排序</label>
                <div class="col-lg-10">
                    <input class="form-control" name="sort" type="number" value="<?php echo $param['sort'] ?>">
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
<script src="<?php echo $this->module->assetsUrl; ?>/vendors/ztree/js/jquery.ztree.core.min.js"></script>
<script src="<?php echo $this->module->assetsUrl; ?>/vendors/ztree/js/jquery.ztree.excheck.js"></script>
<script type="text/javascript">
$(':input[type=radio]').val([<?php echo isset($param['status']) ? $param['status'] : 1; ?>])
    //基本配置
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "pid",
                    }
                },
                callback:{
                onClick:function(event,treeid,tree_node){
                    $('#parent_id').val(tree_node.id);
                    $('#parent_name').val(tree_node.name);
                        if(tree_node.id!=0){
                            $('.category_img').removeAttr('required');
                        }
                    },
                },
            };
        var zNodes=<?php echo $rows; ?>;

        $(document).ready(function(){
            //将html节点初始化成ztree的效果
            var ztree_obj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            ztree_obj.expandAll(true);
            //编辑分类回显父级分类
            <?php if (!empty($id)) {?>
            var parent_node = ztree_obj.getNodeByParam('id',<?php echo $param['pid']; ?>);
                    ztree_obj.selectNode(parent_node);
                    $('#parent_id').val(parent_node.id);
                    $('#parent_name').val(parent_node.name);
            <?php }?>
        })
</script>

</body>
