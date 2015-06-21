<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo ($work_info[0]["title"]); ?>-小蜜蜂兼职</title>
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
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
      <a class="" href="/"><img src="/Public/logo/logo.png" height="50" alt="小蜜蜂兼职logo" /></a>
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
                                <td>
                                    <?php switch($work_info[0]["pay_way"]): case "1": ?>支付宝<?php break;?>
                                        <?php case "2": ?>银行卡<?php break;?>
                                        <?php default: ?>现金<?php endswitch;?>
                                </td>
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
                                <td>
                                    <?php switch($info["pay_way"]): case "1": echo ($info["pay_alipay_id"]); break;?>
                                        <?php case "2": echo ($info["pay_ccard_id"]); break;?>
                                        <?php default: ?>/<?php endswitch;?>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </table>
                    </div>
                </div>
                <!--./信息-->
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">关于小蜜蜂</div>
                    <div class="panel-body">
                        <img src="/__GROUP__/images/erweima.png" class="img-thumbnail center-block" />
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