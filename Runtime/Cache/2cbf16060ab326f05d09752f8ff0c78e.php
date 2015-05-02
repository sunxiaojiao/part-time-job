<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>兼职平台</title>
    <link href="/Public/favicon.ico" type="image/x-icon" rel=icon />
<link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/jquery.min.js"></script>
<script src="/__GROUP__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/__GROUP__/js/common.js"></script>

    <style type="text/css">
    .must-input {
        color: #F00;
        padding: 0 8px;
        font: 18px/18px "";
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
 if(session('?uid')){ echo $dropdown2; }elseif(session('?oid')){ echo $dropdown1; }else{ echo "<li><a href=" . U('Register/sendMail') . ">注册</a></li>
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
                <form class="" action="" method="post" id="auth-form">
                    <div class="form-group">
                        <label><span class="must-input">*</span>机构名称：</label>
                        <input class="form-control" disabled="true" />
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>执照编号：</label>
                        <input class="form-control"  name="license_num" />
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>所属行业：</label>
                        <select class="form-control" name="industry">
                            <option value="1">房地产</option>
                            <option value="2">建筑</option>
                            <option value="3">物流管理</option>
                            <option value="4">IT/互联网</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>机构性质：</label>
                        <select class="form-control" name="nature">
                            <option value="1">国有企业</option>
                            <option value="2">私营企业</option>
                            <option value="3">中外合资</option>
                            <option value="4">个体户</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>机构规模：</label>
                        <select class="form-control" name="size">
                            <option value="1">20以下</option>
                            <option value="2">20-50</option>
                            <option value="3">50-100</option>
                            <option value="4">100-300</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>结构地址：</label>
                        <input class="form-control" name="address" />
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>联系人：</label>
                        <input class="form-control" name="contact" />
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>联系电话：</label>
                        <input class="form-control" name="phone" />
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>机构固定电话：</label>
                        <input class="form-control" name="fixed_phone" />
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>机构邮箱：</label>
                        <input class="form-control" disabled="true" />
                    </div>
                    <div class="form-group">
                        <label>结构介绍：</label>
                        <textarea class="form-control" rows="4" name="intro"></textarea>
                    </div>
                    <?php if($isApply == 'true'): ?><button type="button" class="btn btn-primary" id="goto-submit" disabled="true">提交</button>
                    <?php else: ?>
                    <button type="button" class="btn btn-primary" id="goto-submit">提交</button><?php endif; ?>
                </form>
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
        var info = getFromInput("#auth-form");
        console.log(info);
        $.ajax({
            url: "<?php echo U('OrgAuth/auth');?>",
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