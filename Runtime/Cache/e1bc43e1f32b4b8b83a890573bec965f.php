<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>兼职平台</title>
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/1.11.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
    <style type="text/css">
    .scroll-content {
        position: relative;
    }
    .panel-body {
        position: relative;
    }
    .list-group a.list-group-item {
        cursor: pointer;
    }
    .btn-content {
        position: absolute;
        right: 10px;
        margin-top: -8px;
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
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="输入关键词">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php if(session('?admin_id')): ?><!--dropdown-->
                    <li class="dropdown">
                        <a href="<?php echo U('Admin/index');?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo session('username');?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo U("Admin/index");?>">管理中心</a></li>
                            <li><a href="#">修改密码</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo U('Admin/logout');?>">注销</a></li>
                        </ul>
                    </li>
                    <!--/.dropdown-->
                    <?php else: ?>
                    <li><a href="<?php echo U('Register/index');?>">注册</a></li>
                    <li><a href="<?php echo U('Login/index');?>">登录</a></li><?php endif; ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<!--======导航条结束======--->

    <!--container-->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                				    <ul class="list-group nav">
                        <a class="list-group-item" href="__URL__/index.html">数据统计</a>
                        <a class="list-group-item" href="__URL__/publishApply.html">兼职申请列表</a>
                        <a class="list-group-item" href="__URL__/authApply.html">认证申请列表</a>
                        <a class="list-group-item" href="__URL__/orgsList.html">现有公司列表</a>
                        <a class="list-group-item" href="__URL__/showNowCity.html">管理业务城市</a>
                        <a class="list-group-item" href="__URL__/showMolds.html">管理兼职类型</a>
                        <a class="list-group-item" href="__URL__/showAdvice.html">投诉建议</a>
                    </ul>
                </ul>
            </div>
            <div class="col-md-9">
            <div class="panel panel-primary">
                    <div class="panel-heading" id="publish-apply">兼职申请列表</div>
                    <ul class="list-group">
                    <?php if(is_null($jobs_error)): if(is_array($jobs_list)): $i = 0; $__LIST__ = $jobs_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class="list-group-item"><a href="<?php echo U('JobsInfo/index');?>?jid=<?php echo ($list["jid"]); ?>"><?php echo ($list["title"]); ?></a><span class="btn-content" data-jid="<?php echo ($list["jid"]); ?>"><button type="button" class="btn btn-success" data-pass="yes">通过</button><button type="button" class="btn btn-danger" data-pass="no">拒绝</button></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            <?php else: ?>
                            <li class="list-group-item"><?php echo ($jobs_error); ?></li><?php endif; ?>
                    </ul>
                    <ul class="pagination"><?php echo ($jobs_page); ?></ul>
                </div>
            </div>
        </div>
    <!--./container-->
    <!--footer-->
<div class="container">
  <hr />
  <p class="text-center">梦海网络</p>
  <p class="my-info text-center"><a href="http://www.xiaomifengjob.com">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="http://www.xiaomifengjob.com">关于梦海网络</a>/<a href="http://www.xiaomifengjob.com">联系我们</a></p>
  <p class="copyright text-center">Copyright © 梦海网络 / 备案号：/ 地址：烟台市红旗中路</p>
  <p class="hidden"><script src="http://s11.cnzz.com/z_stat.php?id=1255390287&web_id=1255390287" language="JavaScript"></script></p>
</div>
    <!--./footer-->
</body>
</html>