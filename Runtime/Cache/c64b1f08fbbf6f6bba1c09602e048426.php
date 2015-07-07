<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo ($org_info["org_name"]); ?>-小蜜蜂job</title>
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/1.11.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
    <style type="text/css">
    .panel-body {
        position: relative;
    }
    
    .my-perinfo {
        margin-left: 26px;
    }
    
    .my-perinfo>p>span {
        margin-right: 18px;
    }
    
    .my-perinfo>h3>span {
        font-size: 16px;
    }
    
    .my-perimg {
        border: 1px solid #EEE;
    }
    
    .org-name {
        line-height: 66px;
        overflow: hidden;
    }
    .h-reset{
      font-size:14px;
      margin:0;
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
      <a class="" href="/"><img src="/Public/logo/logo.jpg" height="50" alt="小蜜蜂兼职logo" /></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="<?php echo U('ChangeCity/index');?>">切换城市 [<?php echo session("?city") ? session("city") : "烟台市" ?>]</a></li>
      </ul>

      <form class="navbar-form navbar-left" role="search" method="get" action="<?php echo U('Search/s');?>">
        <div class="input-group">
          <div class="input-group-btn">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span>兼职</span><span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu" id="search-f">
            <li><a href="javascript:void(0)">用户</a></li>
          </ul>
        </div>
          <input class="hidden" type="test" name="sf" value="job" id="hidden-f"/>
          <input type="text" class="form-control" name="wd" placeholder="兼职/用户...">
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
 if(session('?uid')){ echo $dropdown2; }elseif(session('?oid')){ echo $dropdown1; }else{ echo "<li><a href=" . U('Register/index') . ">注册</a></li>
        	  <li><a href=" . U('Login/index') . ">登录</a></li>"; } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<script type="text/javascript">
  (function(){
    var sf_a   = $("#search-f>li a");
    var sf_h   = $("#hidden-f");
    var sf_a_b = $("#search-f").parent().find("button>span").eq(0);
    var p;
    sf_a.on('click',function(){
      //切换字符串
      p = sf_a_b.text();
      sf_a_b.text(sf_a.text());
      sf_a.text(p);
      //改变表单数据
      if(sf_h.val() == 'job'){
        sf_h.val("user");
      }else if(sf_h.val() == 'user'){
        sf_h.val("job");
      }
    });
  })();
</script>
<!--======导航条结束======--->
    <!--container-->
    <div class="container">
        <div class="row">
            <!--left-->
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="<?php echo ($org_info["avatar"]); ?>" class="pull-left my-perimg" />
                        <div class="pull-left my-perinfo">
                            <h1 class="h3 org-name"><?php echo ($org_info["orgname"]); ?>
            <?php if($org_info["is_validate"] == 1): ?><span class="label label-success">已认证</span>
            <?php else: ?>
            <span class="label label-danger">未认证</span><?php endif; ?>
            </h1>
                        </div>
                    </div>
                </div>`
                <div class="panel panel-default">
                    <div class="panel-heading"><h2 class="h-reset">公司信息</h2></div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <td class="table-field">公司资质：</td>
                                <td>
                                    <?php if($org_info["is_validate"] == 1): ?>已验证
                                        <?php else: ?>未验证<?php endif; ?>
                                </td>
                                <td class="table-field">性质：</td>
                                <td><?php echo ($org_info["nature"]); ?></td>
                            </tr>
                            <tr>
                                <td>行业：</td>
                                <td><?php echo ($org_info["name"]); ?></td>
                                <td>规模：</td>
                                <td><?php echo ($org_info["size"]); ?>人</td>
                            </tr>
                            <tr>
                                <td class="table-field">邮箱：</td>
                                <td><?php echo ($org_info["email"]); ?></td>
                                <td>客服电话：</td>
                                <td><?php echo ($org_info["phone"]); ?></td>
                            </tr>
                            </tr>
                            <td class="table-field">公司网址：</td>
                            <td><?php echo ($org_info["website"]); ?></td>
                            <td class="table-field">公司地址：</td>
                            <td><?php echo ($org_info["org_address"]); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="h-reset">最新兼职</h2></div>
                  <div class="panel-body">
                    <ul class="list-group">
                        <?php if($job_error_info): ?><li class="list-group-item"><?php echo ($job_error_info); ?></li>
                            <?php else: ?>
                            <?php if(is_array($job_info)): $i = 0; $__LIST__ = $job_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$job_info): $mod = ($i % 2 );++$i;?><a class="list-group-item" href="<?php echo U("JobsInfo/index");?>?jid=<?php echo ($job_info["jid"]); ?>"><?php echo ($job_info["title"]); ?> <span class="badge"><?php echo (ftime($job_info["ctime"])); ?></span></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </ul>
                  </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="h-reset">公司介绍</h2>
                    </div>
                    <div class="panel-body"><?php echo ($org_info["org_intro"]); ?></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="h-reset">评价</h2>
                    </div>
                    <div class="panel-body">
                    <table class="table">
                        <thead>
                            <td>发布人</td>
                            <td>内容</td>
                            <td>时间</td>
                        </thead>
                        <?php if($eval_error_info): ?><tr>
                                <td><?php echo ($eval_error_info); ?></td>
                            </tr>
                            <?php else: ?>
                            <?php if(is_array($eval_info)): $i = 0; $__LIST__ = $eval_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($info["username"]); ?></td>
                                    <td><?php echo ($info["content"]); ?></td>
                                    <td><?php echo (date('y/m/d',$info["ctime"])); ?></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </table>
                    </div>
                </div>
            </div>
            <!--right-->
            <div class="col-md-4">
                <div class="panel panel-default">
    <div class="panel-heading">梦海网络</div>
	<div class="panel-body">
		<img src="/__GROUP__/images/erweima.png" width="190" style="width:190px" class="img-thumbnail center-block" />
	</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">平台介绍</div>
	<div class="panel-body">
		<pre>&emsp;&emsp;小蜜蜂job烟台梦海网络打造的一款大学生生活服务平台，我们通过考察企业，附近兼职，互相评论，星级评价四大环节，为大学生校园工作保驾护航，打造安全靠谱的大学生生活服务平台。</pre>
	</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">公司介绍</div>
	<div class="panel-body">
		<pre>&emsp;&emsp;烟台梦海网络是由烟台大学生创办的新一代互联网公司，我们来自烟台各大高校，全部由90后组成，致力于打造全国大学生生活服务第一平台，我们会用饱满热情的态度服务广大大学生</pre>
	</div>
</div>
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