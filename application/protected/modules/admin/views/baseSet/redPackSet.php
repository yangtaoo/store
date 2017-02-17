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
                <div class="row">
                    <div class="">
                        <div class="page-header bootstrap-admin-content-title">
                            <h1>评测红包设置</h1>
                        </div>
                    </div>
                </div>

                <?php if ($updateStatu === true) { ?>
                    <div class="alert alert-success">
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <strong>Success!</strong> 数据更新成功！
                    </div>
                <?php } ?>
                <?php if ($updateStatu === false) { ?>
                    <div class="alert alert-danger">
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <strong>Error!</strong> 数据更新失败！
                    </div>
                <?php } ?>
                <div class="row">
                    <div class=" ">
                        <div class="panel panel-default bootstrap-admin-no-table-panel">
                            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                <form class="form-horizontal" method="post">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">红包最小金额(元)</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="min_price" name="min_price" style="width:20%" value="<?php echo isset($baseSet['min_price']) ? $baseSet['min_price']/100 : '' ?>" type="text" placeholder="请输入红包最小金额...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">红包最大金额(元)</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" id="max_price" name="max_price" style="width:20%" value="<?php echo isset($baseSet['max_price']) ? $baseSet['max_price']/100 : '' ?>" type="text" placeholder="请输入红包最大金额...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput">祝福语</label>
                                            <div class="col-lg-10">
                                                <textarea id="wishing" name="wishing" class="form-control textarea-wysihtml5" placeholder="请输入128字以内的祝福语..." style="width: 100%; height: 200px"><?php echo isset($baseSet['wishing']) ? $baseSet['wishing'] : '' ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label" for="focusedInput"></label>
                                            <div class="col-lg-10">

                                                <button type="submit" onClick="return checkForm()" class="btn btn-primary">提 交</button>
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

    <!-- footer -->
    <?php include __DIR__ . "/../public/foot.php" ?>
</body>
<script type="text/javascript">
    function checkForm(){
        var min_price = $("#min_price").val().trim();
        if(!min_price){
            alert('请输入红包最小金额');
            $("#min_price").focus();
            return false;
        }
        if(isNaN(min_price)){
            alert('红包最小金额只能是一个数字');
            $("#min_price").focus();
            return false;
        }
        if(min_price < 1){
            alert('红包最小金额不能小于1元');
            $("#min_price").focus();
            return false;
        }
        var max_price = $("#max_price").val().trim();
        if(!max_price){
            alert('请输入红包最大金额');
            $("#max_price").focus();
            return false;
        }
        if(isNaN(max_price)){
            alert('红包最大金额只能是一个数字');
            $("#max_price").focus();
            return false;
        }
        if(max_price > 10){
            alert('红包最大金额不能大于10元');
            $("#max_price").focus();
            return false;
        }
        if(max_price < min_price){
            alert('红包最大金额不能小于最小金额');
            $("#max_price").focus();
            return false;            
        }
        var wishing = $("#wishing").val().trim();
        if(!wishing){
            alert('红包祝福语不能为空！');
            $("#wishing").focus();
            return false;            
        }
        if(!wishing.length > 128){
            alert('红包祝福语不能超过128个字符！');
            $("#wishing").focus();
            return false;            
        }
        return true;
    }
</script>