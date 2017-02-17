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
                            <h1 class="fl">机构管理</h1><span class="fr"><button class="btn xiao btn-default" onClick="location.href='/admin/Agency/add'">+ 添加机构</button></span>
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
        <div class="fr">
            <div class="dataTables_filter" id="example_filter">
            <label> <input type="text" class="input1" name="keyWords" placeholder="请输入你要搜索的内容" value="<?php echo $keyWords ?>" aria-controls="example"> <button onClick="searchGo();" class="btn1 btn-default">Go</button></label>
            </div>
        </div>
        <div class="kong15"></div>
    </form>
    </div>
    <table class="table table-striped table-bordered dataTable" id="example" aria-describedby="example_info">
    <thead>
        <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 120px;">机构名称</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 120px;">机构负责人</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 120px; ">机构电话</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 150px;text-align:center;">添加时间</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">机构描述</th>
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 85px; text-align:center;">是否启用</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width:220px; text-align:center;" >操作</th>
        </tr>
    </thead>

    <tbody role="alert" aria-live="polite" aria-relevant="all">
        <?php foreach ($list['data'] as $val) {?>
        <tr class="gradeA odd">
            <td class=" sorting_1"><?php echo $val['name']; ?></td>
            <td class=" "><?php echo $val['responsible']; ?></td>
            <td ><?php echo $val['phone'] ?></td>
            <td align="center "  ><?php echo date('Y-m-d', $val['add_time']); ?></td>
            <td class="center "><?php echo $val['intro']; ?></td>
            <td align="center "><?php echo $val['status'] ? '是' : '否'; ?></td>
            <td align="center " >
<a href="/admin/Agency/add?id=<?php echo $val['id'] ?>">
    <button class="btn xiao btn-default">
    <i class="glyphicon glyphicon-pencil glyphicon-white"></i> 编辑</button>
</a>
    <button onClick="deleteOne(<?php echo $val['id'] ?>)" class="btn xiao btn-danger">
    <i class="glyphicon glyphicon-remove glyphicon-white"></i> 删除</button>
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
<script type="text/javascript">
    function deleteOne(id){
        if(!confirm("确认要删除吗，该操作不可恢复！")){
            return false;
        }
        $.ajax({
            url:'/admin/Agency/AjaxDel',
            type:'post',
            dataType:'json',
            data:{'id[]':id},
            error:function(errormsg){ alert(errormsg); },
            success:function(msg){
                if(msg.status){
                    window.location.reload();
                }else{
                    alert(msg.message);
                }
            }
        });
    }
</script>