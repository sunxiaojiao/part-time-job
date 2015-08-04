<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>登录-梦海网络</title>
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
        
    #verify>input {
        display: inline;
        width: 216px;
    }
    
    .alert-sm {
        padding: 10px;
    }
    .bg-img{
        background: #cfdee3 url('/Public/bg_img.jpg') repeat-x;
        padding:10px 0 10px;
        margin-top:-20px;
    }
    .login{
        box-shadow:6px 6px 2px rgba(1,1,1,.3);
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
    <div class="bg-img">
    <div class="container">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
            
              <div class="panel panel-default login">
                    <div class="panel-heading">登录</div>
                    <div role="tabpanel">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active user"><a href="#login-content" role="tab" data-toggle="tab">求职者</a></li>
                <li role="presentation" class="org"><a href="#login-content" role="tab" data-toggle="tab">公司机构</a></li>
              </ul>
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="login-content">
                    <div class="panel-body">
                        <form id="login-form">
                            <div class="alert alert-success alert-dismissable hidden" id="alert-success">
                                <button type="button" class="close" aria-hidden="true">&times;</button><p>发送成功</p></div>
                            <div class="form-group">
                                <label>手机号：</label>
                                <input type="text" name="phone" class="form-control" placeholder="手机号" />
                            </div>
                            <div class="form-group">
                                <label>密码：</label>
                                <input type="password" name="passwd" class="form-control" placeholder="密码" />
                                <input type="text" class="hidden" name="login_type" value="user" />
                            </div>
                            <div class="form-group" id="verify">
                                <img src="<?php echo U('Login/vCode');?>" class="verify" />
                                <input type="text" class="form-control" name="verify" placeholder="验证码" />
                                <button class="btn btn-default verify" type="button">刷新</button>
                            </div>
                            <div class="checkbox">
                                <label>
                                  <input type="checkbox" id="pwdmem">三天内免登录
                                </label>
                                <button type="button" class="btn btn-default pull-right" id="login">登录</button>
                            </div>
                        </form>
                    </div>
                </div>
              </div>

            </div>
                    <div class="panel-footer">xiaomifengjob.com <a class="pull-right" href="<?php echo U("PasswdFind/index");?>">忘记密码？</a></div>
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
  <p class="copyright text-center">Copyright © 梦海网络 / 备案号：<a style="color:#000;" href="http://www.miitbeian.gov.cn/">鲁ICP备15023958号</a>/ 地址：烟台市红旗中路</p>
  <p class="hidden"><script src="http://s11.cnzz.com/z_stat.php?id=1255390287&web_id=1255390287" language="JavaScript"></script></p>
</div>
    <!--./footer-->
    <script>
    (function() {
        $(".alert button").on('click', function() {
            $(this).parent().addClass("hidden");
        });
    })();
    //切换登录类型
    $(".user,.org").on('click',function(){
        if($(this).hasClass('user')){
            $("input[name='login_type']").val('user');
        }else if($(this).hasClass('org')){
            $("input[name='login_type']").val('org');
        }
    });
    //按钮点击时触发ajax
    $("#login").click(function() {
        //获取字段值
        var info = getFromInput('#login-form');
        //checkbox判断
        var pwdmem = $("#pwdmem").is(":checked");
        info.pwdmem = pwdmem ? 1 : 0;
        //检测字段是否为空
        if (info.phone == "") {
            $("input[name='phone']").focus();
            $(".alert>p").text("您忘记填写手机号啦"); $(".alert").removeClass("alert-success").addClass("alert-danger"); $(".alert").removeClass("hidden");

            return;
        }
        if (info.passwd == "") {
            $("input[name='passwd']").focus();
            $(".alert>p").text("您忘记填写密码啦"); $(".alert").removeClass("alert-success").addClass("alert-danger"); $(".alert").removeClass("hidden");
            return;
        }
        if(info.verify == ''){
            $("input[name='verify']").focus();
            $(".alert>p").text("您忘记填写验证码啦"); $(".alert").removeClass("alert-success").addClass("alert-danger"); $(".alert").removeClass("hidden");
            return;
        }
        //AJAX
        $.post(
            "<?php echo U('Login/login');?>",
            info,
            function(data) {
              var org = "<?php echo U("OrgCenter/index");?>",user = "<?php echo U("UserCenter/index");?>";
              if(data.data == 1){
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
//记住密码

    </script>
</body>

</html>