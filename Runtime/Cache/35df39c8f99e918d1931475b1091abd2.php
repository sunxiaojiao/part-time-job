<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>企业用户中心-小蜜蜂job</title>
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
       /* cursor: pointer;*/
    }
    
    #swfwrapper {
        width: 630px;
    }
    
    .d-markup {
        display: inline-block;
        padding: 4px 6px;
        background: #EEE;
        font: 18px/24px "微软雅黑,黑体";
        margin: 6px 2px;
    }
    
    .d-markup:hover {
        background: #DDD;
        color: #111;
    }
    
    td.table-field {
        width: 148px;
    }
    
    td.table-field+td {
        min-width: 100px;
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
            <h1><small><?php echo ($org_info["orgname"]); ?></small></h1>
            <?php if($org_error_info): echo ($org_error_info); endif; ?>
        </div>
        <div class="row">
            <div class="col-md-8">
                <?php if($org_info["email"] == ''): ?><div class="alert alert-danger"><a href="<?php echo U("AttachEmail/index");?>">你还未绑定邮箱，请立刻绑定邮箱，方便找回密码等业务</a></div><?php endif; ?>
                <!--基本信息-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        基本信息<a class="pull-right" href="<?php echo U('OrgCenter/editInfo');?>">更改信息</a>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <td class="table-field">公司资质：</td>
                            <td>
                                <?php if($org_info["is_validate"] == 1): ?>已验证
                                    <?php else: ?>未验证<?php endif; ?>
                            </td>
                            <td class="table-field">注册手机号：</td>
                            <td><?php echo ($org_info["login_phone"]); ?></td>
                           
                        </tr>
                        <tr>
                            <td class="table-field">邮箱：</td>
                            <td>
                            <?php if($org_info["email"] == ''): ?><a href="<?php echo U("AttachEmail/index");?>">绑定邮箱</a>
                            <?php else: ?>
                                <?php echo ($org_info["email"]); endif; ?>
                            </td>
                            <td>客服电话</td>
                            <td><?php echo ($org_info["phone"]); ?></td>
                        </tr>
                        </tr>
                        <td class="table-field">公司网址：</td>
                        <td><?php echo ($org_info["website"]); ?></td>
                        <td class="table-field">公司地址：</td>
                        <td><?php echo ($org_info["org_address"]); ?></td>
                        </tr>
                    </table>
                </div>
                <!--./基本信息-->
                <!--兼职申请列表-->
                <div class="panel panel-default ">
                    <div class="panel-heading">申请列表</div>
                    <div class="list-group">
                        <?php if(isset($apply_error_info)): ?><li class="list-group-item"><?php echo ($apply_error_info); ?></li>
                            <?php else: ?>
                            <?php if(is_array($apply_list)): $i = 0; $__LIST__ = $apply_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$applylist): $mod = ($i % 2 );++$i;?><li href="#" class="list-group-item"><a target="_blank" href="<?php echo U('UserInfo/index');?>?uid=<?php echo ($applylist["uid"]); ?>"><?php echo ($applylist["username"]); ?></a>申请了<a href="<?php echo U('JobsInfo/index');?>?jid=<?php echo ($applylist["jid"]); ?>"><?php echo ($applylist["title"]); ?></a><span class="btn-content"><button class="btn btn-success" data-app_id="<?php echo ($applylist["app_id"]); ?>" data-jid="<?php echo ($applylist["jid"]); ?>" data-uid="<?php echo ($applylist["uid"]); ?>">通过</button><button class="btn btn-danger" data-app_id="<?php echo ($applylist["app_id"]); ?>">拒绝</button></span></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                </div>
                <!--./兼职申请列表-->
                <!--进行中的兼职-->
                <div class="panel panel-default">
                    <div class="panel-heading">进行中的兼职</div>
                        <ul class="list-group">
                            <?php if($work_error_info): ?><li class="list-group-item"><?php echo ($work_error_info); ?></li>
                            <?php else: ?>
                            <?php if(is_array($work_info)): $i = 0; $__LIST__ = $work_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><a class="list-group-item" href="<?php echo U("OrgCenter/showIngJobDetail");?>?jid=<?php echo ($info["work_jid"]); ?>">
                                <?php echo ($info["title"]); ?><span class="pull-right badge"><?php echo (date('m/d h:i',$info["ctime"])); ?></span>
                            </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </ul>
                </div>
                <!--./进行中的兼职-->
                <!--发布的兼职列表-->
                <div class="panel panel-default">
                    <div class="panel-heading">发布的兼职</div>
                    <div class="list-group">
                        <?php if($pj_error_info): ?><li class="list-group-item"><?php echo ($pj_error_info); ?></li>
                        <?php else: ?>
                        <?php if(is_array($pj)): $i = 0; $__LIST__ = $pj;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><a href="<?php echo U("JobsInfo/index");?>?jid=<?php echo ($jobs["jid"]); ?>" target="_blank" class="list-group-item"><?php echo ($jobs["title"]); ?><span class="badge"><?php echo (date("m月d日 h:i",$jobs["ctime"])); ?></span><span class="badge"><?php echo ($jobs["current_peo"]); ?>/<?php echo ($jobs["want_peo"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                </div>
                <!--./发布的兼职列表-->
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="<?php echo ($org_info["avatar"]); ?>" class="img-thumbnail center-block my-personimg" data-toggle="modal" data-target="#headimg" />
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
  <p class="copyright text-center">Copyright © 梦海网络 / 备案号：<a style="color:#000;" href="http://www.miitbeian.gov.cn/">鲁ICP备15023958号</a>/ 地址：烟台市红旗中路</p>
  <p class="hidden"><script src="http://s11.cnzz.com/z_stat.php?id=1255390287&web_id=1255390287" language="JavaScript"></script></p>
</div>
        <script type="text/javascript">
        $(".panel button").click(function() {
            $info = new Object();
            $info.ispass = "no";
            if ($(this).attr("class") == 'btn btn-success') {
                $info['ispass'] = "yes";
                $info.uid = $(this).attr("data-uid");
                $info.app_id = $(this).attr("data-app_id");
                $info.jid = $(this).attr("data-jid");
            } else if ($(this).attr("class") == "btn btn-danger") {
                $info.app_id = $(this).attr("data-app_id");
            }
            console.log($info);
            //ajax
            $.ajax({
                url: "<?php echo U('OrgCenter/isPass');?>",
                data: $info,
                type: "GET",
                success: function(data) {
                    alert(data.info);
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
        <!--./footer-->
</body>

</html>