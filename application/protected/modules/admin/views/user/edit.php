<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/tinymce/tinymce.min.js"></script>
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
        <?php if($message['status'] == 1){ ?>
                alert('信息更新成功!');
            /**  关闭弹出iframe  **/
                window.parent.$.fancybox.close();
                window.parent.location.reload();
        <?php } elseif (!empty($message['message'])) { ?>
            alert("<?php $message['message'] ?>");
        <?php } ?>
        tinymce.init({
            selector: "textarea",
            language: "zh_CN",
            plugins: "image",
        });


    });

    /** 表单验证  **/
    function validateForm() {
        if (!checkPassword()) {
            return false;
        }
        return true;
    }

    function checkUsername() {
        var reg = /^([0-9a-zA-z]|_){6,12}$/;

        if ($("#username").val() == "") {
            $("#error_username").html("<span style='color:red'>用户名不能为空！</span>");
            return false;
        }
        if (!reg.test($("#username").val())) {
            $("#error_username").html("<span style='color:red'>用户名格式不正确！</span>");
            return false;
        }

        $.ajax({
            type: "POST",
            url: "UserCheckServlet",
            data: "username=" + $("#username").val(),
            dataType: "text",
            success: function(data) {
                if (data == 1) {
                    $("#error_username").html("<span style='color:green'>✔</span>");
                    return true;
                } else {
                    $("#error_username").html("<span style='color:red'>用户名已存在！</span>");
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
            $("#error_password").html("留空为不修改");
            return true;
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
        $("#error_password").html("<span style='color:blue'>用户名由4-20位数字字母或下划线组成</span>");
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

    function tipsUrank() {
        $("#error_urank").html("<span style='color:blue'>排序取值为0-999之前整数，数字越小的用户显示越靠前</span>");
    }
</script>
<form id="submitForm" name="submitForm" enctype="multipart/form-data" action="/admin/user/edit" method="post">
    <input type="hidden" id="AccountID" name="AccountID" value="<?php echo $userInfo['AccountID'] ?>" >
	<div id="container">
		<div id="nav_links">
			当前位置：通讯录&nbsp;>&nbsp;<span style="color: #1A5CC6;">编辑用户</span>
		</div>
		<div class="ui_content">
			<table  cellspacing="10" cellpadding="10" width="100%" align="left" border="0">
				<tr>
					<td class="ui_text_rt" width="100">用户名：</td>
					<td class="ui_text_lt" width="200"><?php echo $userInfo['AccountName'] ?></td>
					<td id="error_username"></td>
				</tr>
				<tr>
					<td class="ui_text_rt" width="100">密码：</td>
					<td class="ui_text_lt" width="200">
						<input type="password" id="AccountPassword" name="AccountPassword" value="" onBlur="checkPassword();" onFocus="tipsPassword();"/>
					</td>
					<td id="error_password">留空为不修改</td>
				</tr>
				
                                <tr>
                                    <td class="ui_text_rt" width="100">真实姓名：</td>
                                    <td class="ui_text_lt" width="200">
                                        <input type="text" id="AccountTrueName" name="AccountTrueName" value="<?php echo $userInfo['AccountTrueName'] ?>" />
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
                                            <input type="text" id="AccountBirthday" name="AccountBirthday" class="Wdate" onClick="WdatePicker({dateFmt:'yyyy-MM-dd',maxDate:'%y-%M-%d'});" value="<?php echo date("Y-m-d", $userInfo['AccountBirthday']) ?>"/>
					</td>
					<td></td>
				</tr>
				<tr>
					<td class="ui_text_rt" width="100">电话：</td>
					<td class="ui_text_lt" width="200">
                                            <input type="text" id="AccountTelephone" name="AccountTelephone" value="<?php echo $userInfo['AccountTelephone'] ?>"/>
					</td>
					<td></td>
				</tr>
				<tr>
					<td class="ui_text_rt" width="100">移动电话：</td>
					<td class="ui_text_lt" width="200">
                                            <input type="text" id="AccountMobilePhone" name="AccountMobilePhone" value="<?php echo $userInfo['AccountMobilePhone'] ?>"/><span style="color: red"> *</span>
					</td>
					<td></td>
				</tr>
				<tr>
					<td class="ui_text_rt" width="100">政治成分：</td>
					<td class="ui_text_lt" width="200">
                                            <input type="text" id="AccountPolitics" name="AccountPolitics" value="<?php echo $userInfo['AccountPolitics'] ?>"/>
					</td>
					<td></td>
				</tr>
				<tr>
					<td class="ui_text_rt" width="100">电子邮件：</td>
					<td class="ui_text_lt" width="200">
                                            <input type="text" id="AccountEmail" name="AccountEmail" value="<?php echo $userInfo['AccountEmail'] ?>"/>
					</td>
					<td></td>
				</tr>
				<tr>
					<td class="ui_text_rt" width="100">工作地点：</td>
					<td class="ui_text_lt" width="200">
                                            <input type="text" id="AccountWorkStation" name="AccountWorkStation" value="<?php echo $userInfo['AccountWorkStation'] ?>"/>
					</td>
					<td></td>
				</tr>
				<tr>
					<td class="ui_text_rt" width="100">传真：</td>
					<td class="ui_text_lt" width="200">
                                            <input type="text" id="AccountFax" name="AccountFax" value="<?php echo $userInfo['AccountFax'] ?>"/>
					</td>
					<td></td>
				</tr>
				<tr>
					<td class="ui_text_rt" width="100">备注：</td>
					<td class="ui_text_lt" width="200">
                                            <input type="text" id="AccounTremark" name="AccounTremark" value="<?php echo $userInfo['AccounTremark'] ?>"/>
					</td>
					<td></td>
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