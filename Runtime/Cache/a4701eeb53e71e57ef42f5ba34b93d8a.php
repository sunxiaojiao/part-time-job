<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title><?php echo ($userinfo["username"]); ?>的简历-小蜜蜂job</title>

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
<script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=8d8574dfcfd097659736c026a6921ca5"></script>

<style type="text/css">
  .panel-body{position: relative;}
  .my-perinfo{margin-left:26px;}
  .my-perinfo>p>span{margin-right:18px;}
  .my-perimg{border:1px solid #EEE;}
  .my-select-address{}
  .my-select-address>select{width:auto;display: inline-block; width: 160px;}
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
      <h1><small>编辑个人简历<small>(<?php echo ($userinfo["username"]); ?>)</small></small></h1>
  </div>
  <div class="row">
    <div class="col-md-8">
    <div class="alert alert-success hidden" role="alert">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <p>不符合</p>
                </div>
      <form method="post" action="" id="edit-info">
        <div class="form-group">
          <label for="username"><span class="must-input">*</span>用户名：</label>
          <input type="text" id="username" name="username" value='<?php echo ($userinfo["username"]); ?>' class="form-control" placeholder="填写用户名" />
        </div>
        <div class="form-group">
          <label><span class="must-input">*</span>性别：</label>
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
          <label for="age"><span class="must-input">*</span>年龄：</label>
          <input type="text" id="age" name="age" value="<?php echo ($userinfo["age"]); ?>" class="form-control" placeholder="填写年龄" />
        </div>
        <div class="form-group">
          <label for="username"><span class="must-input">*</span>居住地：</label>
          <div class="my-select-address">
            <select name="province" id="province" class="form-control" onchange='search(this)'>
            </select>
            <select name="city" id="city" class="form-control" onchange='search(this)'>
              <option><?php echo ($arr_address["city"]); ?></option>
            </select>
            <select name="area" id="district" class="form-control" onchange='search(this)'>
              <option><?php echo ($arr_address["area"]); ?></option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="school"><span class="must-input">*</span>学校：</label>
          <input type="text" id="school" name="school" class="form-control" value="<?php echo ($userinfo["school"]); ?>" placeholder="填写所在学校" />
        </div>
        <div class="form-group">
          <label for="phone"><span class="must-input">*</span>联系电话（同注册手机号）：</label>
          <input type="text" id="phone" class="form-control" value="<?php echo ($userinfo["phone"]); ?>" disabled placeholder="填写联系电话" />
        </div>
        <div class="form-group">
          <label for="qq">QQ：</label>
          <input type="text" id="qq" name="qq" class="form-control" value="<?php echo ($userinfo["qq"]); ?>" placeholder="填写联系QQ" />
        </div>
          <div class="form-group">
            <label for="exp"><span class="must-input">*</span>基本介绍和工作经验:</label>
            <textarea class="form-control" rows="3" id="exp" name="exp" placeholder="填写个人的简介和工作经验"><?php echo ($userinfo["exp"]); ?></textarea>
          </div>
        <div class="form-group">
          <label for="intent"><span class="must-input">*</span>求职意向:</label>
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
        <button type="button" class="btn btn-primary"id="goto-info">修改并发布</button>
      </form>
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
  <p class="text-center">梦海网络</p>
  <p class="my-info text-center"><a href="http://www.xiaomifengjob.com">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="http://www.xiaomifengjob.com">关于梦海网络</a>/<a href="http://www.xiaomifengjob.com">联系我们</a></p>
  <p class="copyright text-center">Copyright © 梦海网络 / 备案号：/ 地址：烟台市红旗中路</p>
  <p class="hidden"><script src="http://s11.cnzz.com/z_stat.php?id=1255390287&web_id=1255390287" language="JavaScript"></script></p>
</div>
<!--./footer-->
<script type="text/javascript">
            swfobject.addDomLoadEvent(function () {
                var swf = new fullAvatarEditor("/__GROUP__/swf/fullAvatarEditor.swf", "/__GROUP__/swf/expressInstall.swf", "swfContainer", {
                        id : "swf",
                        upload_url : "<?php echo U('AvatarUpload/upload');?>",
                        method : "post",
                        isShowUploadResultIcon : true,
                        src_url : "<?php echo ($userinfo["avatar"]); ?>",
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
  $(".alert").addClass("hidden");
	//获取数据
	var info = getFromInput('#edit-info');
	var checkboxs = $("input[type='checkbox']");
	var intent = new Object();
	for(var i=0;i<checkboxs.length;i++){
		if(checkboxs.eq(i).is(":checked")){
			intent[i] = checkboxs.eq(i).val();
		}
	}
	info.intent = intent;
	//ajax
	$.ajax({
		url:'<?php echo U('UserCenter/updateInfo');?>',
		data:info,
		type:"POST",
		success:function(data){
      if(data.data ===1){
        $(".alert").removeClass("alert-danger").addClass("alert-success");
        setTimeout(function(){location.href = '';},1000);
      }else{
        $(".alert").removeClass("alert-success").addClass("alert-danger");
      }
			$(".alert>p").text(data.info);
      $(".alert").removeClass("hidden");
		}
		});
});
</script>

<script>
    var mapObj, district, polygons=[], citycode;
    var citySelect = document.getElementById('city');
    var districtSelect = document.getElementById('district');
    var areaSelect = document.getElementById('biz_area');;
    
    mapObj = new AMap.Map('mapContainer');

    var provinceList = ['北京市', '天津市', '河北省', '山西省', '内蒙古自治区', '辽宁省', '吉林省','黑龙江省', '上海市', '江苏省', '浙江省', '安徽省', '福建省', '江西省', '山东省','河南省', '湖北省', '湖南省', '广东省', '广西壮族自治区', '海南省', '重庆市','四川省', '贵州省', '云南省', '西藏自治区', '陕西省', '甘肃省', '青海省', '宁夏回族自治区', '新疆维吾尔自治区', '台灣', '香港特别行政区', '澳门特别行政区'];
    var provinceSelect = document.getElementById('province');
    var content = '<option><?php echo ($arr_address["province"]); ?></option>';
    for(var i =0, l = provinceList.length; i < l; i++){
      content += '<option>'+provinceList[i]+'</option>';
      provinceSelect.innerHTML = content;
    }
    
    //行政区划查询
       
    AMap.service(["AMap.DistrictSearch"], function() {
        var opts = {
            subdistrict: 1,   //返回下一级行政区
            extensions: 'all',  //返回行政区边界坐标组等具体信息
            level:'city'  //查询行政级别为 市
        };
    
        //实例化DistrictSearch
        district = new AMap.DistrictSearch(opts);
    });
    
    
    
    function getData(e){
        var dList = e.districtList;
          for(var m = 0,ml = dList.length; m < ml; m++){
            var data = e.districtList[m].level;
            var list = e.districtList || [],
                subList =[], level, nextLevel;
            if(list.length >= 1) {
              subList = list[0].districtList;
              level = list[0].level;
            }
    
            //清空下一级别的下拉列表
            if(level === 'province'){
              
              nextLevel = 'city';
              citySelect.innerHTML = '';
              districtSelect.innerHTML = '';
              //areaSelect.innerHTML = '';
            }else if(level === 'city'){
    
              nextLevel = 'district';
              districtSelect.innerHTML = '';
              //areaSelect.innerHTML = '';
            } else if(level === 'district') {
                
                nextLevel = 'biz_area';
                //areaSelect.innerHTML = '';
            }
    
            if(subList){
              var contentSub = '<option value="">--请选择--</option>';
              for(var i=0,l=subList.length; i<l; i++){
                var name = subList[i].name; 
                var levelSub = subList[i].level;
                var cityCode = subList[i].citycode;
                contentSub += '<option>'+name+'</option>';
                document.querySelector('#'+levelSub).innerHTML = contentSub;
              }
            }
          } 
    }
    function search(obj){
      var option = obj[obj.options.selectedIndex];
      var arrTemp = option.value.split('|');
      var level = arrTemp[0];//行政级别
      citycode = arrTemp[1];// 城市编码
      var keyword = option.text; //关键字
    
      district.setLevel(level); //行政区级别
      //行政区查询
      district.search(keyword, function(status, result){
        getData(result);
      }); 
    }  
</script>
</body>
</html>