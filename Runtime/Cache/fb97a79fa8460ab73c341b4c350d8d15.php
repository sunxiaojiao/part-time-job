<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>绑定邮箱</title>
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
    <style type="text/css">
    form {
        margin-top: 50px;
    }
    </style>
    <script>
    </script>
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
      <a class="" href="/"><img src="/Public/logo/logo.png" height="50" alt="小蜜蜂兼职logo" /></a>
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
        <div class="page-header">
            <h1>绑定邮箱<small>小蜜蜂兼职</small></h1>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="alert alert-success alert-dismissable hidden" id="alert-success">
                    <button type="button" class="close" aria-hidden="true">&times;</button><p>发送成功</p></div>
                <div class="alert alert-danger alert-dismissable hidden" id="alert-failed">
                    <button type="button" class="close" aria-hidden="true">&times;</button><p>发送失败</p></div>
                <form id="reg-form" class="form-inline">
                    <div class="form-group input-group">
                        <label for="email" class="sr-only">邮箱：</label>
                        <input id="email" type="text" name="email" class="form-control text-input" placeholder="请输入邮箱" />
                        <input class="hidden" />
                    </div>
                    <button type="button" class="btn btn-primary" id="email-goto" data-loading-text="发送中..." autocomplete="off">发送</button>
                </form>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">关于小蜜蜂</div>
                    <div class="panel-body">
                        <img src="/__GROUP__/images/erweima.png" class="img-thumbnail center-block" />
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
        <!--end footer-->
        <script type="text/javascript">
        (function(){
        	$(".alert button").on('click',function(){
        		$(this).parent().addClass("hidden");
        	});
        })();
        enterKey($("#reg-form input"),$("#email-goto"));
        $("#email-goto").click(function() {
            var btn = $("#email-goto");
            var email = $("#email").val();
            console.log(email);
            //验证邮箱格式
            var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var flag = re.exec(email);
            //var flag = 1;
            console.log(flag);
            if (!flag) {
            	$("#alert-failed>p").text("请填写正确的邮箱格式");
                $("#alert-success").addClass("hidden");
                $("#alert-failed").removeClass("hidden");
                return;
            }
            var btnLoading = $(this).button('loading');
            console.log(email);
            $.ajax({
                url: "<?php echo U('AttachEmail/sendEmailHandler');?>",
                data: {
                    'email': email
                },
                type: "POST",
                success: function(data) {
                    if (data.data == 1) {
                        $("#alert-failed").addClass("hidden");
                        $("#alert-success").removeClass("hidden");
                        btn.text("发送成功");
                    } else {
                        $("#alert-success").addClass("hidden");
                        $("#alert-failed").removeClass("hidden");
                        $("#alert-failed p").text(data.info);
                        btn.button('reset');
                    }
                },
                error: function() {
                    $("#alert-success").addClass("hidden");
                    $("#alert-failed").removeClass("hidden");
                    btn.button('reset');
                }
            });
        });
        </script>
</body>