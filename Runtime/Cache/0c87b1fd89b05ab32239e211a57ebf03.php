<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>用户中心</title>

<link href="/Public/favicon.ico" type="image/x-icon" rel=icon />
<link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/jquery.min.js"></script>
<script src="/__GROUP__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/__GROUP__/js/common.js"></script>

<style type="text/css">
  .panel-body{position: relative;}
  .my-perinfo{margin-left:26px;}
  .my-perinfo>p>span{margin-right:18px;}
  .my-perimg{border:1px solid #EEE;}
  .my-select-address{}
  .my-select-address>select{width:auto;display: inline-block;}
  .my-personimg{width:200px; cursor: pointer;}
  #swfwrapper{width:630px;}
  .must-input {
        color: #F00;
        padding: 0 8px;
        font: 18px/18px "";
    }
    

</style>
</head>
<body>
<!--======导航条======-->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">小蜜蜂兼职</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="<?php echo U('ChangeCity/index');?>">切换城市 [<?php echo session("?city") ? session("city") : "烟台" ?><strong>·</strong><?php echo session("?area") ? session("area") : "芝罘区" ?>]</a></li>
      </ul>

      <form class="navbar-form navbar-left" role="search" method="get" action="<?php echo U('Search/s');?>">
        <div class="form-group">
          <input type="text" class="form-control" name="wd" placeholder="兼职/地点/工资...">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form>
      <ul class="nav navbar-nav sort-search">
        <li class=""><a href="/SortSearch/search.html?q=q">分类查找</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php $url = U("Index/index"); $logoutUrl = U("Logout/index"); $name = session("?username") ? session('username') : session('orgname'); $info = session("?uid") ? '<li><a href="/UserCenter">个人中心</a></li>' : '<li><a href="/OrgCenter">企业中心</a></li>'; $dropdown1 = <<<THINK
      	<li class="dropdown">
          <a href="$url" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">$name<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            $info
            <li><a href="/PublishJobs">发布兼职</a></li>
            <li><a href="/ChangePasswd">修改密码</a></li>
            <li class="divider"></li>
            <li><a href="$logoutUrl">注销</a></li>
          </ul>
        </li><!--/.dropdown-->
THINK;
 $dropdown2 = <<<THINK
        <li class="dropdown">
          <a href="$url" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">$name<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            $info
            <li><a href="/ChangePasswd">修改密码</a></li>
            <li class="divider"></li>
            <li><a href="$logoutUrl">注销</a></li>
          </ul>
        </li><!--/.dropdown-->
THINK;
 if(session('?uid')){ echo $dropdown2; }elseif(session('?oid')){ echo $dropdown1; }else{ echo "<li><a href=" . U('Register/sendMail') . ">注册</a></li>
        	  <li><a href=" . U('Login/index') . ">登录</a></li>"; } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--======导航条结束======--->
<!--container-->
<div class="container">
  <div class="page-header">
      <h1><small>我的小蜜蜂<small>(<?php echo ($userinfo["email"]); ?>)</small></small></h1>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">个人信息及求职简历<a href="<?php echo U("UserCenter/editInfo");?>" class="pull-right">编辑我的资料和简历</a></div>
        <div class="panel-body">
          <table class="table">
            <tr>
            <td>用户名：</td>
            <td><?php echo ($userinfo["username"]); ?></td>
            <td>性别</td>
            <td>
            <?php switch($userinfo["sex"]): case "1": ?>男<?php break;?>
              <?php case "2": ?>女<?php break;?>
              <?php default: ?>保密<?php endswitch;?>
            </td>
            </tr>
            <tr>
              <td>年龄：</td>
              <td><?php echo ($userinfo["age"]); ?>岁</td>
              <td>电话：</td>
              <td><?php echo ($userinfo["phone"]); ?></td>
            </tr>
            <tr><td>地址：</td>
            <td><?php echo ($userinfo["address"]); ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">我的申请</div>
        <div class="panel-body">
        <table class="table">
        <thead>
          <td>兼职</td>
          <td>申请时间</td>
          <td>是否通过</td>
        </thead>
         <?php if($apply_error_info): ?><tr><td class="list-group-item"><?php echo ($apply_error_info); ?></td></tr>
          <?php else: ?>
 <?php if(is_array($apply)): $i = 0; $__LIST__ = $apply;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$apply): $mod = ($i % 2 );++$i;?><tr>
            <td><a href="<?php echo U('JobsInfo/index');?>?jid=<?php echo ($apply["jid"]); ?>"><?php echo ($apply["title"]); ?></a></td>
            <td><?php echo (date("m/d h:i",$apply["ctime"])); ?></td>
            <td>
            <?php switch($apply["is_pass"]): case "1": ?>处理中...<?php break;?>
              <?php case "2": ?>通过<?php break;?>
              <?php case "3": ?>未通过<?php break; endswitch;?>
            </td>
          </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </table>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">我的兼职</div>
        <div class="panel-body">
          <ul class="list-group">
          <?php if($passed_error_info): ?><li class="list-group-item"><?php echo ($passed_error_info); ?></li>
          <?php else: ?>
            <?php if(is_array($passed_job)): $i = 0; $__LIST__ = $passed_job;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$apply): $mod = ($i % 2 );++$i;?><a href="<?php echo U('JobsInfo/index');?>?jid=<?php echo ($apply["jid"]); ?>" class="list-group-item"><?php echo ($apply["title"]); echo (date("m-d",$apply["ctime"])); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-default">
      <div class="panel-heading">头像</div>
        <div class="panel-body">
          <img src="<?php echo ($userinfo["avatar"]); ?>" class="center-block" />
        </div>
      </div>
    </div>  
  </div>
</div>
<!--./container-->
<!--footer-->
<div class="container">
  <hr />
  <p class="text-center">小蜜蜂兼职</p>
  <p class="my-info text-center"><a href="#">首页</a>/<a href="#">申请入住</a>/<a href="#">关于小蜜蜂</a>/<a href="#">联系我们</a></p>
  <p class="copyright text-center">Copyright ©小蜜蜂网络 / 备案号：ICP备13008243号-1 / 地址：烟台市红旗中路</p>
</div>
<!--./footer-->
<script type="text/javascript">
$("#goto-info").click(function(){
  $(".alert").addClass("hidden");
	//获取数据
	var info = getFromInput('#edit-info');
	var checkboxs = $("input[type='checkbox']");
	var intent = new Object();
	for(var i=0;i<checkboxs.length;i++){
		if(checkboxs.eq(i).is(":checked")){
			intent[i] = checkboxs.eq(i).val();
		}
	}
	info.intent = intent;
	//ajax
	$.ajax({
		url:'<?php echo U('UserCenter/updateInfo');?>',
		data:info,
		type:"POST",
		success:function(data){
      if(data.data ===1){
        $(".alert").removeClass("alert-danger").addClass("alert-success");
      }else{
        $(".alert").removeClass("alert-success").addClass("alert-danger");
      }
			$(".alert>p").text(data.info);
      $(".alert").removeClass("hidden");
		}
		});
});


</script>
</body>
</html>