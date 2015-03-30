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
        <li class=""><a href="#">切换城市 [烟台]</a></li>
      </ul>

      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="输入关键词">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
      </form>

      <ul class="nav navbar-nav navbar-right">
      <?php $url = U("Index/index"); $logoutUrl = U("Logout/index"); $name = session("?username") ? session('username') : session('orgname'); $info = session("?uid") ? '<li><a href="index.php?m=OrgInfo">个人中心</a></li>' : '<li><a href="index.php?m=OrgInfo">个人中心</a></li>'; $dropdown = <<<THINK
      	<li class="dropdown">
          <a href="$url" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">$name<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            $info
            <li><a href="index.php?m=PublishJobs">发布兼职</a></li>
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
  <div class="row">
    <div class="page-header">
        <h1><small>发布新兼职</small></h1>
    </div>
    <div class="col-md-7">
      <form id="jobinfo">
        <div class="form-group">
          <label for="job-name">兼职标题：</label>
          <input class="form-control" name="title" placeholder="兼职标题"/>
        </div>
        <div class="form-group">
          <label for="job-consumer">联系人：</label>
          <input class="form-control" name="leader" placeholder="联系人"/>
        </div>
        <div class="form-group">
          <label for="jobn-tel">联系电话：</label>
          <input class="form-control" name="phone" placeholder="联系电话"/>
        </div>
        <div class="form-group">
          <label for="job-people">需求人数：</label>
          <input class="form-control" name="want_peo" placeholder="需求人数"/>
        </div>
        <div class="form-group">
          <label for="job-address">工作地点：</label>
          <input class="form-control" name="address" placeholder="工作地点"/>
        </div>
        <div class="form-group">
          <label for="job-much">工资范围：</label>
          <input class="form-control" name="money" placeholder="工资范围"/>
        </div>
        <div class="form-group">
          <label for="job-more">工作介绍：</label>
          <textarea class="form-control" rows="3" name="detail" placeholder="工作介绍"></textarea>
        </div>
        <button type="button" class="btn btn-primary pull-right" id="publish">提交</button>
      </form>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">关于小蜜蜂</div>
        <div class="panel-body">
          <img src="./__GROUP__/images/erweima.png" class="img-thumbnail center-block" />
        </div>
      </div>
    </div>
  </div>
</div>
<!--./container-->
<!--footer-->
<div class="container">
  <hr />
  <p class="text-center">小蜜蜂兼职</p>
  <p class="my-info text-center"><a href="#">首页</a>/<a href="#">申请入住</a>/<a href="#">关于小蜜蜂</a>/<a href="#">联系我们</a></p>
  <p class="copyright text-center">Copyright ©小蜜蜂网络 / 备案号：ICP备13008243号-1 / 地址：烟台市红旗中路</p>
</div>
<!--./footer-->
<script type="text/javascript">
/**
*返回一个对象，将表单中input的name值做属性名，value值做属性值。
*@param String form CSS selector
*@return Object
*/
function getFromInput(form){
  var  input_list = $(form + " input");
  var info = new Object();
  for(var i=0;i<input_list.length;i++){
    info[input_list.eq(i).attr("name")] = input_list.eq(i).val();
  }
  return info;
}

  $("#publish").click(function(){
    //获取数据
    var info = getFromInput("#jobinfo");
    info['detail'] = $("textarea[name='detail']").val();
    console.log(info);
    //ajax
    $.post(
      "<?php echo U('PublishJobs/insert');?>",
      info,
      function(data){
        if(data.status){
          alert("发布成功");
          location.href="<?php echo U('PublishJobs/index');?>";
        }else{
          alert(data.info);
        }
      }
      );
  });
</script>
</body>
</html>