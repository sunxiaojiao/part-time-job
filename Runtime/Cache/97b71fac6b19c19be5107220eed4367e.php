<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>兼职平台</title>
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/1.11.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=8d8574dfcfd097659736c026a6921ca5"></script>
    <style type="text/css">
    .scroll-content {
        position: relative;
    }
    .panel-body {
        position: relative;
    }
    .list-group a.list-group-item {
        cursor: pointer;
    }
    .btn-content {
        position: absolute;
        right: 10px;
        margin-top: -8px;
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
            <a class="navbar-brand" href="/">小蜜蜂兼职</a>
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
                <?php if(session('?admin_id')): ?><!--dropdown-->
                    <li class="dropdown">
                        <a href="<?php echo U('Admin/index');?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo session('username');?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo U("Admin/index");?>">管理中心</a></li>
                            <li><a href="#">修改密码</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo U('Admin/logout');?>">注销</a></li>
                        </ul>
                    </li>
                    <!--/.dropdown-->
                    <?php else: ?>
                    <li><a href="<?php echo U('Register/index');?>">注册</a></li>
                    <li><a href="<?php echo U('Login/index');?>">登录</a></li><?php endif; ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<!--======导航条结束======--->

    <!--container-->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                				    <ul class="list-group nav">
                        <a class="list-group-item" href="__URL__/index.html">数据统计</a>
                        <a class="list-group-item" href="__URL__/publishApply.html">兼职申请列表</a>
                        <a class="list-group-item" href="__URL__/authApply.html">认证申请列表</a>
                        <a class="list-group-item" href="__URL__/orgsList.html">现有公司列表</a>
                        <a class="list-group-item" href="__URL__/showNowCity.html">管理业务城市</a>
                        <a class="list-group-item" href="__URL__/showMolds.html">管理兼职类型</a>
                        <a class="list-group-item" href="__URL__/showAdvice.html">投诉建议</a>
                    </ul>
            </div>
            <div class="col-md-9">
            <div class="panel panel-default">
                    <div class="panel-heading">
                        管理地址
                    </div>
                    <div class="panel-body">
                        <div class="form-group form-inline">
                            <label for="">新增城市</label>
                            <select class="form-control" id="province" onchange='search(this)'></select>
                            <select class="form-control" id="city" onchange='search(this)'></select>
                            <select class="hidden" id="district" onchange="search(this)"></select>
                            <button class="btn btn-success" id="btn-add">新增这个</button>
                        </div>
                        <hr />
                        <h3>管理现有业务城市</h3>
                        <div class="">
                        <?php if($address_error_info): echo ($address_error_info); ?>
                        <?php else: ?>
                            <ul class="list-group">
                            <?php if(is_array($address_info)): $i = 0; $__LIST__ = $address_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$address_info): $mod = ($i % 2 );++$i;?><li class="list-group-item"><?php echo ($address_info["province"]); ?>/<?php echo ($address_info["city"]); ?>
                                <button type="button" class="btn btn-danger pull-right btn-del" data-aid="<?php echo ($address_info["aid"]); ?>">删除</button><span class="badge"><?php echo (ftime($address_info["ctime"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul><?php endif; ?>
                        </div>
                        
                    </div>
                </div>
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
    (function(){
        var btn_del = $(".btn-del");
        var url     = "<?php echo U("Admin/cityHandler");?>";
        btn_del.on('click',function(){
            var aid = btn_del.attr('data-aid');
            var info = new Object();
            info.aid = aid;
            console.log(info);
            $.ajax({
                url:url,
                data:info,
                type:"POST",
                success:function(data){
                    location.href = "";
                    alert(data.info);
                },
                error:function(){
                    alert('网络错误，请重试');
                }
            });
        })    
    })();
    (function(){
        var btn_add  = $('#btn-add');
        var url      = "<?php echo U("Admin/cityHandler");?>"; 
        var province = $("#province");
        var city     = $("#city"); 
        btn_add.on('click',function(){
            var info = new Object();
            info.province = province.val();
            info.city     = city.val();
            console.log(info);
            $.ajax({
                url:url,
                data:info,
                type:"POST",
                success:function(data){
                    alert(data.info);
                    location.href = "";
                },
                error:function(){
                    alert('网络错误，请重试');
                }
            });
        });
    })();
    
    </script><script>
    var mapObj, district, polygons=[], citycode;
    var citySelect = document.getElementById('city');
    var districtSelect = document.getElementById('district');
    // var areaSelect = document.getElementById('biz_area');;
    
    mapObj = new AMap.Map('mapContainer');

    var provinceList = ['北京市', '天津市', '河北省', '山西省', '内蒙古自治区', '辽宁省', '吉林省','黑龙江省', '上海市', '江苏省', '浙江省', '安徽省', '福建省', '江西省', '山东省','河南省', '湖北省', '湖南省', '广东省', '广西壮族自治区', '海南省', '重庆市','四川省', '贵州省', '云南省', '西藏自治区', '陕西省', '甘肃省', '青海省', '宁夏回族自治区', '新疆维吾尔自治区', '台灣', '香港特别行政区', '澳门特别行政区'];
    var provinceSelect = document.getElementById('province');
    var content = '<option value="">--请选择--</option>';
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
              //districtSelect.innerHTML = '';
              //areaSelect.innerHTML = '';
            }else if(level === 'city'){
    
              nextLevel = 'district';
              //districtSelect.innerHTML = '';
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