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
#banner{height:200px; margin-bottom:12px;}
.my-explor{position: absolute; right:20px;}
.my-explor>.glyphicon{margin-right: 6px;}
.my-partjob-address,.my-partjob-people,.my-partjob-money,.my-explor{position: absolute;}
.my-partjob-people{left:330px;}
.my-partjob-money{left:450px;}
.my-partjob-address{left:200px;}
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
      <?php $url = U("Index/index"); $logoutUrl = U("Logout/index"); $name = session("?username") ? session('username') : session('orgname'); $info = session("?uid") ? '<li><a href="index.php?m=UserInfo">个人中心</a></li>' : '<li><a href="index.php?m=OrgInfo">个人中心</a></li>'; $dropdown = <<<THINK
      	<li class="dropdown">
          <a href="$url" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">$name<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            $info
            <li><a href="index.php?m=PublishJobs">发布兼职</a></li>
            <li class="divider"></li>
            <li><a href="$logoutUrl">注销</a></li>
          </ul>
        </li><!--/.dropdown-->
THINK;
 if(session('?uid')){ echo $dropdown; }elseif(session('?oid')){ echo $dropdown; }else{ echo "<li><a href=" . U('Register/index') . ">注册</a></li>
        	  <li><a href=" . U('Login/index') . ">登录</a></li>"; } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--======导航条结束======--->
<!--container-->
<!--banner-->
<div class="container" id="banner">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="./__GROUP__/images/1.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="./__GROUP__/images/1.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="./__GROUP__/images/1.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">兼职</div>
				<div class="panel-body">
					<!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#newest" aria-controls="newset" role="tab" data-toggle="tab">最近兼职工作</a></li>
				    <li role="presentation"><a href="#assort" aria-controls="assort" role="tab" data-toggle="tab">分类查找</a></li>
				    <li role="presentation"><a href="#resume" aria-controls="resume" role="tab" data-toggle="tab">求职简历</a></li>
				    
					<div class="input-group">
				      <input type="text" class="form-control" placeholder="输入关键词，搜索兼职信息">
				      <span class="input-group-btn">
				        <button class="btn btn-default" type="button">搜索</button>
				      </span>
				    </div><!-- /input-group -->
				    
				  </ul>

				  
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="newest">
				    	<!-- 兼职列表 -->
					  <ul class="list-group">
						<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$job): $mod = ($i % 2 );++$i;?><a href="<?php echo U('JobsInfo/index');?>&jid=<?php echo ($job["jid"]); ?>" class="list-group-item"><?php echo ($job["title"]); ?>
					    	
					    	<?php if(time()-$job['ctime'] <= 3600): ?><span class="label label-danger">New</span><?php endif; ?>
						    <span class="my-partjob-address">
						    	<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><?php echo ($job["address"]); ?></span>
						    <span class="my-partjob-money">
						    	<span class="glyphicon glyphicon-yen" aria-hidden="true"></span><?php echo ($job["money"]); ?>
						    </span>
						    <span class="my-partjob-people"></span><?php echo ($job["current_peo"]); ?>/<?php echo ($job["want_peo"]); ?>
						    <span class="my-explor">
						    	<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><?php echo ($job["pv"]); ?>
						    </span>
					    </a><?php endforeach; endif; else: echo "" ;endif; ?>
					  </ul>
					  <!--./兼职列表-->
				    </div>
				    <div role="tabpanel" class="tab-pane" id="assort">分类查找</div>
				    <div role="tabpanel" class="tab-pane" id="resume">求职简历</div>
				   
				    <nav>
					  <ul class="pagination">
					    <?php echo ($page); ?>
					  </ul>
					</nav>

				  </div>
				</div>
			</div>
		</div>
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
<!--end container-->
<!--footer-->
<div class="container">
	<hr />
	<p class="text-center">小蜜蜂兼职</p>
	<p class="my-info text-center"><a href="#">首页</a>/<a href="#">申请入住</a>/<a href="#">关于小蜜蜂</a>/<a href="#">联系我们</a></p>
	<p class="copyright text-center">Copyright ©小蜜蜂网络 / 备案号：ICP备13008243号-1 / 地址：烟台市红旗中路</p>
</div>
<!--footer-end-->
</body>
</html>