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

                            <h1>用户管理</h1>

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

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 60px;">ID</th>

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 120px;">昵称</th>

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 60px; text-align:center;">性别</th>

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 150px;">地区(国家-省-市)</th>

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 80px; text-align:center;">头像</th>

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 140px;text-align:center;">加入会员时间</th>

                                                <th role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 165px;text-align:center;">上一次进入网站时间</th>

                                            </tr>

                                        </thead>



                                        <tbody role="alert" aria-live="polite" aria-relevant="all">

                                            <?php foreach ($list['data'] as $val) {?>

                                            <tr class="gradeA odd">

                                                <td class=" "><?php echo $val['id']; ?></td>

                                                <td class=" "><?php echo $val['nickname']; ?></td>

                                                <td align="center"><?php echo $val['sex'] == 1 ? '男' : ($val['sex'] == 2 ? '女' : '-'); ?></td>

                                                <td><?php echo $val['country'] . (empty($val['country']) ? '' : '-') . $val['province'] . (empty($val['province']) ? '' : '-') . $val['city']; ?></td>

                                                <td align="center" class="center "><img style="width:50px; height:50px;" src="<?php echo $val['headimgurl'] ? $val['headimgurl'] : '/images/logo300.png'; ?>" /></td>

                                                <td align="center "><?php echo date("Y-m-d H:i", $val['addtime']); ?></td>

                                                <td align="center "><?php echo date("Y-m-d H:i", $val['lastlogintime']); ?></td>

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



    <!-- footer -->

    <?php include __DIR__ . "/../public/foot.php"?>

    <button href="#myModal" data-toggle="modal" id="showModal" style="display:none" class="btn btn-warning">发送红包</button>

    <div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: none;">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                    <h4 id="myModalLabel" class="modal-title">红包发送</h4>

                </div>

                <div class="modal-body">

                    <p>单个红包金额：<input type="text" id="price" value="" size="2" /> 元</p>

                    <p id="sending">准备发送</p>

                    <div class="progress progress-striped active">

                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%">

                            &nbsp;

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" onClick="sendRedPack()" class="btn btn-warning">开始</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

                </div>

            </div>

        </div>

    </div>



</body>

<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/vendors/jGrowl/jquery.jgrowl.js"></script>

<script type="text/javascript">



    function checkAll(obj){

        if($(obj).attr('checked')){

            $("input[name='openid']").attr('checked',true);

        }else{

            $("input[name='openid']").removeAttr('checked');

        }

    }


    function checkData(){

        var redPackNum = $("input[name='openid']:checked").length;

        if(redPackNum == 0){

            alert('请至少选择一个用户');

            return false;

        }

        $("#showModal").click();

    }

    function sendRedPack(){

        var redPackNum = $("input[name='openid']:checked").length;

        if(redPackNum == 0){

            alert('请至少选择一个用户');

            return false;

        }

        var price = $("#price").val().trim();

        if(!price){

            alert('请输入红包金额');

            $("#price").focus();

            return false;

        }

        if(isNaN(price)){

            alert('红包金额只能是一个数字');

            $("#price").focus();

            return false;

        }

        if(price > 200){

            alert('单个红包金额不能大于200元');

            $("#price").focus();

            return false;

        }



        price = Math.ceil(price*100);



        var i = 1;

        var size = Math.ceil(100/redPackNum);

        $("#sending").html('红包发送中...(' + i +'/'+ redPackNum +')，发送过程中请匆关闭或刷新当前页面！');

        $("input[name='openid']:checked").each(function(){

            $.ajax({

                url:'/admin/User/AjaxRedPack',

                type:'post',

                dataType:'json',

                data:{'openid':this.value, 'price':price},

                async:false,

                error:function(errormsg){ alert(errormsg); },

                success:function(msg){

                    $(".progress-bar").css('width', (size * i) + '%');

                    $("#sending").html('红包发送中...(' + i +'/'+ redPackNum +')，发送过程中请匆关闭或刷新当前页面！');

                    if(msg.status){



                    }else{

                        alert(msg.message);

                    }

                    i ++ ;

                }

            });

        });

        alert("全部红包发放完毕");

        $(".close").click();



    }

    function reflushTime(uid){

        $.ajax({

                url:'/admin/User/AjaxReflushTime',

                type:'post',

                dataType:'json',

                data:{'uid':uid},

                async:false,

                error:function(errormsg){ alert(errormsg); },

                success:function(msg){

                    alert(msg.message);

                    if(msg.status){

                        window.location.reload();

                    }else{

                        return false;

                    }

                }

            });

    }

</script>

