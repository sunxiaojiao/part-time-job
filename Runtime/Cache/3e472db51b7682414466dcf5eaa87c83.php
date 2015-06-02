<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>找回密码</title>
    <link href="/Public/favicon.ico" type="image/x-icon" rel=icon />
<link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/jquery.min.js"></script>
<script src="/__GROUP__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/__GROUP__/js/common.js"></script>
    <style type="text/css">
    .panel-body {
        position: relative;
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
      <a class="" href="/"><img src="/Public/logo/logo.png" height="50" alt="小蜜蜂兼职logo" /></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="<?php echo U('ChangeCity/index');?>">切换城市 [<?php echo session("?city") ? session("city") : "烟台" ?><strong>·</strong><?php echo session("?area") ? session("area") : "芝罘区" ?>]</a></li>
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
    <div class="container">
        <div class="row">
            <div class="col-md-8">
            <div class="page-header">
                <h1>找回密码</h1>
            </div>
                <div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#byemail" aria-controls="byemail" role="tab" data-toggle="tab">通过邮箱</a></li>
    <li role="presentation"><a href="#byphone" aria-controls="byphone" role="tab" data-toggle="tab">通过手机</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content" style="margin-top:14px">
    <div role="tabpanel" class="tab-pane active" id="byemail">
        <div class="alert alert-success alert-dismissable hidden" id="alert-success">
            <button type="button" class="close" aria-hidden="true">&times;</button><p>发送成功</p></div>
        <div class="alert alert-danger alert-dismissable hidden" id="alert-failed">
            <button type="button" class="close" aria-hidden="true">&times;</button><p>发送失败</p></div>

        <form class="form-horizontal" id="byemail-form">
            <div class="clearfix">
            <div class="col-md-4 col-md-offset-2">
                <div class="radio pull-left">
                    <label>
                        <input type="radio" name="u_type" value="user" checked />求职者
                    </label>
                </div>
                <div class="radio pull-left" style="margin-left:10px;">
                    <label>
                        <input type="radio" name="u_type" value="org" />公司机构
                    </label>
                </div>
            </div>
            <div class="col-md-8">
                &nbsp;
            </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">绑定的邮箱：</label>
                <div class="col-md-10">
                    <input type="text" name="email" class="form-control" placeholder="邮箱" />
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-md-2 control-label">验证码：</label>
                <div class="col-md-6">
                    <input type="text" name="verify" class="form-control" placeholder="验证码"/>
                </div>
                <div id="verify">
                <div class="col-md-2">
                    <img src="<?php echo U("PasswdFind/vCode");?>" class="verify" />
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-default verify">刷新</button>
                </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <button type="button" class="btn btn-default" id="email-goto">提交</button>
                </div>
            </div>
        </form>
    </div>
    <div role="tabpanel" class="tab-pane" id="byphone">
        <p>暂不支持通过手机号码找回密码。</p>
    </div>
  </div>

</div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
    <!--./container-->
    <!--footer-->
    <div class="container">
  <hr />
  <p class="text-center">小蜜蜂兼职</p>
  <p class="my-info text-center"><a href="http://www.xiaomifengjob.com">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="http://www.xiaomifengjob.com">关于小蜜蜂</a>/<a href="http://www.xiaomifengjob.com">联系我们</a></p>
  <p class="copyright text-center">Copyright ©小蜜蜂网络 / 备案号：ICP备13008243号-1 / 地址：烟台市红旗中路</p>
</div>
    <!--./footer-->
    <script>
        $("#email-goto").click(function() {
            var btn = $(this);
            var info = getFromInput("#byemail-form");
            console.log(info);
            //验证邮箱格式
            var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var flag = re.exec(info.email);
            //var flag = 1;
            console.log(flag);
            if (!flag) {
                $("#alert-failed>p").text("请填写正确的邮箱格式");
                $("#alert-success").addClass("hidden");
                $("#alert-failed").removeClass("hidden");
                return;
            }
            if(info.verify == ''){
             $("#alert-failed>p").text("请填写验证码");
                $("#alert-success").addClass("hidden");
                $("#alert-failed").removeClass("hidden");
                return;   
            }
            var btnLoading = $(this).button('loading');
            $.ajax({
                url: "<?php echo U('PasswdFind/sendEmailHandler');?>",
                data:info,
                type: "POST",
                success: function(data) {
                    if (data.data == 1) {
                        $("#alert-failed").addClass("hidden");
                        $("#alert-success").removeClass("hidden").text('密码找回邮箱已发送，请注意查收');
                        btn.text("发送成功");
                    } else {
                        $("#alert-success").addClass("hidden");
                        $("#alert-failed").removeClass("hidden");
                        $("#alert-failed p").text(data.info);
                        btn.button('reset');
                        $("#verify img.verify").click();
                    }
                },
                error: function() {
                    $("#alert-success").addClass("hidden");
                    $("#alert-failed").removeClass("hidden");
                    btn.button('reset');
                    $("#verify img.verify").click();
                }
            });
        });
    enterKey($("input[name='verify']"),$("#email-goto"));
    </script>
    </body>

</html>