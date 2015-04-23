<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>分类查找|更快捷的兼职搜索</title>
    <link href="/Public/favicon.ico" type="image/x-icon" rel=icon />
<link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/jquery.min.js"></script>
<script src="/__GROUP__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/__GROUP__/js/common.js"></script>
    <style type="text/css">
        .my-label{
            margin:0 2px;
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
        <li class=""><a href="<?php echo U('SortSearch/index');?>">分类查找</a></li>
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
 if(session('?uid')){ echo $dropdown2; }elseif(session('?oid')){ echo $dropdown1; }else{ echo "<li><a href=" . U('Register/index') . ">注册</a></li>
        	  <li><a href=" . U('Login/index') . ">登录</a></li>"; } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--======导航条结束======--->
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">分类检索</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item clear-fix"><span class="my-title">类型：</span>
                                <ul class="list-options">
                            <?php if(is_array($molds)): $i = 0; $__LIST__ = $molds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$molds): $mod = ($i % 2 );++$i;?><!--
                                <label class="checkbox-inline my-label">
                                    <input type="checkbox" id="" name="intent" value="<?php echo ($molds["mid"]); ?>"><?php echo ($molds["name"]); ?>
                                </label>
-->
                                
                                <li><a href="<?php echo U('SortSearch/search');?>?"><?php echo ($molds["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </li>
                            <li class="list-group-item"><span class="my-title">工资：</span>
                                <ul class="list-options">
                                    <li class="my-options"><a href="<?php echo U('SortSearch/search');?>" class="">1-50</a></li>
                                    <li class="my-options"><a href="<?php echo U('SortSearch/search');?>">50-100</a></li>
                                    <li class="my-options"><a href="<?php echo U('SortSearch/search');?>">100-200</a></li>
                                    <li class="my-options"><a href="<?php echo U('SortSearch/search');?>">200以上</a></li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <span class="my-title">地点：</span>
                                <ul class="list-options">
         <?php if(is_array($address)): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$address): $mod = ($i % 2 );++$i;?><li class="my-options"><a href="<?php echo U('SortSearch/search');?>" class=""><?php echo ($address["area"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <span class="my-title">认证：</span>
                                <ul class="list-options">
                                    <li><a href="<?php echo U('SortSearch/search');?>">已认证</a></li>
                                    <li><a href="<?php echo U('SortSearch/search');?>">未认证</a></li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <span class="my-title">人数：</span>
                            <ul class="list-options">
                                <li><a href="<?php echo U('SortSearch/search');?>">1-2</a></li>
                                <li><a href="<?php echo U('SortSearch/search');?>">2-5</a></li>
                                <li><a href="<?php echo U('SortSearch/search');?>">5-10</a></li>
                                <li><a href="<?php echo U('SortSearch/search');?>">10-30</a></li>
                                <li><a href="<?php echo U('SortSearch/search');?>">30以上</a></li>
                            </ul>
                            </li>
                            <li class="list-group-item">
                                <span class="my-title">工作时长：</span>
                            <ul class="list-options">
                                <li><a href="<?php echo U('SortSearch/search');?>">1小时以下</a></li>
                                <li><a href="<?php echo U('SortSearch/search');?>">2-6小时</a></li>
                                <li><a href="<?php echo U('SortSearch/search');?>">一天以上</a></li>
                            </ul>
                            </li>
                            <li class="list-group-item">
                                <span class="my-title">工作时间段：</span>
                            <ul class="list-options">
                                <li><a href="<?php echo U('SortSearch/search');?>">6点-9点</a></li>
                                <li><a href="<?php echo U('SortSearch/search');?>">9点-12点</a></li>
                                <li><a href="<?php echo U('SortSearch/search');?>">12点-15点</a></li>
                                <li><a href="<?php echo U('SortSearch/search');?>">15点-18点</a></li>
                                <li><a href="<?php echo U('SortSearch/search');?>">18点-22点</a></li>
                                <li><a href="<?php echo U('SortSearch/search');?>">凌晨-6点</a></li>
                            </ul>
                            </li>
                        </ul>
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Library</a></li>
                            <li class="active">Data</li>
                        </ol>
                    </div>
                </div>
                <div class="panel panel-default">
                    <ul class="list-group">
                        <?php if(is_array($ss)): $i = 0; $__LIST__ = $ss;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ss): $mod = ($i % 2 );++$i;?><li class="list-group-item"></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <nav>
                        <ul class="pagination">
                        <?php echo ($page); ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-md-2">
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
    <script>
    </script>
</body>

</html>