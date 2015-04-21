<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>登录</title>
<link rel="stylesheet" href="/__GROUP__/css/bootstrap.min.css">
<link rel="stylesheet" href="/__GROUP__/css/bootstrap-theme.min.css">
<script src="/__GROUP__/js/jquery.min.js"></script>
<script src="/__GROUP__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/__GROUP__/js/common.js"></script>
<style type="text/css">
  .red{color:#F00;}
  .panel-body{position: relative;}
  #login{position: absolute; right:16px; bottom: 16px;}
  #verify>input{display:inline;width:216px;}
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
<div class="col-md-8"></div>
<div class="col-md-4">
  <div class="panel panel-default">
  <div class="panel-heading">登录</div>
  <div class="panel-body">
    <form id="login-form">
      <div class="form-group">
        <input type="text" id="email" name="email" class="form-control" placeholder="登录邮箱" />
      </div>
      <div class="form-group">
        <input type="password" id="passwd" class="form-control" placeholder="密码" />
      </div>
      <div class="form-group" id="verify">
        <img src="<?php echo U('Login/vCode');?>" />
        <input type="text" class="form-control" placeholder="验证码" />
        <button class="btn btn-default" type="button">刷新</button>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" id="pwdmem" value="1">三天内免登录
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
/**
*修改指定元素的文本为指定字符串
*@param element
*@param str
*/
function changText(element,str){
  $(element).text(str);
}

//刷新验证码
$("#verify>button").click(function(){
  var ver_img = $("#verify>img");
  ver_img.attr("src","__APP__/Login/vCode?" + new Date().getTime());
});
$("#verify>img").click(function(){
  $(this).attr("src","__APP__/Login/vCode?" + new Date().getTime());
});
//按钮点击时触发ajax
  $("#login").click(function(){
    //获取字段值
    var email = $("#email").val();
    var passwd = $("#passwd").val();
    var ver_val = $("#verify>input").val();
    //checkbox判断
    var pwdmem = $("#pwdmem").is(":checked");
    pwdmem = pwdmem ? 1 : 0;
    //检测字段是否为空
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
    //AJAX
    $.post(
      "<?php echo U('Login/login');?>",
      {
        email:email,
        passwd:passwd,
        pwdmem:pwdmem,
        verify:ver_val
      },
      function(data){
        var str = '';
        switch (data){
          case 0:
            str = '登录成功';
            setTimeout(function(){location.href = '/index.php';},1000);
            break;
          case 2:
            str = '密码错误';
            break;
          case 3:
            str = '邮箱格式不正确';
            break;
          case 4:
            str = '验证码错误';
            break;
          case 5:
            str = '用户不存在';
            break;
        }
        console.log(str);
        changText(".warninfo",str);
      }
      );
  });

  
</script>
</body>
</html>