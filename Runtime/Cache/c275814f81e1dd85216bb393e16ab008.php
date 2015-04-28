<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>注册</title>
    <link rel="stylesheet" href="./__GROUP__/css/validationEngine.jquery.css" type="text/css" />
    <link href="/Public/favicon.ico" type="image/x-icon" rel=icon />
<link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/jquery.min.js"></script>
<script src="/__GROUP__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/__GROUP__/js/common.js"></script>
    <style type="text/css">
    #email-goto {
        top: 13px;
    }
    
    #email {
        border-radius: 4px;
    }
    
    #select-list a {
        cursor: pointer;
    }
    
    .red {
        color: #F00;
    }
    
    .my-warning {
        float: left;
    }
    
    #verify>img,
    #verify>button {}
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
    <!--container-->
    <div class="container">
        <div class="page-header">
            <h1>注册<small>小蜜蜂兼职</small></h1>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="alert alert-success hidden" role="alert">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <p>注册成功,等待跳转...</p>
                </div>
                <ul class="nav nav-pills" id="select-list">
                    <li role="presentation" class="active"><a>求职者</a></li>
                    <li role="presentation"><a>公司或机构组织</a></li>
                    <li role="presentation"><a>学校</a></li>
                </ul>
                <form method="post" action="<?php echo U('Register/reg');?>" id="reg-form">
                    <div class="form-group input-group">
                        <label for="email">邮箱：</label>
                        <input id="email" type="text" name="email" class="form-control" disabled="true" placeholder="" value="<?php echo ($email); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="passwd">密码：</label>
                        <input id="passwd" type="password" name="passwd" class="form-control validate[required] text-input" data-prompt-position="topRight:-70" placeholder="请输入密码" />
                    </div>
                    <div class="form-group">
                        <label for="passwd">确认密码：</label>
                        <input id="repasswd" type="password" name="repasswd" class="form-control validate[required,equals[passwd]] text-input" data-prompt-position="topRight:-70" placeholder="再次输入密码" />
                    </div>
                    <div class="form-group" id="verify">
                        <div class="rows">
                            <div class="col-md-8" style="padding-left:0">
                                <input class="form-control" type="text" name="vcode" placeholder="验证码" />
                            </div>
                            <div class="col-md-4">
                                <img src="<?php echo U("Register/vCode");?>" class="verify" />
                                <button type="button" class="btn btn-default verify">刷新</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-default" id="reg-goto">提交</button>
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
        function tabShow(arg) {
            for (var i = 0; i < 3; i++) {
                $("#select-list>li").eq(i).removeClass("active");
            }

            $("#select-list>li").eq(arg).addClass("active");
            whatToSelect = arg;
        }


        function tabChange(arg) {
                var str = new String('<div class="form-group input-org"><label for="org">组织名称：</label><input id="org" type="text" name="org" class="form-control" placeholder="组织机构学校名称" /></div><div class="form-group input-org"><label for="org_address">所在地：</label><input id="org_address" type="text" name="org_address" class="form-control" placeholder="组织机构学校所在地" /></div>');
                if (arg == 0) {
                    console.log(0)
                    if ($(".input-org")) {
                        $(".input-org").remove();
                    }
                } else {
                    if ($(".input-org").length != 0) {} else {
                        $("#reg-goto").before(str);
                    }
                }
            }
            //绑定事件
        $("#select-list>li").eq(0).click(function() {
            tabShow(0);
            tabChange(0);
        });
        $("#select-list>li").eq(1).click(function() {
            tabShow(1);
            tabChange(1);
        });
        $("#select-list>li").eq(2).click(function() {
            tabShow(2);
            tabChange(2);
        });
        (function(){
        	$(".alert button").on('click',function(){
        		$(this).parent().addClass("hidden");
        	});
        })();
        //Ajax	
        $("#reg-goto").click(function() {
            //获取数据
            var info = getFromInput("#reg-form");
            //验证两次密码
            if (info.passwd === '') {
                $(".alert>p").text("您忘记填写密码啦");
                $(".alert").removeClass("alert-success").addClass("alert-danger");
                $(".alert").removeClass("hidden");
                return;
            }
            if (info.passwd != info.repasswd) {
                $(".alert").removeClass("alert-success").addClass("alert-danger");
                $(".alert>p").text("两次密码不一致");
                $(".alert").removeClass("hidden");
                return;
            }
            if(info.org === ''){
            	$(".alert>p").text("企业用户须填写企业名称");
                $(".alert").removeClass("alert-success").addClass("alert-danger");
                $(".alert").removeClass("hidden");
                return;
            }
            if(info.org_address === ''){
            	$(".alert>p").text("企业用户须填写企业所在地");
                $(".alert").removeClass("alert-success").addClass("alert-danger");
                $(".alert").removeClass("hidden");
                return;
            }
            //ajax传输
            $.post(
                "<?php echo U('Register/reg');?>",
                info,
                function(data) {
                	$(".alert").removeClass("alert-danger").addClass("alert-success");
                    $(".alert>p").text(data.info);
                    if (data.data == 0) {
                        setTimeout(function() {
                            location.href = '<?php echo U("Login/index");?>';
                        }, 3000);

                    } else {
                    	$(".alert").removeClass("alert-success").addClass("alert-danger");
                        setTimeout(function() {
                            $("#verify>img").click()
                        }, 500);
                    }

                    $(".alert").removeClass("hidden");

                }
            );
        });
        //表单验证
        </script>
</body>