<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>登录</title>
    <link href="/Public/favicon.ico" type="image/x-icon" rel=icon />
<link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/jquery.min.js"></script>
<script src="/__GROUP__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/__GROUP__/js/common.js"></script>
    <style type="text/css">
    .red {
        color: #F00;
    }
    
    .panel-body {
        position: relative;
    }
    
    #verify>input {
        display: inline;
        width: 216px;
    }
    
    .alert-sm {
        padding: 10px;
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
        <li class=""><a href="<?php echo U('SortSearch/search');?>">分类查找</a></li>
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
 if(session('?uid')){ echo $dropdown2; }elseif(session('?oid')){ echo $dropdown1; }else{ echo "<li><a href=" . U('Register/sendMail') . ">注册</a></li>
        	  <li><a href=" . U('Login/index') . ">登录</a></li>"; } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--======导航条结束======--->
    <div class="container">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">登录</div>
                    <div class="panel-body">
                        <form id="login-form">
                          <div class="alert alert-success alert-sm hidden" role="alert">
                              <button type="button" class="close" aria-hidden="true">&times;</button>
                              <p></p>
                          </div>
                            <div class="form-group">
                                <input type="text" id="email" name="email" class="form-control" placeholder="登录邮箱" />
                            </div>
                            <div class="form-group">
                                <input type="password" id="passwd" class="form-control" placeholder="密码" />
                            </div>
                            <div class="form-group" id="verify">
                                <img src="<?php echo U('Login/vCode');?>" class="verify" />
                                <input type="text" class="form-control" placeholder="验证码" />
                                <button class="btn btn-default verify" type="button">刷新</button>
                            </div>
                            <!--       <div class="checkbox">
        <label>
          <input type="checkbox" id="pwdmem" value="1">三天内免登录
        </label>
      </div> -->
                            <div class="form-group">
                                <button type="button" class="btn btn-default pull-right" id="login">登录</button>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">xiaomifengjob.com</div>
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
    <script>
    (function() {
        $(".alert button").on('click', function() {
            $(this).parent().addClass("hidden");
        });
    })();
    //按钮点击时触发ajax
    $("#login").click(function() {
        //获取字段值
        var email = $("#email").val();
        var passwd = $("#passwd").val();
        var ver_val = $("#verify>input").val();
        //checkbox判断
        var pwdmem = $("#pwdmem").is(":checked");
        pwdmem = pwdmem ? 1 : 0;
        //检测字段是否为空
        if (email == "") {
            $("#email").focus();
            $(".alert>p").text("您忘记填写邮箱啦"); $(".alert").removeClass("alert-success").addClass("alert-danger"); $(".alert").removeClass("hidden");

            return;
        }
        if (passwd == "") {
            $("#passwd").focus();
            $(".alert>p").text("您忘记填写密码啦"); $(".alert").removeClass("alert-success").addClass("alert-danger"); $(".alert").removeClass("hidden");
            return;
        }
        //AJAX
        $.post(
            "<?php echo U('Login/login');?>",
            {
                email: email,
                passwd: passwd,
                pwdmem: pwdmem,
                verify: ver_val
            },
            function(data) {
              var org = "<?php echo U("OrgCenter/index");?>",user = "<?php echo U("UserCenter/index");?>";
              if(data.data == 0){
                $(".alert").removeClass("alert-danger").addClass("alert-success");
                if(data.status == 0){
                  setTimeout(function(){location.href = user},1000);
                }else if(data.status == 1){
                  setTimeout(function(){location.href = org},1000);
                }
              }else{
                setTimeout(function() {
                            $("#verify>img").click()
                        }, 500);
                $(".alert").removeClass("alert-success").addClass("alert-danger");
              }
              $(".alert>p").text(data.info);
              $(".alert").removeClass("hidden");
            }
        );
    });
enterKey($("#verify input"),$("#login"));
    </script>
</body>

</html>