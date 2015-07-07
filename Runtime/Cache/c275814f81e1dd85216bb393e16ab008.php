<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>注册-梦海网络</title>
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/1.11.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
    <style type="text/css">
    #email-goto {
        top: 13px;
    }
    
    #email {
        border-radius: 4px;
    }
    
    #select-list a {
        cursor: pointer;
    }
    
    .red {
        color: #F00;
    }
    
    .my-warning {
        float: left;
    }
    
    #verify>img,
    #verify>button {}
    #reg-form{
    	margin-top:16px;
    }
    </style>
    <script>
    </script>
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
        <div class="page-header">
            <h1>注册<small>小蜜蜂兼职</small></h1>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="alert alert-success hidden" role="alert">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <p></p>
                </div>
                <ul class="nav nav-pills" id="select-list">
                    <li role="presentation" class="active"><a>求职者</a></li>
                    <li role="presentation"><a>公司或机构组织</a></li>
                </ul>
                <form method="post" action="<?php echo U('Register/reg');?>" id="reg-form" class="form-horizontal">
                    <div class="form-group">
                        <label for="phone_num" class="col-sm-2">手机号：</label>
                        <div class="col-sm-8">
                        	<input id="phone_num" type="text" name="phone_num" class="form-control" placeholder="手机号" />
                        </div>
                    </div>
                    <div id="username-container">
	                    <div class="form-group">
	                        <label for="username" class="col-sm-2">用户名：</label>
	                        <div class="col-sm-8">
	                        	<input id="username" type="text" name="username" class="form-control" placeholder="用户名" />
	                        </div>
	                    </div>
                        <div class="form-group">
                        <label for="school" class="col-sm-2">学校：</label>
                        <div class="col-sm-8">
                            <input id="school" type="text" name="school" class="form-control" placeholder="你的学校" />
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="passwd" class="col-sm-2">密码：</label>
                        <div class="col-sm-8">
                        	<input id="passwd" type="password" name="passwd" class="form-control" placeholder="密码" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="repasswd" class="col-sm-2">确认密码：</label>
                        <div class="col-sm-8">
                        	<input id="repasswd" type="password" name="repasswd" class="form-control" placeholder="验证密码" />
                        </div>
                    </div>
                    
                    <div class="form-group" id="verify">
                    		<label for="" class="col-sm-2 col-xs-12">验证码：</label>
                            <div class="col-sm-5 col-xs-6">
                                <input class="form-control" type="text" name="vcode" placeholder="验证码" />
                            </div>
                            <div class="col-sm-4 col-xs-6" id="verify">
                                <img src="<?php echo U("Register/vCode");?>" class="verify" />
                                <button type="button" class="btn btn-default verify">刷新</button>
                            </div>
                    </div>
                    <div id="org-container">
                    </div>
					<div class="form-group">
                    	<div class="col-sm-12">
                    	<input type="checkbox" class="" id="our-article" /><label for="our-article">同意我们的条款</label>（<a href="<?php echo U("Register/ourArticle");?>" target="_blank">查看</a>）
                    	</div>
                    </div>
                    <button type="button" class="btn btn-default" id="reg-goto">提交</button>
                </form>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
    <div class="panel-heading">梦海网络</div>
	<div class="panel-body">
		<img src="/__GROUP__/images/erweima.png" width="190" style="width:190px" class="img-thumbnail center-block" />
	</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">平台介绍</div>
	<div class="panel-body">
		<pre>&emsp;&emsp;小蜜蜂job烟台梦海网络打造的一款大学生生活服务平台，我们通过考察企业，附近兼职，互相评论，星级评价四大环节，为大学生校园工作保驾护航，打造安全靠谱的大学生生活服务平台。</pre>
	</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">公司介绍</div>
	<div class="panel-body">
		<pre>&emsp;&emsp;烟台梦海网络是由烟台大学生创办的新一代互联网公司，我们来自烟台各大高校，全部由90后组成，致力于打造全国大学生生活服务第一平台，我们会用饱满热情的态度服务广大大学生</pre>
	</div>
</div>
            </div>
        </div>
        <!--end container-->
        <!--footer-->
        <div class="container">
  <hr />
  <p class="text-center">梦海网络</p>
  <p class="my-info text-center"><a href="http://www.xiaomifengjob.com">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="http://www.xiaomifengjob.com">关于梦海网络</a>/<a href="http://www.xiaomifengjob.com">联系我们</a></p>
  <p class="copyright text-center">Copyright © 梦海网络 / 备案号：/ 地址：烟台市红旗中路</p>
  <p class="hidden"><script src="http://s11.cnzz.com/z_stat.php?id=1255390287&web_id=1255390287" language="JavaScript"></script></p>
</div>
        <!--end footer-->
        <script type="text/javascript">
        function tabShow(arg) {
            for (var i = 0; i < 2; i++) {
                $("#select-list>li").eq(i).removeClass("active");
            }
            $("#select-list>li").eq(arg).addClass("active");
            whatToSelect = arg;
        }
        function showChange(arg) {
                var strorg = new String('<div class="form-group input-org"><label for="org" class="col-sm-2">组织名称：</label><div class="col-sm-8"><input id="org" type="text" name="org" class="form-control" placeholder="组织机构名称" /><input name="reg_type" value="org" class="hidden"/></div></div><div class="form-group input-org"><label for="org_address" class="col-sm-2">所在地：</label><div class="col-sm-8"><input id="org_address" type="text" name="address" class="form-control" placeholder="组织机构所在地" /></div></div>');
                var struser = new String('<div class="form-group"><label for="username" class="col-sm-2">用户名：</label><div class="col-sm-8"><input id="username" type="text" name="username" class="form-control" placeholder="用户名" /></div></div><div class="form-group"><label for="school" class="col-sm-2">学校：</label><div class="col-sm-8"><input id="school" type="text" name="school" class="form-control" placeholder="你的学校" /></div>');
                if(arg == 0){
                	//求职者注册
                    if($(".input-org")){
                        $(".input-org").remove();
                       	$("#username-container").html(struser);
                    }
                }else{
                	//企业注册
                    if($(".input-org").length == 0){
                    	$("#username-container").html(null);
                        $("#org-container").html(strorg);
                    }
                }
            }
            //绑定事件
        $("#select-list>li").eq(0).click(function() {
            tabShow(0);
            showChange(0);
        });
        $("#select-list>li").eq(1).click(function() {
            tabShow(1);
            showChange(1);
        });
        (function(){
        	$(".alert button").on('click',function(){
        		$(this).parent().addClass("hidden");
        	});
        })();
        //Ajax	
        $("#reg-goto").click(function() {
            //获取数据
            var info = getFromInput("#reg-form");
            console.log(info);
            //客户端验证
            if(info.phone_num === ''){
            	$(".alert>p").text("您忘记填写手机号啦");
                $(".alert").removeClass("alert-success").addClass("alert-danger");
                $(".alert").removeClass("hidden");
                return;
            }
           	if(info.username === ''){
           		$(".alert>p").text("请填写用户名");
                $(".alert").removeClass("alert-success").addClass("alert-danger");
                $(".alert").removeClass("hidden");
                return;
           	}
            if (info.passwd === '') {
                $(".alert>p").text("您忘记填写密码啦");
                $(".alert").removeClass("alert-success").addClass("alert-danger");
                $(".alert").removeClass("hidden");
                return;
            }
            if (info.passwd != info.repasswd) {
                $(".alert").removeClass("alert-success").addClass("alert-danger");
                $(".alert>p").text("两次密码不一致");
                $(".alert").removeClass("hidden");
                return;
            }
            if(info.org === ''){
            	$(".alert>p").text("企业用户须填写企业名称");
                $(".alert").removeClass("alert-success").addClass("alert-danger");
                $(".alert").removeClass("hidden");
                return;
            }
            if(info.org_address === ''){
            	$(".alert>p").text("企业用户须填写企业所在地");
                $(".alert").removeClass("alert-success").addClass("alert-danger");
                $(".alert").removeClass("hidden");
                return;
            }
            //验证是否勾选用户条款
            	var flagChecked = document.getElementById("our-article").checked;
	            if( !flagChecked ){
	            	$(".alert>p").text("您需要同意我们的协议，才能注册");
	                $(".alert").removeClass("alert-success").addClass("alert-danger");
	                $(".alert").removeClass("hidden");
	            	return;
	            }
            //ajax传输
            $.ajax({
                url:"<?php echo U('Register/reg');?>",
                data:info,
                type:"POST",
                success:function(data) {
                	$(".alert").removeClass("alert-danger").addClass("alert-success");
                    $(".alert>p").text(data.info);
                    if (data.data == 0) {
                        var f = '';
                        if(data.status == 1){
                            f = '<?php echo U("UserCenter/editInfo");?>';
                        }else if(data.status == 2){
                            f = '<?php echo U("OrgCenter/editInfo");?>';
                        }
                        setTimeout(function() {
                                location.href = f;
                            }, 3000);
                    } else {
                    	$(".alert").removeClass("alert-success").addClass("alert-danger");
                        setTimeout(function() {
                            $("#verify>img").click()
                        }, 500);
                    }

                    $(".alert").removeClass("hidden");

                },
                error:function(){

                }
            });
        });
        </script>
</body>