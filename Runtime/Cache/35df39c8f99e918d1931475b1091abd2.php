<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>兼职平台</title>
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />
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
    
    .my-perinfo {
        margin-left: 26px;
    }
    
    .my-perinfo>p>span {
        margin-right: 18px;
    }
    
    .my-perimg {
        border: 1px solid #EEE;
    }
    
    .my-select-address {}
    
    .my-select-address>select {
        width: auto;
        display: inline-block;
    }
    
    .my-personimg {
        width: 200px;
       /* cursor: pointer;*/
    }
    
    #swfwrapper {
        width: 630px;
    }
    
    .d-markup {
        display: inline-block;
        padding: 4px 6px;
        background: #EEE;
        font: 18px/24px "微软雅黑,黑体";
        margin: 6px 2px;
    }
    
    .d-markup:hover {
        background: #DDD;
        color: #111;
    }
    
    td.table-field {
        width: 148px;
    }
    
    td.table-field+td {
        min-width: 100px;
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
      <a class="" href="/"><img src="/Public/logo/logo.png" height="50" alt="小蜜蜂兼职logo" /></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="<?php echo U('ChangeCity/index');?>">切换城市 [<?php echo session("?city") ? session("city") : "烟台" ?>]</a></li>
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
            <h1><small><?php echo ($org_info["orgname"]); ?></small></h1>
            <?php if($org_error_info): echo ($org_error_info); endif; ?>
        </div>
        <div class="row">
            <div class="col-md-8">
                <!--基本信息-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        基本信息<a class="pull-right" href="<?php echo U('OrgCenter/editInfo');?>">更改信息</a>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td class="table-field">公司资质：</td>
                            <td>
                                <?php if($org_info["is_validate"] == 1): ?>已验证
                                    <?php else: ?>未验证<?php endif; ?>
                            </td>
                            <td class="table-field">登录邮箱：</td>
                            <td><?php echo ($org_info["email"]); ?></td>
                        </tr>
                        <tr>
                            <td class="table-field">客服电话：</td>
                            <td><?php echo ($org_info["phone"]); ?></td>
                            <td class="table-field">公司网址：</td>
                            <td><?php echo ($org_info["website"]); ?></td>
                        </tr>
                        </tr>
                        <td class="table-field">公司地址：</td>
                        <td><?php echo ($org_info["org_address"]); ?></td>
                        </tr>
                    </table>
                </div>
                <!--./基本信息-->
                <!--兼职申请列表-->
                <div class="panel panel-default ">
                    <div class="panel-heading">申请列表</div>
                    <div class="list-group">
                        <?php if(isset($apply_error_info)): ?><li class="list-group-item"><?php echo ($apply_error_info); ?></li>
                            <?php else: ?>
                            <?php if(is_array($applylist)): $i = 0; $__LIST__ = $applylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$applylist): $mod = ($i % 2 );++$i;?><li href="#" class="list-group-item"><a target="_blank" href="<?php echo U('UserInfo/index');?>?uid=<?php echo ($applylist["uid"]); ?>"><?php echo ($applylist["username"]); ?></a>申请了<a href="<?php echo U('JobsInfo/index');?>?jid=<?php echo ($applylist["jid"]); ?>"><?php echo ($applylist["title"]); ?></a><span class="btn-content"><button class="btn btn-success" data-app_id="<?php echo ($applylist["app_id"]); ?>" data-jid="<?php echo ($applylist["jid"]); ?>" data-uid="<?php echo ($applylist["uid"]); ?>">通过</button><button class="btn btn-danger" data-app_id="<?php echo ($applylist["app_id"]); ?>">拒绝</button></span></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                </div>
                <!--./兼职申请列表-->
                <!--进行中的兼职-->
                <div class="panel panel-default">
                    <div class="panel-heading">进行中的兼职</div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <?php if($work_error_info): ?><li class="list-group-item"><?php echo ($work_error_info); ?></li>
                            <?php else: ?>
                            <?php if(is_array($work_info)): $i = 0; $__LIST__ = $work_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><a class="list-group-item" href="<?php echo U("OrgCenter/showIngJobDetail");?>?jid=<?php echo ($info["work_jid"]); ?>">
                                <?php echo ($info["title"]); ?><span class="pull-right badge"><?php echo (date('m/d h:i',$info["ctime"])); ?></span>
                            </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </ul>
                    </div>
                </div>
                <!--./进行中的兼职-->
                <!--发布的兼职列表-->
                <div class="panel panel-default">
                    <div class="panel-heading">发布的兼职</div>
                    <div class="list-group">
                        <?php if(is_array($publicedJobs)): $i = 0; $__LIST__ = $publicedJobs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><a href="<?php echo U("JobsInfo/index");?>?jid=<?php echo ($jobs["jid"]); ?>" target="_blank" class="list-group-item"><?php echo ($jobs["title"]); ?><span class="badge"><?php echo ($jobs["current_peo"]); ?>/<?php echo ($jobs["want_peo"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <!--./发布的兼职列表-->
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="<?php echo ($org_info["avatar"]); ?>" class="img-thumbnail center-block my-personimg" data-toggle="modal" data-target="#headimg" />
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
</div>
        <script type="text/javascript">
        $(".panel button").click(function() {
            $info = new Object();
            $info.ispass = "no";
            if ($(this).attr("class") == 'btn btn-success') {
                $info['ispass'] = "yes";
                $info.uid = $(this).attr("data-uid");
                $info.app_id = $(this).attr("data-app_id");
                $info.jid = $(this).attr("data-jid");
            } else if ($(this).attr("class") == "btn btn-danger") {
                $info.app_id = $(this).attr("data-app_id");
            }
            console.log($info);
            //ajax
            $.ajax({
                url: "<?php echo U('OrgCenter/isPass');?>",
                data: $info,
                type: "GET",
                success: function(data) {
                    alert(data.info);
                }
            });

        });
        </script>
        <!--./footer-->
</body>

</html>