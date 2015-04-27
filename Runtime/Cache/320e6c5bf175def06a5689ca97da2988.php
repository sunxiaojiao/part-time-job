<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>兼职平台</title>

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
  .my-jobhead>p{position: absolute; top:10px; right:10px;}
  .my-jobhead>p>span{/*position: absolute;*/ margin-left: 10px;}
  .form-group a.login{position: relative; top:32px; left:36px; font:18px/18px "";}
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
        <li class=""><a href="<?php echo U('SortSearch/search');?>">分类查找</a></li>
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
  <div class="row">
    <!--left-->
    <div class="col-md-8">

      <div class="panel panel-default">
        <div class="panel-body">
          <div class="my-jobhead">
            <h3><?php echo ($title); ?></h3>
            <p><span>兼职类型：其他</span><span>发布时间：<?php echo (date("m月d日 h:i",$ctime)); ?></span></p>
          </div>
        </div>
      </div>
      <!--信息统计字段 具体还需要参考其他大型人才网站-->
      <div class="panel panel-default">
        <div class="panel-heading">详细信息</div>
        <div class="panel-body">
          <h3 class="">兼职描述</h3>
          <hr />
          <p><?php echo ($detail); ?> </p>
          <h3></h3>
          <hr />
          <p>联系人：<?php echo ($leader); ?></p>
          <p>联系电话：<?php echo ($leader_phone); ?></p>
          <h3>评价</h3>
          <hr />
          <p>好不好好不好好不好好不好好不好好不好好不好好不好</p>
          <form action="" method="post" class="">
            <?php if( session('?uid')): ?><div class="form-group">
              <label for="pingjia">评价:</label>
              <textarea class="form-control" rows="3" id="pingjia" name="pingjia" placeholder=""></textarea>
            </div>
            <button type="submit" class="btn btn-default">评价</button>
            <?php else: ?>
            <div class="form-group">
              <label for="pingjia">评价:</label>
              <a class="login" href="<?php echo U('Login/index');?>">登录</a>
              <textarea class="form-control" rows="3" id="pingjia" disabled="true" name="pingjia" placeholder="">请先登录</textarea>
            </div>
            <button type="submit" disabled="true" class="btn btn-default">评价</button><?php endif; ?>
          </form>
          <hr />
          <?php if(session('?uid')): ?><button type="button" id="goto-apply" class="btn btn-primary btn-lg">申请此兼职</button>
          <?php else: ?>
          <button type="button" id="goto-apply" class="btn btn-primary btn-lg" disabled="true">申请此兼职</button><?php endif; ?>
        </div>
      </div>
    </div>
    <!--right-->
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">关于小蜜蜂</div>
        <div class="panel-body">
          <img src="/__GROUP__/images/erweima.png" class="img-thumbnail center-block" />
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
<!--/footer-->
<script type="text/javascript">
  $("#goto-apply").click(function(){
    $.ajax({
      url:"<?php echo U('ApplyJob/apply');?>",
      success:function(data){
        alert(data.info);
      }
    });
  });
</script>
<!--./footer-->
</body>
</html>