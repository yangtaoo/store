<link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/vendors/treegrid/css/jquery.treegrid.css">

<body class="bootstrap-admin-with-small-navbar">
    <!-- small navbar -->
<?php include __DIR__ . "/../public/nav.php"?>

<div class="container">
    <!-- left, vertical navbar & content -->
    <div class="row">
    <!-- left, vertical navbar -->
<?php include __DIR__ . "/../public/left.php"?>
<style type="text/css">
    .wrap{word-break:break-all;}
</style>

<!-- content -->
<div class="main">
    <div class="panel panel-default bootstrap-admin-no-table-panel">
    <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
        <div id="rootwizard">
        
        
    <div class="page-header bootstrap-admin-content-title">
                            <h1 class="fl">首页轮播图</h1><span class="fr"><button class="btn xiao btn-default" onclick="location.href='/admin/Default/imageAdd'">+ 添加图片</button></span>
                            <div class="clear"></div>
                        </div>
                 
            <div class="row">
            <div class="panel panel-default">
            <div class="bootstrap-admin-panel-content">
    <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
    <div class="row">
    <form id="searchForm" method="GET">
        <div class="fl">
            <div id="example_length" class="dataTables_length">
            <label>
                <select size="1" name="pageSize" class="select" aria-controls="example" onChange="searchGo();" style=" width:75px;">
        <?php foreach ($pageSizeConfig as $key => $val) {?>
                    <option value="<?php echo $key ?>"<?php echo $key == $pageSize ? ' selected="selected"' : ''; ?> ><?php echo $val ?></option>
        <?php }?>
                </select> 条/页
            </label>
            </div>
        </div>
        <div class="kong15"></div>
    </form>
    </div>
    <table class="table table-striped table-bordered dataTable" id="tree" aria-describedby="example_info" style="table-layout:fixed">
        <thead>
        <tr role="row">
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 20%; text-align:center">图片</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 20%; text-align:center;">链接</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 20%; text-align:center">描述</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 10%; text-align:center">排序</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style=" text-align:center">添加时间</th>
            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width:220px; text-align:center">操作</th>
        </tr>
        </thead>

        <tbody role="alert" aria-live="polite" aria-relevant="all">
<?php foreach ($list['data'] as $val) {?>
        <tr>
            <td align="center"><img src="<?php echo $val['img_url']; ?>" alt="<?php echo $val['alt']; ?>" height="100"></td>
            <td class="wrap"><?php echo $val['img_link']; ?></td>
            <td class="wrap"><?php echo $val['intro']; ?></td>
            <td align="center"><?php echo $val['sort']; ?></td>
            <td align="center"><?php echo date('Y-m-d H:s', $val['add_time']); ?></td>
            <td align="center">
             <a href="/admin/Default/imageAdd?id=<?php echo $val['id'] ?>"><button class="btn xiao btn-default"><i class="glyphicon glyphicon-pencil glyphicon-white"></i> 编辑</button></a>
            <button onClick="deleteBrand(<?php echo $val['id'] ?>)" class="btn xiao btn-danger"><i class="glyphicon glyphicon-remove glyphicon-white"></i> 删除</button>
            </td>
        </tr>
<?php }?>
        </tbody>
    </table>
    <?php echo $list['pageStr'] ?>
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
        if (!confirm("确认要删除吗？该操作不可恢复！")) {
            return false;
        }
        $.ajax({
            url: '/admin/Default/AjaxDel',
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