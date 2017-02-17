<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>番茄健身</title>
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport" />

<head>
<script type="text/javascript" src="js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="js/scrpit.js"></script>
<link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header>
    <div class="user"><a href="#"><img src="/images/user.jpg"></a></div>
    <div class="weizhi"><img src="/images/icon_weizhi.png" /><select>
      <option value="成都">成都</option>
      <option value="北京">北京</option>
      <option value="深圳">深圳</option>
  </select><select>
      <option value="金牛万达店">金牛万达店</option> 
      <option value="锦华万达店">万达店</option>
  </select></div>
</header> 

<section>
	<ul class="news_list">
  <?php foreach($rows as $val) {?>
    	<li><a href="/article/detail?id=<?php echo $val['id'] ?>" target="_blank"><span><?php echo $val['name'] ?></span><?php echo date('Y-m-d H:i',$val['inputtime']) ?></a></li>
  <?php } ?>      
    </ul>
       
</section>  

 

</body>
</html>
