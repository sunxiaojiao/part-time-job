<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>兼职平台</title>
    <link rel="stylesheet" href="./__GROUP__/css/bootstrap.min.css">
    <link rel="stylesheet" href="./__GROUP__/css/bootstrap-theme.min.css">
    <script src="./__GROUP__/js/jquery.min.js"></script>
    <script src="./__GROUP__/js/bootstrap.min.js"></script>
    <style type="text/css">
    .scroll-content {
        position: relative;
    }
    
    #scroll-target {
        position: fixed;
    }
    
    .panel-body {
        position: relative;
    }
    
    .list-group a.list-group-item {
        cursor: pointer;
    }
    
    .btn-content {
        position: absolute;
        right: 10px;
        margin-top: -8px;
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
                <?php if(session('?admin_id')): ?><!--dropdown-->
                    <li class="dropdown">
                        <a href="<?php echo U('Admin/index');?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo session('username');?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
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
            <div class="col-md-3">
                <ul class="list-group nav" id="scroll-target">
                    <a class="list-group-item" href="#publish-apply">兼职申请列表</a>
                    <a class="list-group-item" href="#auth-apply">认证申请列表</a>
                    <a class="list-group-item" href="#current-orgs">现有公司列表</a>
                    <a class="list-group-item" href="#jobs-list">兼职列表</a>
                </ul>
            </div>
            <div class="col-md-9 scroll-content" data-spy="scroll" data-target="#scroll-target">
                <div class="panel panel-primary">
                    <div class="panel-heading" id="publish-apply">兼职申请列表</div>
                    <ul class="list-group">
                    <?php if(is_null($jobs_error)): if(is_array($jobs_list)): $i = 0; $__LIST__ = $jobs_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class="list-group-item"><a href="<?php echo U('JobsInfo/index');?>&jid=<?php echo ($list["jid"]); ?>"><?php echo ($list["title"]); ?></a><span class="btn-content" data-jid="<?php echo ($list["jid"]); ?>"><button type="button" class="btn btn-success" data-pass="yes">通过</button><button type="button" class="btn btn-danger" data-pass="no">拒绝</button></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            <?php else: ?>
                            <li class="list-group-item"><?php echo ($jobs_error); ?></li><?php endif; ?>
                    </ul>
                    <ul class="pagination"><?php echo ($orgs_page); ?></ul>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading" id="auth-apply">认证申请列表</div>
                    <ul class="list-group">
                        <?php if(is_null($orgsauth_error)): if(is_array($orgsauth_list)): $i = 0; $__LIST__ = $orgsauth_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$apply): $mod = ($i % 2 );++$i;?><li class="list-group-item"><a href="<?php echo U('OrgInfo/index');?>&oid=<?php echo ($apply["oid"]); ?>"><?php echo ($apply["orgname"]); ?></a><span class="btn-content" data-oid="<?php echo ($apply["oid"]); ?>"><button type="button" class="btn btn-success" data-pass="yes">通过</button><button type="button" class="btn btn-danger" data-pass="no">拒绝</button></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            <?php echo dump($orgsauth_error);?>
                            <?php else: ?>
                            <li class="list-group-item"><?php echo ($orgsauth_error); ?></li><?php endif; ?>
                    </ul>
                    <ul class="pagination"><?php echo ($orgsauth_page); ?></ul>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading" id="current-orgs">现有公司列表</div>
                    <ul class="list-group">
                        <?php if(isset($empty)): ?><li class="list-group-item"><?php echo ($empty); ?></li>
                            <?php else: ?>
                            <?php if(is_array($orgs_list)): $i = 0; $__LIST__ = $orgs_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$orglists): $mod = ($i % 2 );++$i;?><a href="<?php echo U('OrgInfo/index');?>&oid=<?php echo ($orglists["oid"]); ?>" class="list-group-item"><?php echo ($orglists["orgname"]); ?>/<?php echo ($orglists["is_validate"]); ?>/创建时间：<?php echo ($orglists["ctime"]); ?></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </ul>
                    <nav>
                        <ul class="pagination"><?php echo ($orgs_page); ?></ul>
                    </nav>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading" id="jobs-list">兼职列表</div>
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
    $(".btn-content>button").on('click', function() {
        var info = new Object();
        info.pass = $(this).attr('data-pass');
        info.oid = $(this).parent().attr('data-oid');
        info.jid  = $(this).parent().attr('data-jid');
        console.log(info);
        if( info.oid ) {
            $.ajax({
                url: "<?php echo U('Admin/authHandler');?>",
                data: info,
                type: "POST",
                success: function(data) {
                    alert(data.info);
                }
            });    
        }else if( info.jid ) {
             $.ajax({
                url : "<?php echo U('Admin/jobHandler');?>",
                data: info,
                type: "POST",
                success:function(data) {
                    alert(data.info);
                }
             });   
        }

        
        
    })
    </script>
</body>

</html>