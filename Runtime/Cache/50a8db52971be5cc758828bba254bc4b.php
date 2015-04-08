<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>兼职平台</title>

<link rel="stylesheet" href="./__GROUP__/css/bootstrap.min.css">
<link rel="stylesheet" href="./__GROUP__/css/bootstrap-theme.min.css">
<script src="./__GROUP__/js/jquery.min.js"></script>
<script src="./__GROUP__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./__GROUP__/js/common.js"></script>
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
      <?php $url = U("Index/index"); $logoutUrl = U("Logout/index"); $name = session("?username") ? session('username') : session('orgname'); $info = session("?uid") ? '<li><a href="index.php?m=UserCenter">个人中心</a></li>' : '<li><a href="index.php?m=OrgCenter">企业中心</a></li>'; $dropdown = <<<THINK
      	<li class="dropdown">
          <a href="$url" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">$name<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            $info
            <li><a href="index.php?m=PublishJobs">发布兼职</a></li>
            <li><a href="index.php">修改密码</a></li>
            <li class="divider"></li>
            <li><a href="$logoutUrl">注销</a></li>
          </ul>
        </li><!--/.dropdown-->
THINK;
 if(session('?uid')){ echo $dropdown; }elseif(session('?oid')){ echo $dropdown; }else{ echo "<li><a href=" . U('Register/index') . ">注册</a></li>
        	  <li><a href=" . U('Login/index') . ">登录</a></li>"; } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
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
          <button class="btn btn-primary"><a href="<?php echo U('OrgCenter/validate');?>">认证</a></button>
        </div>
        <div class="form-group">
          <label for="username">所在地：</label>
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
          <label for="phone">联系电话：</label>
          <input type="text" id="phone" name="phone" class="form-control" value="<?php echo ($orgInfo["phone"]); ?>" placeholder="填写联系电话" />
        </div>
        <div class="form-group">
          <label for="qq">公司网址：</label>
          <input type="text" id="website" name="website" class="form-control" value="<?php echo ($orgInfo["website"]); ?>" placeholder="公司网址" />
        </div>
          <div class="form-group">
            <label for="exp">公司或机构介绍:</label>
            <textarea class="form-control" rows="3" id="exp" name="org_intro" placeholder="简要介绍"><?php echo ($orgInfo["org_intro"]); ?></textarea>
          </div>
        <div class="form-group">
          <label for="intent">招聘意向:</label>
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
          <img src="<?php echo ($orgInfo["headlogo"]); ?>" class="img-thumbnail center-block my-personimg" data-toggle="modal" data-target="#headimg" />
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
                var swf = new fullAvatarEditor("./swf/fullAvatarEditor.swf", "./swf/expressInstall.swf", "swfContainer", {
                        id : "swf",
                        upload_url : "/upload.php?userid=999&username=looselive",
                        method : "post",
                        src_url : "./images/person.jpg",
                        src_upload : 2
                    },function(){

                    }
                );
                document.getElementById("upload").onclick=function(){
                    swf.call("upload");
                };
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
		url:'<?php echo U('OrgCenter/updateInfo');?>',
		data:info,
		type:"POST",
		success:function(data){
			alert(data.info);
      if(data.status == 1){
        location.href="<?php echo U('OrgCenter/editInfo');?>";
      }
		}
		});
});


</script>
</body>
</html>