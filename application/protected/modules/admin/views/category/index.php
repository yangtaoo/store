<link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/vendors/treegrid/css/jquery.treegrid.css">

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
    
    <div class="page-header bootstrap-admin-content-title">
                            <h1 class="fl">分类管理</h1><span class="fr"><button class="btn xiao btn-default" onclick="location.href='/admin/Category/add'">+ 添加分类</button></span>
                            <div class="clear"></div>
                        </div>
    
    <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
        <div id="rootwizard">
            <div class="row">
            <div class="panel panel-default">
            <div class="bootstrap-admin-panel-content">
    <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">

    <table class="table table-striped table-bordered dataTable" id="tree" aria-describedby="example_info">
        <thead>
        <tr role="row">
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 200px;">分类名称</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="text-align:center">分类描述</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="text-align:center">分类图片</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 220px; text-align:center">操作</th>
        </tr>
        </thead>

        <tbody role="alert" aria-live="polite" aria-relevant="all">
<?php foreach ($rows as $val) {?>
        <tr class="treegrid-<?php echo $val['id'] ?> <?php if ($val['level'] != 1) {echo "treegrid-parent-" . $val['pid'];}?>">
            <td class=" sorting_1"><?php echo $val['name']; ?></td>
            <td class=" "><?php echo $val['intro']; ?></td>
            <td align="center"><img src="<?php echo $val['list_img']; ?>" alt="" width="200"></td>
            <td align="center">
             <a href="/admin/Category/add?id=<?php echo $val['id'] ?>"><button class="btn xiao btn-default"><i class="glyphicon glyphicon-pencil glyphicon-white"></i> 编辑</button></a>
            <button onClick="deleteBrand(<?php echo $val['id'] ?>)" class="btn xiao btn-danger"><i class="glyphicon glyphicon-remove glyphicon-white"></i> 删除</button>
            </td>
        </tr>
<?php }?>
        </tbody>
    </table>
    <?php //echo $list['pageStr'] ?>
                                </div>
                            </div>
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

</body>
<script src="<?php echo $this->module->assetsUrl; ?>/vendors/treegrid/js/jquery.treegrid.js"></script>
<script type="text/javascript">

    $(function(){
            $('#tree').treegrid();//将列表展示成treegrid的样式
        });

    function deleteBrand(id) {
        if (!confirm("确认要删除此分类及所有子级分类，该操作不可恢复！")) {
            return false;
        }
        $.ajax({
            url: '/admin/Category/AjaxDel',
            type: 'post',
            dataType: 'json',
            data: {'id': id},
            error: function(errormsg) {
                alert(errormsg);
            },
            success: function(msg) {
                if (msg.status) {
                    window.location.reload();
                } else {
                    alert(msg.message);
                }
            }
        });
    }
</script>