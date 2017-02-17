<link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/css/DT_bootstrap.css">

<link rel="stylesheet" media="screen" href="<?php echo $this->module->assetsUrl; ?>/vendors/jGrowl/jquery.jgrowl.css">

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

                    <div class=" ">

                        <div class="page-header bootstrap-admin-content-title">

                            <h1>用户留言</h1>

                        </div>

                    </div>

                </div>



                <div class="row">

                    <div class=" ">

                        <div class="panel panel-default">

                            <div class="bootstrap-admin-panel-content">

                                <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">

                                    <div class="row">

                                        <form id="searchForm" method="GET">

                                        <div class="">

                                            <div id="example_length" class="dataTables_length">

                                                <label>

                                                    <select size="1" class="select" name="pageSize" aria-controls="example" onChange="searchGo();">

                                                        <?php foreach ($pageSizeConfig as $key => $val) {?>

                                                        <option value="<?php echo $key ?>"<?php echo $key == $pageSize ? ' selected="selected"' : ''; ?> ><?php echo $val ?></option>

                                                        <?php }?>

                                                    </select> 条/页

                                                </label>

                                            </div>

                                        </div>

                                        <div class="">

                                            <div class="dataTables_filter" id="example_filter">

                                                <label><input type="text" class="input1 fl" name="keyWords" placeholder="请输入你要搜索的内容" value="<?php echo $keyWords ?>" aria-controls="example"> <button onClick="searchGo();" class="btn1 fl">Go</button></label>

                                            </div>

                                        </div>

                                        <div class="kong15"></div>

                                        </form>

                                    </div>

                                    <table class="table table-striped table-bordered dataTable" id="example" aria-describedby="example_info">

                                        <thead>

                                            <tr role="row">

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >姓名</th>

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >手机</th>

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >留言时间</th>

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >状态</th>

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">操作</th>

                                                <th role="columnheader"  tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;text-align: center;"><label>全选<input type="checkbox" value="0" onClick="checkAll(this)" name="checkAll" /></label></th>

                                            </tr>

                                        </thead>



                                        <tbody role="alert" aria-live="polite" aria-relevant="all">

                                            <?php foreach ($list['data'] as $val) {?>

                                            <tr class="gradeA odd">

                                                <td class=" "><?php echo $val['name']; ?></td>

                                                <td class=" "><?php echo $val['phone']; ?></td>

                                                <td class=" "><?php echo date('Y-m-d H:s', $val['add_time']); ?></td>

                                                <td class=" "><?php echo $val['status'] ? '已读' : '未读'; ?></td>

                                                <td><a href="/admin/message/messageInfo?id=<?php echo $val['id'] ?>"><button class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> 查看</button></a></td>

                                                <td style="text-align:center;"><input type="checkbox" name="id" value="<?php echo $val['id']; ?>" ></td>

                                            </tr>

                                            <?php }?>

                                            <tr class="gradeA odd">

                                                <td class=" sorting_1" align="right" colspan="10"><button onClick="checkData();" class="btn btn-big btn-primary">删除留言</button></td>

                                            </tr>

                                        </tbody>

                                    </table>

                                    <?php echo $list['pageStr'] ?>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

 <?php include __DIR__ . "/../public/foot.php"?>

            </div>

        </div>

    </div>

</body>

<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/vendors/jGrowl/jquery.jgrowl.js"></script>
<script type="text/javascript">
     function checkAll(obj){

        if($(obj).attr('checked')){

            $("input[name='id']").attr('checked',true);

        }else{

            $("input[name='id']").removeAttr('checked');

        }

    }

    function checkData(){

        var redPackNum = $("input[name='id']:checked").length;

        if(redPackNum == 0){

            alert('请选择要删除留言');
            return false;

        }
        if(confirm('确定永久删除吗?')){
            var arr=new Array();
            var ids=$(':input[name=id]:checked').each(function(i,v){
                arr[i]=v.value;
            });
            $.post('/admin/message/removeMessage',{id:JSON.stringify(arr)}, function(data, textStatus, xhr) {
                data=eval('('+data+')');
                if(data.status){
                    location.reload();
                }else{
                    alert(data.message);
                }
            });
        }

    }
</script>

