<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>编辑企业信息-小蜜蜂job</title>
<link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/1.11.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
<script type="text/javascript" src="/__GROUP__/js/fullAvatarEditor.js"></script>
<script type="text/javascript" src="/__GROUP__/js/swfobject.js"></script>

<style type="text/css">
  .panel-body{position: relative;}
  .my-perinfo{margin-left:26px;}
  .my-perinfo>p>span{margin-right:18px;}
  .my-perimg{border:1px solid #EEE;}
  .my-select-address{}
  .my-select-address>select{width:auto;display: inline-block;}
  .my-personimg{width:200px; cursor: pointer;}
  #swfwrapper{width:630px;}
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
      <h1><small>企业信息<small>(<?php echo ($orgInfo["orgname"]); ?>)</small></small></h1>
  </div>
  <div class="row">
    <div class="col-md-8">
      <form method="post" action="" id="edit-info">
        <div class="">
          <label>认证状态：</label><?php if($orgInfo["is_validate"] == 0): ?><span>未认证</span><?php else: ?><span>已认证</span><?php endif; ?>
          <a class="btn-primary btn" href="<?php echo U('OrgAuth/index');?>">认证</a>
        </div>
        <div class="form-group">
          <label for="username"><span class="must-input">*</span>所在地：</label>
          <div class="my-select-address">
            <input type="text" class="form-control" name="address" value="<?php echo ($orgInfo["org_address"]); ?>" />
          </div>
        </div>

        <div class="form-group">
          <label for="phone"><span class="must-input">*</span>客服电话：</label>
          <input type="text" name="phone" class="form-control" value="<?php echo ($orgInfo["phone"]); ?>" placeholder="填写联系电话" />
        </div>
        <div class="form-group">
          <label for="qq"><span class="must-input">*</span>公司网址：</label>
          <input type="text" id="website" name="website" class="form-control" value="<?php echo ($orgInfo["website"]); ?>" placeholder="公司网址" />
        </div>
          <div class="form-group">
            <label for="exp"><span class="must-input">*</span>公司或机构介绍:</label>
            <textarea class="form-control" rows="3" id="exp" name="org_intro" placeholder="简要介绍"><?php echo ($orgInfo["org_intro"]); ?></textarea>
          </div>
        <div class="form-group">
          <label for="intent"><span class="must-input">*</span>招聘意向:</label>
          <div>
          <?php if($mold_error_info): echo ($mold_error_info); ?>
          <?php else: ?>
         <?php if(is_array($mold_info)): $i = 0; $__LIST__ = $mold_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$molds): $mod = ($i % 2 );++$i; if(in_array($molds['mid'],unserialize($orgInfo['intent']))): ?><label class="checkbox-inline">
              <input type="checkbox" id="" name="intent" value="<?php echo ($molds["mid"]); ?>" checked="true"><?php echo ($molds["name"]); ?>
            </label>
            <?php else: ?>
            <label class="checkbox-inline">
              <input type="checkbox" id="" name="intent" value="<?php echo ($molds["mid"]); ?>"><?php echo ($molds["name"]); ?>
            </label><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
          </div>
        </div>
        <button type="button" class="btn btn-primary"id="goto-info">修改</button>
      </form>
      <div class="panel">
      	<ul>
      	<?php if(is_array($apply)): $i = 0; $__LIST__ = $apply;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$apply): $mod = ($i % 2 );++$i;?><a href="<?php echo U('JobsInfo/index');?>&jid=<?php echo ($apply["jid"]); ?>"><?php echo ($apply["title"]); echo (date("m-d",$apply["ctime"])); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
      	</ul>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">修改LOGO</div>
        <div class="panel-body">
          <img src="<?php echo ($orgInfo["avatar"]); ?>" class="img-thumbnail center-block my-personimg" data-toggle="modal" data-target="#headimg" />
        </div>
      </div>
    </div>
  </div>
</div>
<!--./container-->
<!--上传头像用model框-->
<div class="modal fade" id="headimg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">修改头像</h4>
      </div>
      <div class="modal-body">
        <div class="center-block" id="swfwrapper">
                <p id="swfContainer">
                    本组件需要安装Flash Player后才可使用，请从
                    <a href="http://www.adobe.com/go/getflashplayer">这里</a>
                    下载安装。
                </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!--footer-->
<div class="container">
  <hr />
  <p class="text-center">梦海网络</p>
  <p class="my-info text-center"><a href="http://www.xiaomifengjob.com">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="http://www.xiaomifengjob.com">关于梦海网络</a>/<a href="http://www.xiaomifengjob.com">联系我们</a></p>
  <p class="copyright text-center">Copyright © 梦海网络 / 备案号：<a style="color:#000;" href="http://www.miitbeian.gov.cn/">鲁ICP备15023958号</a>/ 地址：烟台市红旗中路</p>
  <p class="hidden"><script src="http://s11.cnzz.com/z_stat.php?id=1255390287&web_id=1255390287" language="JavaScript"></script></p>
</div>
<!--./footer-->
<script type="text/javascript">
            swfobject.addDomLoadEvent(function () {
                var queryInfo = "";
                var swf = new fullAvatarEditor("/__GROUP__/swf/fullAvatarEditor.swf", "/__GROUP__/swf/expressInstall.swf", "swfContainer", {
                        id : "swf",
                        upload_url : "<?php echo U('AvatarUpload/upload');?>",
                        method : "post",
                        isShowUploadResultIcon : true,
                        src_url : "<?php echo ($orgInfo["avatar"]); ?>",
                        src_upload : 0
                    },function(msg){
                        switch(msg.code)
                        {

                    }}
                );
            });
</script>
<script type="text/javascript">
$("#goto-info").click(function(){
	//获取数据
	var info = getFromInput('#edit-info');
	var checkboxs = $("input[type='checkbox']");
	var intent = new Array();
	for(var i=0;i<checkboxs.length;i++){
		if(checkboxs.eq(i).is(":checked")){
			intent.push(checkboxs.eq(i).val());
		}
	}
	info.intent = intent;
  console.log(info.intent);
	//ajax
	$.ajax({
		url:'<?php echo U('OrgCenter/updateInfo');?>',
		data:info,
		type:"POST",
		success:function(data){
			alert(data.info);
      if(data.status == 1){
        location.href = '';
      }
		}
		});
});


</script>
</body>
</html>