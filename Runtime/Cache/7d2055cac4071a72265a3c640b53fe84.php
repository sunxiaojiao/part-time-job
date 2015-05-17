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
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=8d8574dfcfd097659736c026a6921ca5"></script>
    <style type="text/css">
    #banner {
        height: 200px;
        margin-bottom: 12px;
    }
    
    .my-explor {
        position: absolute;
        right: 20px;
    }
    
    .my-explor>.glyphicon {
        margin-right: 6px;
    }
    
    .my-partjob-address,
    .my-partjob-people,
    .my-partjob-money,
    .my-explor {
        position: absolute;
    }
    
    .my-partjob-people {
        left: 330px;
    }
    
    .my-partjob-money {
        left: 450px;
    }
    
    .my-partjob-address {
        left: 200px;
    }
    
    .my-select-address {
        display: inline-block;
    }
    
    .my-select-address>select {
        width: 130px;
        display: inline-block;
    }
    
    .my-zimu {
        display: block;
        padding: 4px 6px 4px 32px;
        margin-bottom: 6px;
    }
    
    .my-addr-list a {
        display: inline-block;
        padding: 4px 6px;
        margin: 1px 20px 20px;
        outline: 1px solid #EEE;
        cursor: pointer;
    }
    
    #map-container {
        height: 500px;
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
    <!--banner-->
    <div class="container" id="banner">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="/__GROUP__/images/1.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="/__GROUP__/images/1.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item">
                    <img src="/__GROUP__/images/1.jpg" alt="...">
                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!--container-->
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">选择地点</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <form action="" method="get" class="">
                            <div class="form-group">
                                <label for="username">选择地点：</label>
                                <div class="my-select-address">
                                    <select id="province" class="form-control" onchange='search(this)'>
                                        <option value=""><?php echo ($addr["province"]); ?></option>
                                    </select>
                                    <select id="city" class="form-control" onchange='search(this)'>
                                        <option value=""><?php echo ($addr["city"]); ?></option>
                                    </select>
                                    <select id="district" class="form-control" onchange='search(this)'>
                                        <option value=""><?php echo ($addr["area"]); ?></option>
                                    </select>
                                    <select id="biz_area" class="form-control"></select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" id="cityname" placeholder="搜索城市">
                            <span class="input-group-btn">
                              <button class="btn btn-default" id="city-search" type="button">搜索</button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </div>
                </div>
                <div id="map-container"></div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                按首字母进行查找
            </div>
            <ul class="list-group addr-list">
                <li class="list-group-item my-addr-list">
                    <span class="bg-primary my-zimu">烟台</span>
                    <ul>
                        <?php if(is_array($addr)): $i = 0; $__LIST__ = $addr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$addr): $mod = ($i % 2 );++$i;?><a data-aid="<?php echo ($addr["aid"]); ?>"><?php echo ($addr["area"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--./container-->
    <!--footer-->
    <div class="container">
  <hr />
  <p class="text-center">小蜜蜂兼职</p>
  <p class="my-info text-center"><a href="#">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="#">关于小蜜蜂</a>/<a href="#">联系我们</a></p>
  <p class="copyright text-center">Copyright ©小蜜蜂网络 / 备案号：ICP备13008243号-1 / 地址：烟台市红旗中路</p>
</div>
    <!--footer-end-->
    <script type="text/javascript">
    $(".addr-list a").click(function() {
        var aid = $(this).attr("data-aid");
        //ajax
        $.ajax({
            url: "<?php echo U('ChangeCity/ChangeCity');?>",
            data: {
                aid: aid
            },
            contentType: 'text/json',
            success: function(data) {
                alert(data.info);
                location.href = "<?php echo U('ChangeCity/index');?>";
            }
        });
    });
    </script>
    <script type="text/javascript">
    var district, polygons = [],
        citycode;
    var citySelect = document.getElementById('city');
    var districtSelect = document.getElementById('district');
    var areaSelect = document.getElementById('biz_area');

    var map = new AMap.Map('map-container', {
        view: new AMap.View2D({
            zoom: 13
        })
    });
    //工具条控件
    map.plugin(["AMap.ToolBar"], function() {
        toolBar = new AMap.ToolBar();
        map.addControl(toolBar);
    });
    var provinceList = ['北京市', '天津市', '河北省', '山西省', '内蒙古自治区', '辽宁省', '吉林省', '黑龙江省', '上海市', '江苏省', '浙江省', '安徽省', '福建省', '江西省', '山东省', '河南省', '湖北省', '湖南省', '广东省', '广西壮族自治区', '海南省', '重庆市', '四川省', '贵州省', '云南省', '西藏自治区', '陕西省', '甘肃省', '青海省', '宁夏回族自治区', '新疆维吾尔自治区', '台灣', '香港特别行政区', '澳门特别行政区'];
    var provinceSelect = document.getElementById('province');
    var content = '<option>--请选择--</option>';
    for (var i = 0, l = provinceList.length; i < l; i++) {
        content += '<option value="province">' + provinceList[i] + '</option>';
        provinceSelect.innerHTML = content;
    }

    //行政区划查询

    AMap.service(["AMap.DistrictSearch"], function() {
        var opts = {
            subdistrict: 1, //返回下一级行政区
            extensions: 'all', //返回行政区边界坐标组等具体信息
            level: 'city' //查询行政级别为 市
        };

        //实例化DistrictSearch
        district = new AMap.DistrictSearch(opts);
    });



    function getData(e) {
        var dList = e.districtList;
        for (var m = 0, ml = dList.length; m < ml; m++) {
            var data = e.districtList[m].level;
            var bounds = e.districtList[m].boundaries;
            //只绘制 区, 且 本级别行政区划是上一级区划的下级行政区
            if (data == "district" && dList[m].citycode === citycode) {
                if (bounds) {
                    for (var i = 0, l = bounds.length; i < l; i++) {
                        //生成行政区划polygon
                        var polygon = new AMap.Polygon({
                            map: map,
                            strokeWeight: 1,
                            strokeColor: '#CC66CC',
                            fillColor: '#CCF3FF',
                            fillOpacity: 0.7,
                            path: bounds[i]
                        });
                        polygons.push(polygon);
                    }
                    //清除地图上所有覆盖物
                    setTimeout(function() {
                        map.clearMap();
                    }, 1500);
                    map.setFitView(); //地图自适应
                }
            }

            var list = e.districtList || [],
                subList = [],
                level, nextLevel;
            if (list.length >= 1) {
                subList = list[0].districtList;
                level = list[0].level;
            }

            //清空下一级别的下拉列表
            if (level === 'province') {

                nextLevel = 'city';
                citySelect.innerHTML = '';
                districtSelect.innerHTML = '';
                areaSelect.innerHTML = '';
            } else if (level === 'city') {

                nextLevel = 'district';
                districtSelect.innerHTML = '';
                areaSelect.innerHTML = '';
            } else if (level === 'district') {

                nextLevel = 'biz_area';
                areaSelect.innerHTML = '';
            }

            if (subList) {
                var contentSub = '<option>--请选择--</option>';
                for (var i = 0, l = subList.length; i < l; i++) {
                    var name = subList[i].name;
                    var levelSub = subList[i].level;
                    var cityCode = subList[i].citycode;
                    contentSub += '<option value="' + levelSub + '|' + cityCode + '">' + name + '</option>';
                    document.querySelector('#' + levelSub).innerHTML = contentSub;
                }
            }
        }
    }

    function search(obj) {
        //清除地图上所有覆盖物
        for (var i = 0, l = polygons.length; i < l; i++) {
            polygons[i].setMap(null);
        }

        var option = obj[obj.options.selectedIndex];
        var arrTemp = option.value.split('|');
        var level = arrTemp[0]; //行政级别
        citycode = arrTemp[1]; // 城市编码
        var keyword = option.text; //关键字

        district.setLevel(level); //行政区级别
        //行政区查询
        district.search(keyword, function(status, result) {
            getData(result);
        });
    }
    </script>
</body>

</html>