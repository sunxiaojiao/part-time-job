<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>兼职平台</title>

<link rel="stylesheet" href="/__GROUP__/css/bootstrap.min.css">
<link rel="stylesheet" href="/__GROUP__/css/bootstrap-theme.min.css">
<script src="/__GROUP__/js/jquery.min.js"></script>
<script src="/__GROUP__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/__GROUP__/js/common.js"></script>

<style type="text/css">
#banner{height:200px; margin-bottom:12px;}
.my-explor{position: absolute; right:20px;}
.my-explor>.glyphicon{margin-right: 6px;}
.my-partjob-address,.my-partjob-people,.my-partjob-money,.my-explor{position: absolute;}
.my-partjob-people{left:330px;}
.my-partjob-money{left:450px;}
.my-partjob-address{left:200px;}
.my-select-address{display: inline-block;}
  .my-select-address>select{width:auto;display: inline-block;}
.my-zimu{display: block; padding:4px 6px 4px 32px; margin-bottom: 6px;}
.my-addr-list a{ display: inline-block; padding:4px 6px; margin:1px 20px 20px; outline: 1px solid #EEE; cursor: pointer;}
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

      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="输入关键词">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form>

      <ul class="nav navbar-nav navbar-right">
      <?php $url = U("Index/index"); $logoutUrl = U("Logout/index"); $name = session("?username") ? session('username') : session('orgname'); $info = session("?uid") ? '<li><a href="index.php?m=UserCenter">个人中心</a></li>' : '<li><a href="index.php?m=OrgCenter">企业中心</a></li>'; $dropdown = <<<THINK
      	<li class="dropdown">
          <a href="$url" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">$name<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            $info
            <li><a href="index.php?m=PublishJobs">发布兼职</a></li>
            <li><a href="index.php?m=ChangePasswd&a=index">修改密码</a></li>
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
      <img src="./images/1.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="./images/1.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="./images/1.jpg" alt="...">
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
<!--container-->
<div class="container">
<div class="row">
    <div class="col-md-4">
      <form action="" method="get" class="">
        <div class="form-group">
              <label for="username">居住地：</label>
              <div class="my-select-address">
                <select name="" id="" class="form-control">
                  <option value=""><?php echo ($addr["province"]); ?></option>
                </select>
                <select name="" id="" class="form-control">
                  <option value=""><?php echo ($addr["city"]); ?></option>
                </select>
                <select name="" id="" class="form-control">
                  <option value=""><?php echo ($addr["area"]); ?></option>
                </select>
              </div>
        </div>
      </form>
    </div>
    <div class="col-md-8">
     <div class="input-group">
      <input type="text" class="form-control" placeholder="搜索城市">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">搜索</button>
      </span>
      </div><!-- /input-group --> 
    </div>
  </div>
  <hr />
  <div class="panel panel-default">
    <div class="panel-body">
      按首字母进行查找
    </div>
    <ul class="list-group addr-list">
      <li class="list-group-item my-addr-list">
        <span class="bg-primary my-zimu">烟台</span>
        <ul>
          <?php if(is_array($addr)): $i = 0; $__LIST__ = $addr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$addr): $mod = ($i % 2 );++$i;?><a data-aid="<?php echo ($addr["aid"]); ?>"><?php echo ($addr["area"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </li>
    </ul>
    
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
<!--footer-end-->
<script type="text/javascript">
  $(".addr-list a").click(function(){
    var aid = $(this).attr("data-aid");
    //ajax
    $.ajax({
      url:"<?php echo U('ChangeCity/ChangeCity');?>",
      data:{aid:aid},
      contentType:'text/json',
      success:function(data){
        alert(data.info);
        location.href="<?php echo U('ChangeCity/index');?>";
      }
    });
  });
  //下拉框选择地点
</script>
</body>
</html>