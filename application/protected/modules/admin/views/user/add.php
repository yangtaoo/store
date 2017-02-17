<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/data_time.js"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#zdgroup").attr("disabled", true);

        /*
         * 提交
         */
        $("#submitbutton").click(function() {
            if (validateForm()) {
                $("#submitForm").submit();
            }
        });

        /*
         * 取消
         */
        $("#cancelbutton").click(function() {
            /**  关闭弹出iframe  **/
            window.parent.$.fancybox.close();
        });

        <?php if(isset($message['status']) && $message['status'] == 1){ ?>
                alert("用户添加成功!");
            /**  关闭弹出iframe  **/
            window.parent.$.fancybox.close();
            window.parent.location.reload();
        <?php }elseif(!empty ($message['message'])){ ?>
            alert("<?php echo $message['message'] ?>");
        <?php } ?>

        tinymce.init({
            selector: "textarea",
            language: "zh_CN",
            plugins: "image",
        });


    });


    /** 表单验证  **/
    function validateForm() {
//        if(!checkUsername()){
//            return false;
//        }
        if (!checkPassword()) {
            return false;
        }
        if (!checkRePassword()) {
            return false;
        }
        if (!checkInfo('AccountTelephone')) {
            return false;
        }
        if (!checkInfo('AccountMobilePhone')) {
            return false;
        }
        if (!checkInfo('AccountEmail')) {
            return false;
        }
        return true;
    }

    function checkUsername() {
        var reg = /^([0-9a-zA-z]|_){6,12}$/;

        if ($("#AccountName").val() == "") {
            $("#error_username").html("<span style='color:red'>用户名不能为空！</span>");
            return false;
        }
        if (!reg.test($("#AccountName").val())) {
            $("#error_username").html("<span style='color:red'>用户名格式不正确！</span>");
            return false;
        }

        $.ajax({
            type: "POST",
            url: "/admin/user/checkInfo",
            data: {'AccountName':$("#AccountName").val(), 'type':'AccountName'},
            dataType: "json",
            success: function(data) {
                if (data.status == 1) {
                    $("#error_username").html("<span style='color:green'>✔</span>");
                    return true;
                } else {
                    $("#error_username").html("<span style='color:red'>" + data.message + "！</span>");
                    return false;
                }
            }
        });
    }

    function tipsUsername() {
        $("#error_username").html("<span style='color:blue'>用户名由6-12位数字字母或下划线组成</span>");
    }

    function checkPassword() {
        var reg = /^([0-9a-zA-z]|_){4,20}$/;

        if ($("#AccountPassword").val() == "") {
            $("#error_password").html("<span style='color:red'>密码不能为空！</span>");
            return false;
        }
        if (!reg.test($("#AccountPassword").val())) {
            $("#error_password").html("<span style='color:red'>密码格式不正确！</span>");
            return false;
        }
        reg = /^[0-9]{4,20}$|^[a-zA-Z]{4,20}$|^_{4,20}$/;
        if (reg.test($("#AccountPassword").val())) {
            $("#error_password").html("<span style='color:yellow'>✔&nbsp;&nbsp;密码强度：弱</span>");
            return true;
        }
        reg = /^[0-9a-zA-Z]{4,20}$|^([0-9]|_){4,20}$|^([a-zA-Z]|_){4,20}$/;
        if (reg.test($("#AccountPassword").val())) {
            $("#error_password").html("<span style='color:#ff9224;'>✔&nbsp;&nbsp;密码强度：中</span>");
            return true;
        }
        $("#error_password").html("<span style='color:green'>✔&nbsp;&nbsp;密码强度：强</span>");
        return true;
    }

    function tipsPassword() {
        $("#error_password").html("<span style='color:blue'>密码名由4-20位数字字母或下划线组成</span>");
    }

    function checkRePassword() {
        var reg = /^([0-9a-zA-z]|_){4,20}$/;

        if ($("#AccountPassword").val() != $("#AccountRePassword").val()) {
            $("#error_repassword").html("<span style='color:red'>两次密码不一致！</span>");
            return false;
        }
        $("#error_repassword").html("<span style='color:green'>✔</span>");
        return true;
    }
    function tipsRePassword() {
        $("#error_repassword").html("<span style='color:blue'>请重复输入密码</span>");
    }

    function checkUname() {
        if ($("#uname").val() == "") {
            $("#error_uname").html("<span style='color:red'>姓名不能为空！</span>");
            return false;
        }

        $("#error_username").html("<span style='color:green'>✔</span>");
        return true;
    }

    function tipsUname() {
        $("#error_uname").html("<span style='color:blue'>姓名用于通讯录显示</span>");
    }
    
    function checkInfo(type){
        var reg = '';
        var info = $("#"+type).val();
        var errormsg = '';
        switch(type){
            case "AccountTelephone":
                if(info == ""){
                    return true;
                }
                reg = /^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/;
                if(!reg.test(info)){
                    errormsg = "<span style='color:red'>电话号码格式不正确！</span>";
                    $("#error_" + type).html(errormsg);
                    return false;
                }else{
                    $("#error_" + type).html(errormsg);
                    return true;
                }
                break;
            case "AccountMobilePhone":
                reg = /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;
                if(!reg.test(info)){
                    errormsg = "<span style='color:red'>移动电话号码格式不正确！</span>";
                    $("#error_" + type).html(errormsg);
                    return false;
                }else{
                    $("#error_" + type).html(errormsg);
                    return true;
                }
                break;
            case "AccountEmail":
                if(info == ""){
                    return true;
                }
                reg = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
                if(!reg.test(info)){
                    errormsg = "<span style='color:red'>电子邮箱地址格式不正确！</span>";
                    $("#error_" + type).html(errormsg);
                    return false;
                }else{
                    $("#error_" + type).html(errormsg);
                    return true;
                }
                break;
        }
        return true;
    }
</script>
</head>
<form id="submitForm" name="submitForm" enctype="multipart/form-data" action="/admin/user/add" method="post">
    <div id="container">
        <div id="nav_links">
            当前位置：通讯录&nbsp;>&nbsp;<span style="color: #1A5CC6;">添加用户</span>
        </div>
        <div class="ui_content">
            <table  cellspacing="10" cellpadding="10" width="100%" align="left" border="0">
                <tr>
                    <td class="ui_text_rt" width="100">用户名：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="text" id="AccountName" name="AccountName" value="" onBlur="checkUsername();" onFocus="tipsUsername();"/><span style="color: red"> *</span>
                    </td>
                    <td id="error_username"></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">密码：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="password" id="AccountPassword" name="AccountPassword" value="" onBlur="checkPassword();" onFocus="tipsPassword();"/><span style="color: red"> *</span>
                    </td>
                    <td id="error_password"></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">重复密码：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="password" id="AccountRePassword" name="AccountRePassword" value="" onBlur="checkRePassword();" onFocus="tipsRePassword();"/><span style="color: red"> *</span>
                    </td>
                    <td id="error_repassword"></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">真实姓名：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="text" id="AccountTrueName" name="AccountTrueName" value="" />
                    </td>
                    <td id="error_username"></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">性别：</td>
                    <td class="ui_text_lt" width="200">
                        <?php foreach(UserModel::getInstance()->gender as $key=>$val){ ?>
                                            <label><input type="radio" <?php echo $key == $userInfo['AccountGender'] ? ' checked':'' ?> value="<?php echo $key ?>" name="AccountGender" > <?php echo $val; ?>&nbsp;&nbsp;</label>
                                            <?php } ?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">出生日期：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="text" id="AccountBirthday" name="AccountBirthday" value="<?php echo date("Y-m-d", $userInfo['AccountBirthday']) ?>" class="Wdate" onClick="WdatePicker({dateFmt:'yyyy-MM-dd',maxDate:'%y-%M-%d'});" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">固定电话：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="text" id="AccountTelephone" name="AccountTelephone" value="" onblur="checkInfo('AccountTelephone');"/>
                    </td>
                    <td id="error_AccountTelephone"></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">移动电话：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="text" id="AccountMobilePhone" name="AccountMobilePhone" value="" onBlur="checkInfo('AccountMobilePhone');" /><span style="color: red"> *</span>
                    </td>
                    <td id="error_AccountMobilePhone"></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">政治成分：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="text" id="AccountPolitics" name="AccountPolitics" value="" onBlur="checkInfo('AccountPolitics');" />
                    </td>
                    <td id="error_AccountPolitics"></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">电子邮箱：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="text" id="AccountEmail" name="AccountEmail" value="" onBlur="checkInfo('AccountEmail');" />
                    </td>
                    <td id="error_AccountEmail"></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">工作地点：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="text" id="AccountWorkStation" name="AccountWorkStation" value="" onBlur="checkInfo('AccountWorkStation');" />
                    </td>
                    <td id="error_AccountWorkStation"></td>
                </tr>
                <tr style="display: none;">
                    <td class="ui_text_rt" width="100">头像：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="file" name="AccountPhoto" id="AccountPhoto" >
                    </td>
                    <td id="error_AccountPhoto"></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">传真：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="text" id="AccountFax" name="AccountFax" value="" onBlur="checkInfo('AccountFax');" />
                    </td>
                    <td id="error_AccountFax"></td>
                </tr>
                <tr>
                    <td class="ui_text_rt" width="100">备注：</td>
                    <td class="ui_text_lt" width="200">
                        <input type="text" id="AccounTremark" name="AccounTremark" value="" onBlur="checkInfo('AccounTremark');" />
                    </td>
                    <td id="error_AccounTremark"></td>
                </tr>
                
                <tr>
                    <td class="ui_text_rt" width="100">所属部门：</td>
                    <td class="ui_text_lt" width="200">
                        <select name="DepartmentID" id="DepartmentID" class="ui_select01">
                            <option value="0">顶级部门</option>
                            <?php foreach ($departmentTree as $val) { ?>
                                <option value="<?php echo $val['DepartmentID'] ?>"<?php echo $val['DepartmentID'] == $userInfo['DepartmentID'] ? " selected" : ""; ?>><?php echo $val['DepartmentName'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td id="error_urank"></td>
                </tr>

                <tr>
                    <td class="ui_text_rt" width="100">职级：</td>
                    <td class="ui_text_lt" width="200">
                        <select name="PositionID" id="PositionID" class="ui_select01">
                            <option value="0">顶级职级</option>
                            <?php foreach ($positionTree as $val) { ?>
                                <option value="<?php echo $val['PositionID'] ?>"<?php echo $val['PositionID'] == $userInfo['PositionID'] ? " selected" : ""; ?>><?php echo $val['PositionName'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td id="error_urank"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="ui_text_lt">
                        &nbsp;<input id="submitbutton" type="button" value="提交" class="ui_input_btn01"/>
                        &nbsp;<input id="cancelbutton" type="button" value="取消" class="ui_input_btn01"/>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>