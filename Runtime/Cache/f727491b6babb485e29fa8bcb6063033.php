<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>兼职平台</title>
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
    <style type="text/css">
    .table img{
        /*width:200px;*/
        height:200px;
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
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="输入关键词">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php if(session('?admin_id')): ?><!--dropdown-->
                    <li class="dropdown">
                        <a href="<?php echo U('Admin/index');?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo session('username');?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo U("Admin/index");?>">管理中心</a></li>
                            <li><a href="#">修改密码</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo U('Admin/logout');?>">注销</a></li>
                        </ul>
                    </li>
                    <!--/.dropdown-->
                    <?php else: ?>
                    <li><a href="<?php echo U('Register/index');?>">注册</a></li>
                    <li><a href="<?php echo U('Login/index');?>">登录</a></li><?php endif; ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<!--======导航条结束======--->

    <!--container-->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">公司认证信息</div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>公司名称：</td>
                                <td><?php echo ($orgname); ?></td>
                            </tr>
                            <tr>
                                <td>执照编号：</td>
                                <td><?php echo ($license_num); ?></td>
                            </tr>
                            <tr>
                                <td>营业执照：</td>
                                <td><img src="<?php echo ($license_img); ?>" /></td>
                            </tr>
                            <tr>
                                <td>企业规模：</td>
                                <td><?php echo ($size); ?></td>
                            </tr>
                            <tr>
                                <td>企业性质：</td>
                                <td><?php echo ($nature); ?></td>
                            </tr>
                            <tr>
                                <td>联系人：</td>
                                <td><?php echo ($contact); ?></td>
                            </tr>
                            <tr>
                                <td>负责人身份证号：</td>
                                <td><?php echo ($idcard_num); ?></td>
                            </tr>
                            <tr>
                                <td>负责人身份证照片：</td>
                                <td><img src="<?php echo ($idcard_img1); ?>" />
                                <img src="<?php echo ($idcard_img2); ?>" /></td>
                            </tr>
                            <tr>
                                <td>联系人电话：</td>
                                <td><?php echo ($phone); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
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
  <p class="my-info text-center"><a href="http://www.xiaomifengjob.com">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="http://www.xiaomifengjob.com">关于小蜜蜂</a>/<a href="http://www.xiaomifengjob.com">联系我们</a></p>
  <p class="copyright text-center">Copyright ©小蜜蜂网络 / 备案号：ICP备13008243号-1 / 地址：烟台市红旗中路</p>
  <p class="hidden"><script src="http://s11.cnzz.com/z_stat.php?id=1255390287&web_id=1255390287" language="JavaScript"></script></p>
</div>
    <!--./footer-->
    <script>
    $("#login-form button").on('click', function() {
        //获取input值
        var info = new Object();
        info.username = $("#login-form input").eq(0).val();
        info.passwd = $("#login-form input").eq(1).val();
        console.log(info);
        //ajax
        $.ajax({
            url: "<?php echo U('Admin/loginHandler');?>",
            data: info,
            type: "POST",
            success: function(data) {
                alert(data.info);
                if (data.status == 1) {
                    location.href = "<?php echo U('Admin/index');?>";
                }
            }
        });
    })
    </script>
</body>

</html>