<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>企业认证-小蜜蜂兼职</title>
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="/__GROUP__/css/webuploader.css">
    <script type="text/javascript" src="/__GROUP__/js/webuploader.min.js"></script>
    <style type="text/css">
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
        <div class="row">
            <div class="col-md-8">
                <form method="post" target="ajax-form" id="auth-form" enctype="multipart/form-data" action="<?php echo U("OrgAuth/uploadFile");?>">
                <?php if($org_error_info): ?><div class="alert alert-danger">
                    <p><?php echo ($org_error_info); ?></p>
                </div>
                <?php elseif($org_info.is_pass): ?>
                    <?php switch($org_info["is_pass"]): case "3": ?><div class="alert alert-warning">
                                <p>等待认证结果中...</p>
                            </div><?php break;?>
                        <?php case "1": ?><div class="alert alert-success">
                                <p>您已认证</p>
                            </div><?php break;?>
                        <?php case "2": ?><div class="alert alert-danger">
                            <p>您未通过认证</p>
                          </div><?php break;?>
                        <?php default: ?>
                        <div class="alert alert-danger">
                            <p>您还未认证</p>
                        </div><?php endswitch;?>
                    <?php else: endif; ?>
                    <div class="form-group">
                        <label><span class="must-input">*</span>机构名称：</label>
                        <input class="form-control" disabled="true" value="<?php echo ($org_info["orgname"]); ?>" />
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>执照编号：</label>
                        <input class="form-control"  name="license_num" value="<?php echo ($org_info["license_num"]); ?>" />
                    </div>
                    <div class="form-group">
                        <label for=""><span class="must-input">*</span>营业执照照片：</label>
                        <p>营业执照照片，图片格式仅限jpg、jpeg、png、gif,且大小不超过2M</p>
                        <div class="rows clearfix">
                            <div class="col-md-6" id="orgphoto-select">
                            </div>
                            <input type="text" value="" name="oimg" class="hidden" />
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary" id="orgphoto-goto">上传</button>
                            </div>
                            <div class="col-md-3" id="orgphoto-info"></div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>所属行业：</label>
                        <?php if($org_info["industry"] != null): ?><p class="well well-sm"><?php echo ($org_info["industry"]); ?></p>
                        <?php else: ?>
                        <select class="form-control" name="industry">
                            <option value="">请选择...</option>
                            <?php if(is_array($indlist)): $i = 0; $__LIST__ = $indlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><option value="<?php echo ($list["ind_id"]); ?>"><?php echo ($list["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>机构性质：</label>
                        <?php if($org_info["nature"] != null): ?><p class="well well-sm"><?php echo ($org_info["nature"]); ?></p>
                        <?php else: ?>
                        <select class="form-control" name="nature">
                            <option value="">请选择...</option> 
                            <option>国有企业</option>
                            <option>私营企业</option>
                            <option>中外合资企业</option>
                            <option>个体户</option>
                            <option>外资企业</option>
                            <option>事业单位</option>
                            <option>集体企业</option>
                            <option>股份制公司</option>
                            <option>其他</option>

                        </select><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>机构规模：</label>
                        <?php if($org_info["size"] != null): ?><p class="well well-sm"><?php echo ($org_info["size"]); ?></p>
                        <?php else: ?>
                        <select class="form-control" name="size">
                            <option value="">请选择...</option>
                            <option>20以下</option>
                            <option>20-50</option>
                            <option>50-100</option>
                            <option>100-300</option>
                            <option>300-500</option>
                            <option>500以上</option>
                        </select><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>法人或负责人姓名：</label>
                        <input class="form-control" name="contact" value="<?php echo ($org_info["contact"]); ?>" />
                    </div>
                    <div class="form-group">
                        <label for=""><span class="must-input">*</span>身份证号码：</label>
                        <input type="text" name="idnum" class="form-control" placeholder="身份证号码" value="<?php echo ($org_info["idcard_num"]); ?>" />
                    </div>   
                    <div class="form-group">
                        <label for=""><span class="must-input">*</span>身份证正面和反面照片：</label>
                        <p>法人或负责人的身份证正反面照片，图片格式仅限jpg、jpeg、png、gif,且大小不超过2M</p>
                        <div class="rows clearfix">
                        <div class="col-md-3" id="idcard-select1">
                            
                        </div>
                        <input type="text" value="" name="iimg1" class="hidden" />
                        <div class="col-md-3" id="idcard-select2">
                            
                        </div>
                        <input type="text" value="" name="iimg2" class="hidden" />
                        <div class="col-md-3"><button class="btn btn-primary" id="idcard-goto" type="button">上传</button></div>
                        <div class="col-md-3" id="idcard-info"></div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label><span class="must-input">*</span>联系电话：</label>
                        <input class="form-control" name="phone" value="<?php echo ($org_info["phone"]); ?>" />
                    </div>
                    <?php if($isApply): ?><button type="button" class="btn btn-primary" id="goto-submit" disabled>提交</button>
                    <?php else: ?>
                    <button type="button" class="btn btn-primary" id="goto-submit">提交</button><?php endif; ?>
                </form>
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
    $("#goto-submit").on('click', function() {
        var info = getFromInput("#auth-form");
        console.log(info);
        $.ajax({
            url: "<?php echo U('OrgAuth/auth');?>",
            data: info,
            type: "POST",
            success: function(data) {
                alert(data.info);
                if(data.data == 3){
                    location.href = '';
                }
            }
        });
    });
    var uploader = new WebUploader.create({
        auto: false,
        swf : "/__GROUP__/swf/Uploader.swf",
        server: "<?php echo U("OrgAuth/uploadFile");?>",
        pick: {id:"#orgphoto-select",
               innerHTML:"选择",
               multiple :true
               },
        accept: {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,png',
        mimeTypes: 'image/*'
        },
        formData:{
            keys:"oimg"
        }
        // fileSingleSizeLimit: 1024*2
    });
    var idcard_uploader1 = new WebUploader.create({
        auto: false,
        swf : "/__GROUP__/swf/Uploader.swf",
        server: "<?php echo U("OrgAuth/uploadFile");?>",
        pick: {id:"#idcard-select1",
               innerHTML:"正面",
               multiple :true
               },
        accept: {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,png',
        mimeTypes: 'image/*',
        },
        formData:{
            keys: 'iimg1'
        }
        //fileSingleSizeLimit: 1024*2
    });
    var idcard_uploader2 = new WebUploader.create({
        auto: false,
        swf : "/__GROUP__/swf/Uploader.swf",
        server: "<?php echo U("OrgAuth/uploadFile");?>",
        pick: {id:"#idcard-select2",
               innerHTML:"反面",
               multiple :true
               },
        accept: {
        title: 'Images',
        extensions: 'gif,jpg,jpeg,png',
        mimeTypes: 'image/*',
        },
        formData:{
            keys: 'iimg2'
        }
        //fileSingleSizeLimit: 1024*2
    });
$("#orgphoto-goto").on('click',function(){
    uploader.upload();
    });
$("#idcard-goto").on('click',function(){
    idcard_uploader1.upload();
    idcard_uploader2.upload();
});

uploader.on( 'fileQueued', function( file ) {
    $("#orgphoto-select>div.webuploader-pick").text('已选择');
    $("#orgphoto-info").text(file.name + "  等待上传...");
});
uploader.on( 'uploadSuccess', function( file ,response) {
    $("#orgphoto-info").text(response.info);
    if(response.data ==1){
        $("#orgphoto-select+input").val("ok");
    }
});
uploader.on( 'uploadError', function( file ) {
    $("#orgphoto-info").text("上传失败");
});
idcard_uploader2.on( 'fileQueued', function( file ) {
    $("#idcard-select2>div.webuploader-pick").text('已选择');
    $("#idcard-info").text(file.name + "  等待上传...");
});
idcard_uploader1.on( 'fileQueued', function( file ) {
    $("#idcard-select1>div.webuploader-pick").text('已选择');
    $("#idcard-info").text(file.name + "  等待上传...");
});
idcard_uploader2.on( 'uploadSuccess', function( file ,response) {
    $("#idcard-info").text(response.info);
    if(response.data ==1){
        $("#idcard-select1+input").val("ok");
    }
});
idcard_uploader1.on( 'uploadSuccess', function( file ,response) {
    $("#idcard-info").text(response.info);
    if(response.data ==1){
        $("#idcard-select2+input").val("ok");
    }
});
idcard_uploader2.on( 'uploadError', function( file ) {
    $("#idcard-info").text("上传失败");
});
    </script>
</body>

</html>