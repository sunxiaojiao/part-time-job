<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>兼职平台</title>

<link rel="stylesheet" href="./__GROUP__/css/bootstrap.min.css">
<link rel="stylesheet" href="./__GROUP__/css/bootstrap-theme.min.css">
<script src="./__GROUP__/js/jquery.min.js"></script>
<script src="./__GROUP__/js/bootstrap.min.js"></script>
<style type="text/css">
  .panel-body{position: relative;}
  .my-perinfo{margin-left:26px;}
  .my-perinfo>p>span{margin-right:18px;}
  .my-perimg{border:1px solid #EEE;}
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
      <a class="navbar-brand" href="index.php">小蜜蜂兼职</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="#">切换城市 [烟台]</a></li>
      </ul>

      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="输入关键词">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo U('Register/index');?>">注册</a></li>
        <li><a href="<?php echo U('Login/index');?>">登录</a></li>
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li> --><!--/.dropdown-->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--======导航条结束======-->
<!--container-->
<div class="container">
  <div class="row">
    <!--left-->
    <div class="col-md-8">

      <div class="panel panel-default">
        <div class="panel-body">
          <img src="<?php echo ($headlogo); ?>" class="pull-left my-perimg" />
          <div class="pull-left my-perinfo">
            <h3><?php echo ($username); ?></h3>
            <p><span><?php echo ($sex); ?></span><span><?php echo ($age); ?></span></p>
          </div>
        </div>
      </div>
      <!--信息统计字段 具体还需要参考其他大型人才网站-->
      <div class="panel panel-default">
        <div class="panel-heading">个人信息</div>
        <div class="panel-body">
          <h3 class="">基本信息</h3>
          <hr />
          <p>所在城市：<?php echo ($city); ?></p>
          <p>所在学校：<?php echo ($school); ?></p>
          <p>求职意向：<?php echo ($intent); ?></p>
          <p>工作经验：<?php echo ($exp); ?></p>
          <h3>联系方式</h3>
          <hr />
          <p>QQ：<?php echo ($qq); ?></p>
          <p>电话：<?php echo ($phone); ?></p>
          <p>下载APP查看</p>
        </div>
      </div>
    </div>
    <!--right-->
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">关于小蜜蜂</div>
        <div class="panel-body">
          <img src="./__GROUP__/images/erweima.png" class="img-thumbnail center-block" />
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
</body>
</html>