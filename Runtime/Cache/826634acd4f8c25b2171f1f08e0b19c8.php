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

<style type="text/css">
  .red{color:#F00;}
  .panel-body{position: relative;}
  #login{position: absolute; right:16px; bottom: 16px;}
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
      <a class="navbar-brand" href="#">小蜜蜂兼职</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="#">切换城市 [烟台]</a></li>
      </ul>

      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="输入关键词">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">注册</a></li>
        <li><a href="">登录</a></li>
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li> --><!--/.dropdown-->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--======导航条结束======-->
<div class="container">
<div class="row">
<div class="col-md-8"></div>
<div class="col-md-4">
  <div class="panel panel-default">
  <div class="panel-heading">登录</div>
  <div class="panel-body">
    <form id="login-form">
      <div class="form-group">
        <input type="type" id="email" class="form-control" placeholder="登录邮箱" />
      </div>
      <div class="form-group">
        <input type="password" id="passwd" class="form-control" placeholder="密码" />
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" id="pwdmem" value="1">记住密码
        </label>
        <span class="red warninfo"></span>
      </div>
      <button type="button" class="btn btn-default" id="login">登录</button>
    </form>
  </div>
  <div class="panel-footer">xiaomifengjob.com</div>
  </div>
</div>
</div>
</div><!--./container-->
<!--footer-->
<div class="container">
  <hr />
  <p class="text-center">小蜜蜂兼职</p>
  <p class="my-info text-center"><a href="#">首页</a>/<a href="#">申请入住</a>/<a href="#">关于小蜜蜂</a>/<a href="#">联系我们</a></p>
  <p class="copyright text-center">Copyright ©小蜜蜂网络 / 备案号：ICP备13008243号-1 / 地址：烟台市红旗中路</p>
</div>
<!--./footer-->
<script>
function changText(element,str){
  $(element).text(str);
}
  $("#login").click(function(){
    var email = $("#email").val();
    var passwd = $("#passwd").val();
    var pwdmem = $("#pwdmem").is(":checked");
    console.log(pwdmem);
    //检测空
    if( email == "" ){
      $("#email").focus();
      changText(".warninfo","请输入邮箱地址");
      return;
    }
    if( passwd == "" ){
      $("#passwd").focus();
      changText(".warninfo","请输入密码");
      return;
    }
    $.post(
      "<?php echo U('Login/login');?>",
      {
        email:email,
        passwd:passwd,
        pwdmem:pwdmem
      },
      function(data){console.log(data)}
      );
  });
  
</script>
</body>
</html>