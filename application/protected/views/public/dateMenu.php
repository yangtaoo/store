<div class="rili">
    <p style="width:500px;">
        <?php foreach ($dateList as $key => $val) { ?>
            <a href="javascript:void(0);" onclick="loadListByDay('<?php echo $val['date']; ?>', '<?php echo $listType ?>', this)"<?php echo $key == 0 ? ' class="hover"' : ''; ?>><span><?php echo $val['week']; ?></span><?php echo $val['day'] ?></a>
        <?php } ?>
    </p>
</div>
<script type="text/javascript">
    function loadListByDay(date, type, obj) {
        $(".rili").find('a').removeClass('hover');
        $(obj).addClass('hover');
        if (type == 'class') {//课程加载
            $("#dataList").html('数据加载中...');
            var url = '/class/ajaxGetData';
            var data = {'date': date};
        }else if(type === 'training'){//训练营加载
            $("#dataList").html('数据加载中...');
            var url = '/trainingCamp/ajaxGetData';
            var data = {'date': date};
            
        }
        $.ajax({
                type: 'post',
                url: url,
                data: data,
                dataType: 'json',
                error: function(errormsg) {
                    alert(errormsg);
                },
                success: function(msg) {
                    var html = '';
                    if(msg.length !=0){
                        $("#data_list").show();
                        $("#no_tishi").hide();
                        if (type === 'class') {//课程加载
                            for (var i = 0; i < msg.length; i++) {
                                msg[i]['max_num'] = parseInt(msg[i]['max_num']);
                                msg[i]['join_num'] = parseInt(msg[i]['join_num']);
                                html += '<div class="kc_box">';
                                html += '<a href="/class/detail?id=' + msg[i]['id'] + '">';
                                html += '<div class="kc_img"><img src="' + msg[i]['img_url'] + '"></div>';
                                html += '<div class="kc_info">';
                                html += '<h2>' + msg[i]['title'] + '</h2>';
                                html += '<p class="p_xinxi"><span>教练：' + msg[i]['coach_name'] + '</span></p>';
                                html += '<p>时间：<span class="time">' + msg[i]['start_time'] + ' - ' + msg[i]['end_time'] + '</span></p>';
                                html += '</div>';
                                if (msg[i]['status'] != 1) {
                                    html += '<div class="kc_btn3">限制</div>';
                                } else if (msg[i]['max_num'] > msg[i]['join_num']) {
                                    html += '<div class="kc_btn1">预约</div>';
                                } else {
                                    html += '<div class="kc_btn2">排队</div>';
                                }
                                html += '<div class="clear"></div>';
                                html += '</a>';
                                html += '</div>';
                            }
                            $("#data_list").html(html);
                        }else if(type === 'training'){//训练营加载
                            for (var i = 0; i < msg.length; i++) {
                                msg[i]['max_num'] = parseInt(msg[i]['max_num']);
                                msg[i]['join_num'] = parseInt(msg[i]['join_num']);
                                html += '<div class="xly_box">';
                                html += '<a href="/trainingCamp/detail?id=' + msg[i]['id'] + '">';
                                if (msg[i]['status'] != 1) {
                                    html += '<div class="zhuangtai2"><img src="images/icon_xianzhi.png" /></div>';
                                } else if (msg[i]['max_num'] > msg[i]['join_num']) {
                                    html += '<div class="zhuangtai"><img src="images/icon_yuyue.png" /></div>';
                                } else {
                                    html += '<div class="zhuangtai"><img src="images/icon_paidui.png" /></div>';
                                }
                                html += '<div class="xly_img"><img src="' + msg[i]['img_url'] + '"></div>';
                                html += '<div class="xly_info">';
                                html += '<h2>' + msg[i]['title'] + '</h2>';
                                html += '<p class="p_xinxi"><span>教练：' + msg[i]['coach_name'] + '</span><span>时间：' + msg[i]['start_time'] + ' - ' + msg[i]['end_time'] + '</span></p>';
                                html += '<p class="p_money"><em>￥</em>' + msg[i]['price'] + '</p>';
                                html += '</div>';
                                html += '</a>';
                                html += '</div>';
                            }
                            $("#data_list").html(html);
                        }
                    }else{
                        $("#data_list").hide();
                        $("#no_tishi").show();
                    }
                }
            });
    }
</script>