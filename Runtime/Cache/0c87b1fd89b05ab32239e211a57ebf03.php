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
<script type="text/javascript" src="./__GROUP__/js/fullAvatarEditor.js"></script>
<script type="text/javascript" src="./__GROUP__/js/swfobject.js"></script>

<style type="text/css">
  .panel-body{position: relative;}
  .my-perinfo{margin-left:26px;}
  .my-perinfo>p>span{margin-right:18px;}
  .my-perimg{border:1px solid #EEE;}
  .my-select-address{}
  .my-select-address>select{width:auto;display: inline-block;}
  .my-personimg{width:200px; cursor: pointer;}
  #swfwrapper{width:630px;}

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
      <h1><small>完善个人信息<small>(<?php echo ($userinfo["email"]); ?>)</small></small></h1>
  </div>
  <div class="row">
    <div class="col-md-8">
    <!--
	@param usernmae
	sex
	age
	province
	city
	area
	school
	phone
	email
	qq
	exp
	intent
    -->
      <form method="post" action="" id="edit-info">
        <div class="form-group">
          <label for="username">用户名：</label>
          <input type="text" id="username" name="username" value='<?php echo ($userinfo["username"]); ?>' class="form-control" placeholder="填写用户名" />
        </div>
        <div class="form-group">
          <label>性别：</label>
          <select class="form-control" name="sex">
          	<?php if($userinfo["sex"] == 1): ?><option value="1" selected="true">男生</option>
            <option value="2">女生</option>
            <option value="3">保密</option>
            <?php elseif($userinfo["sex"] == 2): ?>
            <option value="1">男生</option>
            <option value="2" selected="true">女生</option>
            <option value="3">保密</option>
            <?php else: ?>
            <option value="1">男生</option>
            <option value="2">女生</option>
            <option value="3" selected="true">保密</option><?php endif; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="age">年龄：</label>
          <input type="text" id="age" name="age" value="<?php echo ($userinfo["age"]); ?>" class="form-control" placeholder="填写年龄" />
        </div>
        <div class="form-group">
          <label for="username">居住地：</label>
          <div class="my-select-address">
            <select name="province" id="" class="form-control">
              <option>山东</option>
            </select>
            <select name="city" id="" class="form-control">
              <option>烟台</option>
            </select>
            <select name="area" id="" class="form-control">
              <option>芝罘区</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="school">学校：</label>
          <input type="text" id="school" name="school" class="form-control" value="<?php echo ($userinfo["school"]); ?>" placeholder="填写所在学校" />
        </div>
        <div class="form-group">
          <label for="phone">联系电话：</label>
          <input type="text" id="phone" name="phone" class="form-control" value="<?php echo ($userinfo["phone"]); ?>" placeholder="填写联系电话" />
        </div>
        <div class="form-group">
          <label for="qq">QQ：</label>
          <input type="text" id="qq" name="qq" class="form-control" value="<?php echo ($userinfo["qq"]); ?>" placeholder="填写联系QQ" />
        </div>
          <div class="form-group">
            <label for="exp">基本介绍和工作经验:</label>
            <textarea class="form-control" rows="3" id="exp" name="exp" placeholder="填写个人的简介和工作经验"><?php echo ($userinfo["exp"]); ?></textarea>
          </div>
        <div class="form-group">
          <label for="intent">求职意向:</label>
          <div>
         <?php if(is_array($molds)): $i = 0; $__LIST__ = $molds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$molds): $mod = ($i % 2 );++$i; if(in_array($molds['mid'],unserialize($userinfo['intent']))): ?><label class="checkbox-inline">
              <input type="checkbox" id="" name="intent" value="<?php echo ($molds["mid"]); ?>" checked="true"><?php echo ($molds["name"]); ?>
            </label>
            <?php else: ?>
            <label class="checkbox-inline">
              <input type="checkbox" id="" name="intent" value="<?php echo ($molds["mid"]); ?>"><?php echo ($molds["name"]); ?>
            </label><?php endif; endforeach; endif; else: echo "" ;endif; ?>
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
        <div class="panel-body">
          <img src="<?php echo ($userinfo["avatar"]); ?>" class="img-thumbnail center-block my-personimg" data-toggle="modal" data-target="#headimg" />
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
  <p class="text-center">小蜜蜂兼职</p>
  <p class="my-info text-center"><a href="#">首页</a>/<a href="#">申请入住</a>/<a href="#">关于小蜜蜂</a>/<a href="#">联系我们</a></p>
  <p class="copyright text-center">Copyright ©小蜜蜂网络 / 备案号：ICP备13008243号-1 / 地址：烟台市红旗中路</p>
</div>
<!--./footer-->
<script type="text/javascript">
            swfobject.addDomLoadEvent(function () {
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
			intent[i] = checkboxs.eq(i).val();
		}
	}
	info.intent = intent;
	console.log(checkboxs);
	console.log(intent);
	console.log(info);
	//ajax
	$.ajax({
		url:'<?php echo U('UserCenter/updateInfo');?>',
		data:info,
		type:"POST",
		success:function(data){
			alert(data);
		}
		});
});


</script>
</body>
</html>