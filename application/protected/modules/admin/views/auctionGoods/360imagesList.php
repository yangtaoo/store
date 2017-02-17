<body class="bootstrap-admin-with-small-navbar">
    <!-- small navbar -->
    <?php include __DIR__ . "/../public/nav.php" ?>

    <div class="container">
        <!-- left, vertical navbar & content -->
        <div class="row">
            <!-- left, vertical navbar -->
            <?php include __DIR__ . "/../public/left.php" ?>

            <!-- content -->
            <div class="main">
                <div class="panel panel-default bootstrap-admin-no-table-panel">
                    <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                        <div id="rootwizard">
                        <div class="page-header bootstrap-admin-content-title">
                            <h1 class="fl"><?php echo $goodsInfo['name'] ?> 360图片列表</h1><span class="fr">
                            <button class="btn xiao btn-default" onClick="location.href='/admin/AuctionGoods/index'">&lt; 返回</button></span>
                            <div class="clear"></div>
                        </div>
                            <button class="btn xiao btn-default" id="uploadbtn">+ 批量上传图片</button>
                            <button class="btn xiao btn-default" id="uploadcancelbtn" style="display: none;">< 返回列表</button>
                            <div class="kong20"></div>
                            <div class="row">
                                    <div class="panel panel-default">
                                        <div class="bootstrap-admin-panel-content">
                                            <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                                <div class="row" id="imagesUploadBox" style="display: none;">
                                                    <div class=" ">
                                                        <div id="imagesUpload" class="demo"></div>
                                                    </div>
                                                </div>
                                                    <table class="table table-striped table-bordered dataTable" id="imagesList" aria-describedby="example_info">
                                                <?php if ($list) { ?>
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" >id</th>
                                                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >图片</th>
                                                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >序号</th>
                                                                <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 150px; text-align:center;">操作</th>
                                                                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style=" width:100px;" >选择 <input type="checkbox" id="checkall"></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                                                            <?php foreach ($list as $val) { ?>
                                                                <tr class="gradeA odd sortList" sort_id="<?php echo $val['id'] ?>">
                                                                    <td class="sorting_1"><?php echo $val['id']; ?></td>
                                                                    <td align="center"><img style="width: 80px; height: 80px;" src="<?php echo $val['image_url'] ?>" /></td>
                                                                    <td class=" "><?php echo $val['sort']; ?></td>                                                         
                                                                    <td class="center " style="text-align:center;">
                                                                        <button onClick="changeSort('up', <?php echo $val['id'] ?>)" title="前移一位" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-backward"></i></button>
                                                                        <button onClick="changeSort('down', <?php echo $val['id'] ?>)" title="后移一位" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-forward"></i></button>
                                                                        <button onClick="deleteOne(<?php echo $val['id'] ?>)" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-remove glyphicon-white"></i> 删除</button>
                                                                    </td>
                                                                    <td class="center" align="center"><input name="id[]" type="checkbox" value="<?php echo $val['id']; ?>" /></td>
                                                                </tr>
                                                            <?php } ?>
                                                                <tr class="gradeA odd">
                                                                    <td colspan="4"></td>
                                                                    <td colspan="1" class="center" align="center">
                                                                        <button onClick="deleteAll()" class="btn xiao btn-danger"><i class="glyphicon glyphicon-remove glyphicon-white"></i> 删除</button>
                                                                    </td>
                                                                </tr>
                                                        </tbody>
                                                <?php } ?>
                                                    </table>
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
    <?php include __DIR__ . "/../public/foot.php" ?>

</body>
<link rel="stylesheet" href="<?php echo $this->module->assetsUrl; ?>/zyupload/control/css/zyUpload.css" type="text/css">
<!-- 引用核心层插件 -->
<script src="<?php echo $this->module->assetsUrl; ?>/zyupload/core/zyFile.js"></script>
<!-- 引用控制层插件 -->
<script src="<?php echo $this->module->assetsUrl; ?>/zyupload/control/js/zyUpload.js"></script>
<script type="text/javascript">
    $(function(){
        $("#uploadbtn").click(function(){
//            $(".nav-pills").find('li').removeClass('active');
//            $(this).addClass('active');
//            if($(this).attr('target') == 'imagesUploadBox'){
                $("#imagesList").hide();
                $("#uploadbtn").hide();
                $("#uploadcancelbtn").show();
                $("#imagesUploadBox").fadeIn(200);
//            }else{
//                $("#imagesUploadBox").hide();
//                $("#imagesList").fadeIn(200);
//            }
        });
        
        $("#uploadcancelbtn").click(function(){
            $("#imagesUploadBox").hide();
            $("#uploadcancelbtn").hide();
            $("#uploadbtn").show();
            $("#imagesList").fadeIn(200);
        });
        
        $("#checkall").click(function(){
            if($("#checkall").attr('checked')){
                $("input[name='id[]']").attr('checked', true);
            }else{
                $("input[name='id[]']").attr('checked', false);                
            }
        });
	// 初始化插件
	$("#imagesUpload").zyUpload({
		width            :   "725px",                 // 宽度
		height           :   "auto",                 // 宽度
		itemWidth        :   "120px",                 // 文件项的宽度
		itemHeight       :   "120px",                 // 文件项的高度
		url              :   "/admin/AuctionGoods/360imagesUpload?goods_id=<?php echo $goodsInfo['id'] ?>",  // 上传文件的路径
		multiple         :   true,                    // 是否可以多个文件上传
		dragDrop         :   true,                    // 是否可以拖动上传文件
		del              :   true,                    // 是否可以删除文件
		finishDel        :   false,  				  // 是否在上传文件完成后删除预览
		/* 外部获得的回调接口 */
		onSelect: function(files, allFiles){                    // 选择文件的回调方法
			console.info("当前选择了以下文件：");
			console.info(files);
			console.info("之前没上传的文件：");
			console.info(allFiles);
		},
		onDelete: function(file, surplusFiles){                     // 删除一个文件的回调方法
			console.info("当前删除了此文件：");
			console.info(file);
			console.info("当前剩余的文件：");
			console.info(surplusFiles);
		},
		onSuccess: function(file){                    // 文件上传成功的回调方法
			console.info("此文件上传成功：");
			console.info(file);
		},
		onFailure: function(file){                    // 文件上传失败的回调方法
			console.info("此文件上传失败：");
			console.info(file);
		},
		onComplete: function(responseInfo){           // 上传完成的回调方法
                        window.location.reload();
			console.info("文件上传完成");
			console.info(responseInfo);
		}
	});
    });
    function changeSort(type, id){    
        var goodsId = <?php echo $goodsInfo['id']; ?>;
        $.ajax({
            type:'post',
            url:'/admin/AuctionGoods/Change360ImageSort',
            data:{'goods_id':goodsId,'type':type,'id':id},
            dataType:'json',
            error:function(errormsg){
                alert(errormsg);
            },
            success:function(msg){
                if(msg.status){
                    moveSort(type, id);
                }else{
                    alert('操作失败！错误信息“'+ msg.message +'”');
                }
            }
        });
    }
    function moveSort(type, id){
        var beforeOne,afterOne,nowOne = '';
        var beforeOneHtml,afterOneHtml,nowOneHtml = '';
        var beforeOneSortId,afterOneSortId,nowOneSortId = '';
        $(".sortList").each(function(){
            if(nowOne != ''){
                afterOne = $(this);
                afterOneHtml = $(this).html();
                afterOneSortId = $(this).attr('sort_id');
                return false;
            }
            if($(this).attr('sort_id') == id){
                nowOne = $(this);
                nowOneHtml = $(this).html();
                nowOneSortId = $(this).attr('sort_id');
            }else{
                beforeOne = $(this);
                beforeOneHtml = $(this).html();
                beforeOneSortId = $(this).attr('sort_id');
            }
            
        });
        if(type == 'up'){
            if(beforeOne == ''){
                return;
            }
            beforeOne.html(nowOneHtml);
            beforeOne.attr('sort_id',nowOneSortId);
            nowOne.html(beforeOneHtml);
            nowOne.attr('sort_id',beforeOneSortId);
        }else{
            if(afterOne == ''){
                return;
            }
            afterOne.html(nowOneHtml);
            afterOne.attr('sort_id',nowOneSortId);
            nowOne.html(afterOneHtml);
            nowOne.attr('sort_id',afterOneSortId);            
        }
    }
    function deleteAll(){
        var ids = [];
        var i = 0;
        $("input[name='id[]']:checked").each(function(){
            ids[i] = $(this).val();
            i++;
        });
        if(ids.length == 0){
            alert('请至少选择一条记录！');
        }else{
            deleteOne(ids);
        }
    }
    function deleteOne(id) {
        if (!confirm("确认要删除吗，该操作不可恢复！")) {
            return false;
        }
        $.ajax({
            url: '/admin/AuctionGoods/AjaxDel360Images',
            type: 'post',
            dataType: 'json',
            data: {'id[]': id},
            error: function (errormsg) {
                alert(errormsg);
            },
            success: function (msg) {
                if (msg.status) {
                    window.location.reload();
                } else {
                    alert(msg.message);
                }
            }
        });
    }
</script>