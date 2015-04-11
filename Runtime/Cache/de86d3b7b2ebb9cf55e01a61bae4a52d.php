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
    <script src="./__GROUP__/js/common.js"></script>
    <style type="text/css">
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
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        <form class="form-horizontal" action="">
                            <label>旧密码：</label>
                            <input class="form-control" name="old_passwd" />
                            <label>新密码：</label>
                            <input class="form-control" type="password" name="new_passwd" />
                            <label>再输一遍新密码：</label>
                            <input class="form-control" type="password" name="re_passwd" />
                            <label>输入验证码：</label>
                            <div class="" id="verify">
                                <img src="<?php echo U('ChangePasswd/vCode');?>" />
                                <button class="btn btn-primary" type="button">换一个</button>
                            </div>
                            <input class="form-control" name="vcode" />
                            <button type="button" class="btn btn-primary" id="goto-submit">修改密码</button>
                        </form>
                    </div>
                    <div class="col-md-4"></div>
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
    //刷新验证码
    $("#verify>button").click(function() {
        var ver_img = $("#verify>img");
        ver_img.attr("src", "__APP__/Login/vCode?" + new Date().getTime());
    });
    $("#verify>img").click(function() {
        $(this).attr("src", "__APP__/Login/vCode?" + new Date().getTime());
    });


    $("#goto-submit").on('click', function() {
        var info = getFromInput(".form-horizontal");
        console.log(info);
        $.ajax({
            url: "<?php echo U('ChangePasswd/change');?>",
            data: info,
            type: "POST",
            success: function(data) {
                alert(data.info);
            }
        });
    });
    </script>
</body>

</html>