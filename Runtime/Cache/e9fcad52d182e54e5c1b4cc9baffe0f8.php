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
    #btn_passed,#btn_fail{
        cursor:pointer;
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
        <div class="page-header">
            <h1> <?php echo ($work_info[0]["title"]); ?><small></small></h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <!--信息-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                    人员列表
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <td>用户</td>
                                <td>状态</td>
                                <td>时间</td>
                            </thead>
                            <?php if($work_error_info): echo ($work_error_info); ?>
                            <?php else: ?>
                            <?php if(is_array($work_info)): $i = 0; $__LIST__ = $work_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($info["username"]); ?></td>
                                <td>
                                <?php switch($info["work_status"]): case "0": ?>待做<?php break;?>
                                    <?php case "1": ?>进行中<?php break;?>
                                    <?php case "2": ?>已完成(
                                        <?php switch($info["is_pass"]): case "1": ?>已通过<?php break;?>
                                        <?php case "0": ?>已拒绝<?php break;?>
                                        <?php case "2": ?><a style="margin: 0 10px;" id="btn_passed" data-wid="<?php echo ($info["work_id"]); ?>">确认</a><a style="margin: 0 10px" id="btn_fail" data-wid="<?php echo ($info["work_id"]); ?>">拒绝</a><?php break; endswitch;?>
                                        )<?php break; endswitch;?>
                                </td>
                                <td><?php echo (date('m/d h:i',$info["ctime"])); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </table>
                    </div>
                </div>
                <!--./信息-->
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="<?php echo ($orgInfo["avatar"]); ?>" class="img-thumbnail center-block my-personimg" data-toggle="modal" data-target="#headimg" />
                    </div>
                </div>
            </div>
        </div>
        <!--./container-->
        <!--footer-->
        <div class="container">
  <hr />
  <p class="text-center">小蜜蜂兼职</p>
  <p class="my-info text-center"><a href="#">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="#">关于小蜜蜂</a>/<a href="#">联系我们</a></p>
  <p class="copyright text-center">Copyright ©小蜜蜂网络 / 备案号：ICP备13008243号-1 / 地址：烟台市红旗中路</p>
</div>
        <!--./footer-->
        <script type="text/javascript">
             //进行中的兼职
        $("#btn_passed").on('click',function(){
            $.ajax({
                url:"<?php echo U("OrgCenter/statusHandler");?>",
                data:{wid:$(this).attr('data-wid'),f:'0'},
                type:"GET",
                success:function(data){
                    alert(data.info);
                }
            });
        });
        $("#btn_fail").on('click',function(){
            $.ajax({
                url:"<?php echo U("OrgCenter/statusHandler");?>",
                 data:{wid:$(this).attr('data-wid'),f:'1'},
                type:"GET",
                success:function(data){
                    alert(data.info);
                }
        });
        });
        </script>
</body>

</html>