<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>用户中心-小蜜蜂兼职</title>
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
        cursor: pointer;
    }
    
    #swfwrapper {
        width: 630px;
    }
    
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
            <h1><small>我的小蜜蜂<small>(<?php echo ($userinfo["username"]); ?>)</small></small></h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?php if($userinfo["email"] == ''): ?><div class="alert alert-danger"><a href="<?php echo U("AttachEmail/index");?>">你还未绑定邮箱，请立刻绑定邮箱，方便找回密码等业务</a></div><?php endif; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">个人信息及求职简历<a href="<?php echo U("UserCenter/editInfo");?>" class="pull-right">编辑我的资料和简历</a><a href="<?php echo U("UserCenter/showPayInfo");?>" class="pull-right" style="margin:0 10px">我的支付信息</a></div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <td>用户名：</td>
                                <td><?php echo ($userinfo["username"]); ?></td>
                                <td>性别</td>
                                <td>
                                    <?php switch($userinfo["sex"]): case "1": ?>男<?php break;?>
                                        <?php case "2": ?>女<?php break;?>
                                        <?php default: ?>保密<?php endswitch;?>
                                </td>
                            </tr>
                            <tr>
                                <td>年龄：</td>
                                <td><?php echo ($userinfo["age"]); ?>岁</td>
                                <td>电话：</td>
                                <td><?php echo ($userinfo["phone"]); ?></td>
                            </tr>
                            <tr>
                                <td>邮箱</td>
                                <td><?php if($userinfo["email"] == ''): ?><a href="<?php echo U("AttachEmail/index");?>">绑定邮箱</a>
                                    <?php else: echo ($userinfo["email"]); endif; ?>
                                </td>
                                <td>地址：</td>
                                <td><?php echo ($address); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">我的申请（今天还可以申请 <?php echo ($apply_num); ?> 次）</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <td>兼职</td>
                                <td>申请时间</td>
                                <td>是否通过</td>
                            </thead>
                            <?php if($apply_error_info): ?><tr>
                                    <td><?php echo ($apply_error_info); ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php else: ?>
                                <?php if(is_array($apply)): $i = 0; $__LIST__ = $apply;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$apply): $mod = ($i % 2 );++$i;?><tr>
                                        <td><a href="<?php echo U('JobsInfo/index');?>?jid=<?php echo ($apply["jid"]); ?>"><?php echo ($apply["title"]); ?></a></td>
                                        <td><?php echo (date("m/d h:i",$apply["ctime"])); ?></td>
                                        <td>
                                            <?php switch($apply["is_pass"]): case "1": ?>处理中...<?php break;?>
                                                <?php case "2": ?>通过<?php break;?>
                                                <?php case "3": ?>未通过<?php break; endswitch;?>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">正在进行中的兼职</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <td>兼职</td>
                                <td>状态</td>
                                <td>时间</td>
                            </thead>
                            <?php if($work_error_info): ?><tr>
                                    <td><?php echo ($work_error_info); ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php else: ?>
                                <?php if(is_array($work_info)): $i = 0; $__LIST__ = $work_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
                                        <td><a href="<?php echo U("JobsInfo/index");?>?jid=<?php echo ($list["jid"]); ?>"><?php echo ($list["title"]); ?></td>
              <td>
                <?php switch($list["work_status"]): case "0": ?>待做<a class="operator" data-toggle="modal" data-target=".modal" data-wid="<?php echo ($list["work_id"]); ?>">操作</a><?php break;?>
                <?php case "1": ?>正在进行<a class="operator" data-toggle="modal" data-target=".modal" data-wid="<?php echo ($list["work_id"]); ?>">操作</a><?php break;?>
                <?php case "2": switch($list["is_pass"]): case "1": ?>做完了（<?php echo (date('m/d',$list["begin_time"])); ?>&nbsp;<?php echo (date('h:i',$list["begin_time"])); ?>-<?php echo (date('h:i',$list["end_time"])); ?>）<?php break;?>
                        <?php case "2": ?>正在审核<?php break;?>
                        <?php case "0": ?>未通过审核<?php break; endswitch; break; endswitch;?>
                                        </td>
                                        <td><?php echo (date('m/d',$list["ctime"])); ?></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">我的评论</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <td>公司机构</td>
                                <td>内容</td>
                                <td>时间</td>
                            </thead>
                            <?php if($eval_error_info): ?><tr>
                                    <td><?php echo ($eval_error_info); ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php else: ?>
                                <?php if(is_array($eval_info)): $i = 0; $__LIST__ = $eval_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
                                        <td><a href="<?php echo U('OrgInfo/index');?>?oid=<?php echo ($list["oid"]); ?>"><?php echo ($list["orgname"]); ?></a></td>
                                        <td><?php echo ($list["content"]); ?></td>
                                        <td><?php echo (date("m-d",$list["ctime"])); ?></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">头像</div>
                    <div class="panel-body">
                        <img src="<?php echo ($userinfo["avatar"]); ?>" class="center-block" />
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">操作</h4>
                    </div>
                    <div class="modal-body">
                        <button class="btn btn-default btn-lg" id="begin_w"  data-wid="<?php echo ($list["work_id"]); ?>">开始兼职</button>
                        <button class="btn btn-success btn-lg" id="end_w"  data-wid="<?php echo ($list["work_id"]); ?>">完成兼职</button>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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
    $("#goto-info").click(function() {
        $(".alert").addClass("hidden");
        //获取数据
        var info = getFromInput('#edit-info');
        var checkboxs = $("input[type='checkbox']");
        var intent = new Object();
        for (var i = 0; i < checkboxs.length; i++) {
            if (checkboxs.eq(i).is(":checked")) {
                intent[i] = checkboxs.eq(i).val();
            }
        }
        info.intent = intent;
        //ajax
        $.ajax({
            url: '<?php echo U('UserCenter/updateInfo');?>',
            data: info,
            type: "POST",
            success: function(data) {
                if (data.data === 1) {
                    $(".alert").removeClass("alert-danger").addClass("alert-success");
                } else {
                    $(".alert").removeClass("alert-success").addClass("alert-danger");
                }
                $(".alert>p").text(data.info);
                $(".alert").removeClass("hidden");
            }
        });
    });
    //我的兼职中-操作
    var btn_begin_w = $('#begin_w');
    var btn_end_w   = $('#end_w');
    $(".operator").on('click',function(){
      var wid = $(this).attr('data-wid');
      btn_begin_w.attr('data-wid',wid);
      btn_end_w.attr('data-wid',wid);
    });
    btn_begin_w.on('click',function(){
      var wid  = $(this).attr('data-wid');
      var f    = 1;
      var info = {wid:wid,f:f};
      console.log(info);
      $.ajax({
        url:"<?php echo U("UserCenter/MyJobHandler");?>",
        type:'GET',
        data:info,
        success:function(data){
          alert(data.info);
          location.href = "";
        }
      });
    });
    btn_end_w.on('click',function(){
      var wid  = $(this).attr('data-wid');
      var f    = 2;
      var info = {wid:wid,f:f};
      console.log(info);
      $.ajax({
        url:"<?php echo U("UserCenter/MyJobHandler");?>",
        type:'GET',
        data:info,
        success:function(data){
          alert(data.info);
          location.href = "";
        }
      });
    });
    </script>
</body>

</html>