<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo ($user_info["username"]); ?>的简历-小蜜蜂job</title>
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
    
    span.list-intent {
        margin-right: 10px;
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
    <!--container-->
    <div class="container">
        <div class="row">
            <!--left-->
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">基本信息</div>
                    <div class="panel-body">
                        <img src="<?php echo ($user_info["avatar"]); ?>" class="pull-right" width="128" />
                        <h3 class="h-reset"><?php echo ($user_info["username"]); ?><span class="small">（<?php switch($user_info["sex"]): case "1": ?>男<?php break;?>
              <?php case "2": ?>女<?php break;?>
              <?php default: ?>保密<?php endswitch;?>）</span></h3>
                        <p>年龄：<?php echo ($user_info["age"]); ?></p>
                        <p>居住地：<?php echo ($user_info["address"]); ?></p>
                        <p>所在学校：<?php echo ($user_info["school"]); ?></p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">工作经历及意向</div>
                    <div class="panel-body">
                        <p>求职意向：
                            <?php if(is_array($intent)): $i = 0; $__LIST__ = $intent;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$intent): $mod = ($i % 2 );++$i;?><span class="list-intent"><?php echo ($intent["name"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
                        </p>
                        <p>工作经历：<?php echo ($user_info["exp"]); ?></p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">工作技能</div>
                    <div class="panel-body"></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">教育经历</div>
                    <div class="panel-body">
                      <p>现在所在学校：<?php echo ($user_info["school"]); ?></p>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">TA的评价
                      <?php if(isset($_SESSION['oid'])): ?><a href="#" class="pull-right" data-toggle="modal" data-target=".modal">评价一下</a><?php endif; ?>
                    </div>
                    <div class="panel-body">
                      <table class="table">
                      <thead>
                        <td>公司</td>
                        <td>内容</td>
                        <td>时间</td>
                      </thead>
                      <?php if($eval_error_info): ?><tr>
                          <td><?php echo ($eval_error_info); ?></td>
                          <td></td>
                          <td></td>
                        </tr>
                      <?php else: ?>
                      <?php if(is_array($eval_info)): $i = 0; $__LIST__ = $eval_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
                          <td><?php echo ($info["orgname"]); ?></td>
                          <td><?php echo ($info["content"]); ?></td>
                          <td><?php echo ($info["ctime"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                      </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">联系方式</div>
                    <div class="panel-body">            
                        <p>QQ：<img src="<?php echo U("UserInfo/generatePhoneImage","t=qq");?>" /></p>
                        <p>电话：<img src="<?php echo U("UserInfo/generatePhoneImage","t=phone");?>" /></p>
                    </div>
                </div>
            </div>
            <!--right-->
            <div class="col-md-4">
                <div class="panel panel-default">
    <div class="panel-heading">关于小蜜蜂</div>
	<div class="panel-body">
		<img src="/__GROUP__/images/erweima.png" width="190" style="width:190px" class="img-thumbnail center-block" />
	</div>
</div>
            </div>
        </div>
    </div>
    <?php if(isset($_SESSION['oid'])): ?><!--modeal-->
    <div class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">评论一下<?php echo ($user_info["username"]); ?>：</h4>
                </div>
                <div class="modal-body">
                    <form action="">
                      <textarea name="content" id="" class="form-control" cols="30" rows="10"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <span class="pull-left">提示：内容在100字以内</span>
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="eval-goto">评论</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal --><?php endif; ?>
    <!--./container-->
    <!--footer-->
    <div class="container">
  <hr />
  <p class="text-center">小蜜蜂兼职</p>
  <p class="my-info text-center"><a href="http://www.xiaomifengjob.com">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="http://www.xiaomifengjob.com">关于小蜜蜂</a>/<a href="http://www.xiaomifengjob.com">联系我们</a></p>
  <p class="copyright text-center">Copyright © 梦海网络 / 备案号：/ 地址：烟台市红旗中路</p>
  <p class="hidden"><script src="http://s11.cnzz.com/z_stat.php?id=1255390287&web_id=1255390287" language="JavaScript"></script></p>
</div>
    <!--./footer-->
    <script>
    $("#eval-goto").on('click',function(){
      $.ajax({
        url:"<?php echo U("UserInfo/evalMe");?>",
        type:"post",
        data:{
          content:$("textarea[name='content']").val(),
          uid    :<?php echo ($user_info["uid"]); ?>
        },
        success:function(data){
          alert(data.info);
        }
      });
    });
    </script>
</body>

</html>