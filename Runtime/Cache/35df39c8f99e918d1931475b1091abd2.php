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
<script type="text/javascript" src="./__GROUP__/js/common.js"></script>
<script type="text/javascript" src="./__GROUP__/js/fullAvatarEditor.js"></script>
<script type="text/javascript" src="./__GROUP__/js/swfobject.js"></script>
<style type="text/css">
  .panel-body{position: relative;}
  .my-perinfo{margin-left:26px;}
  .my-perinfo>p>span{margin-right:18px;}
  .my-perimg{border:1px solid #EEE;}
  .my-select-address{}
  .my-select-address>select{width:auto;display: inline-block;}
  .my-personimg{width:200px; cursor: pointer;}
  #swfwrapper{width:630px;}
	.d-markup{display: inline-block; padding:4px 6px; background: #EEE; font:18px/24px "微软雅黑,黑体"; margin: 6px 2px;}
	.d-markup:hover{background: #DDD; color:#111;}
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
        <li class=""><a href="<?php echo U('ChangeCity/index');?>">切换城市 [<?php echo session("?city") ? session("city") : "烟台" ?><strong>·</strong><?php echo session("?area") ? session("area") : "芝罘区" ?>]</a></li>
      </ul>

      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="输入关键词">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form>

      <ul class="nav navbar-nav navbar-right">
      <?php $url = U("Index/index"); $logoutUrl = U("Logout/index"); $name = session("?username") ? session('username') : session('orgname'); $info = session("?uid") ? '<li><a href="index.php?m=UserCenter">个人中心</a></li>' : '<li><a href="index.php?m=OrgCenter">个人中心</a></li>'; $dropdown = <<<THINK
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
<div class="container">
  <div class="page-header">
      <h1><small>完善机构组织信息</small></h1>
  </div>
  <div class="row">
    <div class="col-md-8">
		<!--基本信息-->
		<div class="panel panel-default">
			<div class="panel-heading">
				基本信息<a class="pull-right" href="<?php echo U('OrgCenter/editInfo');?>">更改信息</a>
			</div>
			<?php if(is_array($orgInfo)): $i = 0; $__LIST__ = $orgInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$orginfo): $mod = ($i % 2 );++$i; if($key != 'headlogo'): ?><span class="d-markup"><?php echo ($orginfo); ?></span><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<!--./基本信息-->
		<!--发布的兼职列表-->
		<div class="panel panel-default">
			<div class="panel-heading">发布的兼职</div>
			<div class="list-group">
			<?php if(is_array($publicedJobs)): $i = 0; $__LIST__ = $publicedJobs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><a href="<?php echo U("JobsInfo/index");?>&jid=<?php echo ($jobs["jid"]); ?>" target="_blank" class="list-group-item"><?php echo ($jobs["title"]); ?><span class="badge"><?php echo ($jobs["current_peo"]); ?>/<?php echo ($jobs["want_peo"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<!--./发布的兼职列表-->

    </div>
    <div class="col-md-4">
    	<div class="panel panel-default">
        <div class="panel-body">
          <img src="<?php echo ($orgInfo["headlogo"]); ?>" class="img-thumbnail center-block my-personimg" data-toggle="modal" data-target="#headimg" />
        </div>
      </div>
    </div>
  </div>	
 <!--./container-->
 <!--上传头像用model框-->
<div class="modal fade" id="headimg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">修改头像</h4>
      </div>
      <div class="modal-body">
        <div class="center-block" id="swfwrapper">
                <p id="swfContainer">
                    本组件需要安装Flash Player后才可使用，请从
                    <a href="http://www.adobe.com/go/getflashplayer">这里</a>
                    下载安装。
                </p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--footer-->
<div class="container">
  <hr />
  <p class="text-center">小蜜蜂兼职</p>
  <p class="my-info text-center"><a href="#">首页</a>/<a href="#">申请入住</a>/<a href="#">关于小蜜蜂</a>/<a href="#">联系我们</a></p>
  <p class="copyright text-center">Copyright ©小蜜蜂网络 / 备案号：ICP备13008243号-1 / 地址：烟台市红旗中路</p>
</div>
<!--./footer-->
<script type="text/javascript">
            swfobject.addDomLoadEvent(function () {
                var swf = new fullAvatarEditor("./swf/fullAvatarEditor.swf", "./swf/expressInstall.swf", "swfContainer", {
                        id : "swf",
                        upload_url : "/upload.php?userid=999&username=looselive",
                        method : "post",
                        src_url : "./images/person.jpg",
                        src_upload : 2
                    },function(){

                    }
                );
                document.getElementById("upload").onclick=function(){
                    swf.call("upload");
                };
            });
        </script>
</body>
</html>