<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>我的支付信息-小蜜蜂job</title>
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/1.11.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
    <style type="text/css">
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
        <div class="rows">
            <div class="col-md-8">
	            <div class="page-header">
				    <h1><small>我的支付信息<small></small></small></h1>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">我的支付方式</div>
					<div class="panel-body">
						<?php if($error_pay_info): ?><div class="alert alert-danger"><?php echo ($error_pay_info); ?></div>
						<?php else: ?>
							<?php if($pay_info["pay_alipay_id"] != ''): ?><div class="alert alert-success">
									你已经填写支付宝账号：<?php echo ($pay_info["pay_alipay_id"]); ?><a href="#pay_alipay_id" class="pull-right" data-toggle="collapse">更换</a>
								</div>
								<?php else: ?>
								<div class="alert alert-danger">
									你还未填写支付宝账号<a href="#pay_alipay_id" class="pull-right" data-toggle="collapse">填写</a>
								</div><?php endif; ?>
							<div class="collapse" id="pay_alipay_id" style="margin-bottom:18px;">
							<input class="form-control" /><button class="btn btn-default" type="button">提交</button>
							</div>
							<?php if($pay_info["pay_ccard_id"] != ''): ?><div class="alert alert-success">
									你已经填写银行卡信息：<?php echo ($pay_info["pay_ccard_id"]); ?><a href="#pay_ccard_id" class="pull-right" data-toggle="collapse">更换</a>
								</div>
								<?php else: ?>
								<div class="alert alert-danger">
									你还未填写银行卡信息<a href="#pay_ccard_id" data-toggle="collapse" class="pull-right">填写</a>
								</div><?php endif; ?>
							<div class="collapse" id="pay_ccard_id">
							<input class="form-control" />
							<button class="btn btn-default" type="button">提交</button>
							</div>
							<hr />
							<div class="alert alert-success">
								默认支付方式：
								<?php switch($pay_info["default_payway"]): case "1": ?>支付宝收取<?php break;?>
									<?php case "2": ?>银行卡收取<?php break;?>
									<?php case "3": ?>现金收取<?php break; endswitch;?>
								<a href="#default_pay_way" data-toggle="collapse" class="pull-right">更换</a>
							</div>
							<div class="collapse" id="default_pay_way">
								<select name="" id="" class="form-control">
									<option value="1">支付宝</option>
									<option value="2">银行卡</option>
									<option value="3">现金</option>
								</select>
								<button class="btn btn-default">提交</button>
							</div><?php endif; ?>
					</div>
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <!--./container-->
    <!--footer-->
<div class="container">
  <hr />
  <p class="text-center">梦海网络</p>
  <p class="my-info text-center"><a href="http://www.xiaomifengjob.com">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="http://www.xiaomifengjob.com">关于梦海网络</a>/<a href="http://www.xiaomifengjob.com">联系我们</a></p>
  <p class="copyright text-center">Copyright © 梦海网络 / 备案号：/ 地址：烟台市红旗中路</p>
  <p class="hidden"><script src="http://s11.cnzz.com/z_stat.php?id=1255390287&web_id=1255390287" language="JavaScript"></script></p>
</div>
    <!--./footer-->
    <script>
    	$("#pay_alipay_id>button,#pay_ccard_id>button").on('click',function(){
    		var content = $(this).parent().find('input').val();
    		var t;
    		if($(this).parent().attr('id') == 'pay_alipay_id'){
    			t = 1;
    		}else if($(this).parent().attr('id') == 'pay_ccard_id'){
    			t = 2;
    		}
    		$.ajax({
    			url:"<?php echo U("UserCenter/payInfoHandler");?>",
    			data:{
    				type   :t,
    				content:content
    			},
    			type:"POST",
    			success:function(data){
    				alert(data.info);
    				if(data.data == 2){
    					location.href = "";
    				}
    			}
    		});
    	});
    	$("#default_pay_way>button").on('click',function(){
    		var select = $("#default_pay_way>select").val();
    		$.ajax({
    			url:"<?php echo U("UserCenter/payInfoHandler");?>",
    			data:{
    				type:3,
    				content:select
    			},
    			type:"POST",
    			success:function(data){
    				alert(data.info);
    				if(data.data == 2){
    					location.href = "";
    				}
    			}
    		})
    	});
    </script>
</body>

</html>