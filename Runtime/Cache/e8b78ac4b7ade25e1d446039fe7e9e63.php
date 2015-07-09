<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>小蜜蜂job梦海网络</title>
    <meta type="keywords" content="小蜜蜂job,小蜜蜂,大学生兼职神器,大学生兼职,鲁东大学,找兼职,大学生创业" />
    <meta type="descripton" content="小蜜蜂job是大学生自主创业项目，为在校大学生提供优质可靠的兼职">
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/1.11.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
    <style type="text/css">
    #banner{
        width:778px;
        margin-bottom:16px;
        margin-left:-14px;
    }
    #banner .right {
        right:14px;
    }
    #banner .carousel-control{
        left:auto;
    }
    .assort {
        overflow: hidden;
    }
    
    .assort>li>a {
        display: inline-block;
    }
    .list-grid{
        float:left;
        margin-left: 16%;
        display: block;
    }
    .list-grid-left{
        float:left;
        display: block;
    }
    .list-grid-right{
        float:right;
        display: block;
    }
    .carousel-inner>.item>img{
        margin:0 auto;
    }
    @media screen and (max-width: 600px){
        .list-grid{
            margin-left:6%;
        }
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
    <!--banner-->
    
    <!--./banner-->
    <div class="container">
        <div class="row">
            <div class="col-md-8" style="overflow:hidden;">
                <div id="banner" class="carousel slide container" style="overflow:hidden;" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#banner" data-slide-to="0" class="active"></li>
                <li data-target="#banner" data-slide-to="1"></li>
                <li data-target="#banner" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="/__GROUP__/images/1.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="/__GROUP__/images/1.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="/__GROUP__/images/1.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#banner" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#banner" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
                <div class="panel panel-default">
                    <div class="panel-heading">兼职</div>
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#newest">最近兼职工作</a></li>
                            <!-- <li role="presentation"><a href="#assort" aria-controls="assort" role="tab" data-toggle="tab">分类查找</a></li> -->
                            <li role="presentation"><a href="<?php echo U("Resume/index");?>">求职简历</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="newest">
                                <!--分类选择-->
                                <table class="table">
                                    <thead>
                                            <td></td>
                                            <td>
                                        <a href="index.php?sort=<?php echo ($arr_sort["address"]); ?>">地点<span class="glyphicon glyphicon-chevron-down"></span></a></td>
                                            <td><a href="index.php?sort=<?php echo ($arr_sort["money"]); ?>">工资<span class="glyphicon glyphicon-chevron-down"></span></a></td>
                                            <td><a href="index.php?sort=<?php echo ($arr_sort["pv"]); ?>">浏览量<span class="glyphicon glyphicon-chevron-down"></span></a></td>
                                            <td><a href="index.php?sort=<?php echo ($arr_sort["ctime"]); ?>">时间<span class="glyphicon glyphicon-chevron-down"></span></a></td>
                                    </thead>
                                <!--/分类选择-->
                                <!-- 兼职列表 -->
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$job): $mod = ($i % 2 );++$i;?><tr>
                                        <td><a href="<?php echo U('JobsInfo/index');?>?jid=<?php echo ($job["jid"]); ?>"><?php echo ($job["title"]); ?>
                            
                            <?php if(time()-$job['ctime'] <= 3600): ?><span class="label label-danger">New</span><?php endif; ?></a></td>
                                        <td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><?php echo ($job["addressname"]); ?></td>
                                        <td><span class="glyphicon glyphicon-yen" aria-hidden="true"></span><?php echo ($job["money"]); ?>元
                                        <?php switch($job["money_style"]): case "1": ?>/小时<?php break;?>
                                            <?php case "2": ?>/天<?php break;?>
                                            <?php case "3": ?>/次<?php break; endswitch;?>
                                        </td>
                                        <td><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><?php echo ($job["pv"]); ?></td>
                                        <td><span class="glyphicon glyphicon-time"></span><?php echo (ftime($job["ctime"])); ?></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                <!--./兼职列表-->
                                </table>
                            </div>
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
    <!--end container-->
    <!--footer-->
<div class="container">
  <hr />
  <p class="text-center">梦海网络</p>
  <p class="my-info text-center"><a href="http://www.xiaomifengjob.com">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="http://www.xiaomifengjob.com">关于梦海网络</a>/<a href="http://www.xiaomifengjob.com">联系我们</a></p>
  <p class="copyright text-center">Copyright © 梦海网络 / 备案号：<a style="color:#000;" href="http://www.miitbeian.gov.cn/">鲁ICP备15023958号</a>/ 地址：烟台市红旗中路</p>
  <p class="hidden"><script src="http://s11.cnzz.com/z_stat.php?id=1255390287&web_id=1255390287" language="JavaScript"></script></p>
</div>
    <!--footer-end-->
    <script>
    $(".assort a").on('click', function() {
        link = $(this).attr('href');
        
    });
    $(document).on('ready', function() {
        var list = $(".assort .glyphicon").parent();
        console.log(list);
        for (var i = 0; i < list.length; i++) {
            var thehref = list.eq(i).attr('href');
            var thelast = thehref.substr(thehref.length - 1, 2);
            var unexpect_last = thehref.substr(0, thehref.length - 1);
            if (thehref.substr(list.eq(i).attr('href').length - 1, 1) == 1) {
                $(".assort .glyphicon").eq(i).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            } else {
                $(".assort .glyphicon").eq(i).removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            }
        }
    });
    </script>
</body>

</html>