<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>发布一个兼职-小蜜蜂job</title>
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/1.11.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
    <link href="/__GROUP__/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="/__GROUP__/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="/__GROUP__/js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
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
        cursor: pointer;
    }
    
    #swfwrapper {
        width: 630px;
    }
    
    div.expire {
        font: 18px/34px "";
        height: 34px;
    }
    
    .form-group div.form_datetime {
        padding-left: 15px;
    }
    #mapContainer{
      height:500px;
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
        <div class="row">
            <div class="page-header">
                <h1><small>发布新兼职</small></h1>
            </div>
            <div class="col-md-7">
                <div class="alert alert-success hidden" role="alert">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <p>不符合</p>
                </div>
                <form id="jobinfo" class="form-horizontal clearfix">
                    <div class="form-group">
                        <label for="job-name" class="col-sm-2 control-label">兼职标题：</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="title" placeholder="兼职标题" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style" class="col-sm-2 control-label">工作类型:</label>
                        <div class="col-sm-10">
                            <select name="style" class="form-control">
                                <option value="">请选择...</option>
                                <?php if(is_array($molds)): $i = 0; $__LIST__ = $molds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$molds): $mod = ($i % 2 );++$i;?><option value="<?php echo ($molds["mid"]); ?>"><?php echo ($molds["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="job-consumer" class="col-sm-2 control-label">联系人：</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="leader" placeholder="联系人" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jobn-tel" class="col-sm-2 control-label">联系电话：</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="phone" placeholder="联系电话" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="job-people" class="col-sm-2 control-label">需求人数：</label>
                        <div class="col-sm-4">
                            <input name="want_peo" class="form-control" placeholder="人数" />
                        </div>
                        <div class="col-sm-6">
                            <select name="p_s" id="" class="form-control">
                                <option value="">请选择类型...</option>
                                <option value="1">人数是精确的</option>
                                <option value="2">人数是在范围内的</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="job-address" class="col-sm-2 control-label">工作地点：</label>
                        <div class="col-sm-10">
                            <input type="text" id="address" class="hidden" name="address" />
                            <input class="form-control" id="addressname" name="addressname" placeholder="工作地点" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="job-much" class="col-sm-2 control-label">工资范围：</label>
                        <div class="col-sm-4">
                            <input name="money" class="form-control" placeholder="工资（数字）" />
                        </div>
                        <div class="col-sm-6">
                            <select name="m_s" class="form-control">
                                <option value="">请选择结算方式...</option>
                                <option value="1">每小时</option>
                                <option value="2">每天</option>
                                <option value="3">每次</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">付款方式：</label>
                        <div class="col-sm-10">
                            <select name="py" class="form-control">
                                <option value="">请选择</option>
                                <option value="1">支付宝</option>
                                <option value="2">银行卡</option>
                                <option value="3">现金</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">到岗时间：</label>
                        <div class="col-sm-10 input-group date form_datetime" id="begin_time">
                            <input name="begin_time" type="text" class="form-control" readonly="true" placeholder="到岗时间" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">工作时长：</label>
                        <div class="col-sm-10">
                            <select name="wt" class="form-control">
                                <option value="">请选择...</option>
                                <option value="1">1小时</option>
                                <option value="2">2小时</option>
                                <option value="3">3小时</option>
                                <option value="4">4小时</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="job-expire" class="col-sm-2 control-label">过期时间：</label>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="expire_time" class="form-control">
                                    <option value="">请选择...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">长期</option>
                                </select>
                            </div>
                            <div class="col-md-4 expire">天后过期</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">工作介绍：</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" name="detail" placeholder="工作介绍"></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary pull-right" id="publish">提交</button>
                </form>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
    <div class="panel-heading">梦海网络</div>
	<div class="panel-body">
		<img src="/__GROUP__/images/erweima.png" width="190" style="width:190px" class="img-thumbnail center-block" />
	</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">平台介绍</div>
	<div class="panel-body">
		<pre>&emsp;&emsp;小蜜蜂job烟台梦海网络打造的一款大学生生活服务平台，我们通过考察企业，附近兼职，互相评论，星级评价四大环节，为大学生校园工作保驾护航，打造安全靠谱的大学生生活服务平台。</pre>
	</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">公司介绍</div>
	<div class="panel-body">
		<pre>&emsp;&emsp;烟台梦海网络是由烟台大学生创办的新一代互联网公司，我们来自烟台各大高校，全部由90后组成，致力于打造全国大学生生活服务第一平台，我们会用饱满热情的态度服务广大大学生</pre>
	</div>
</div>
            </div>
        </div>
    </div>
    <!--modeal-->
    <div class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">选择地点</h4>
                </div>
                <div class="modal-body">
                    <div id="tip">
                        省：<select id='province' style="width:100px"  onchange='search(this)'></select>
                        市：<select id='city' style="width:100px"  onchange='search(this)'></select>
                        区：<select id='district' style="width:100px" onchange='search(this)'></select>
                        商圈：<select id='biz_area' style="width:100px"></select>
                    </div>
                    <div id="mapContainer"></div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">确认</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

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
        var allowAddress = new Array('烟台市','青岛');
    </script>
    <script type="text/javascript" src="/__GROUP__/js/map.js"></script>
    <script type="text/javascript">
    //Modal
    $("#addressname").on('focus',function(){
      $(".modal").modal('show');
    });
    $('.modal').on('hidden.bs.modal', function (e) {
        if(addressname){
            $("#address").val(address.x + "," +address.y);
            $("#addressname").val(addressname);  
        }
    })
    
    //时间控件
    $("#begin_time").datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        autoclose: true
    });
    $("#publish").click(function() {
        //获取数据
        var info = getFromInput("#jobinfo");
        info['detail'] = $("textarea[name='detail']").val();
        if(address.x && address.y){
          info.address = address.x + "," +address.y;
        }else if($("#address").val()){
          info.address = $("#address").val();
        }else{
          address = '';
        }
        info.addresscity = addresscity;
        console.log(info);
        //ajax
        $.ajax({
            url: "<?php echo U('PublishJobs/publish');?>",
            data: info,
            type: "POST",
            success: function(data) {
                if (data.data === 0) {
                    $(".alert>p").text(data.info);
                    $(".alert").removeClass("alert-danger").addClass("alert-success");
                    $(".alert").removeClass("hidden");
                    var url = "<?php echo U('PublishJobs/index');?>";
                    setTimeout(function() {
                        location.href = '';
                    }, 3000)

                } else {
                    $(".alert>p").text(data.info);
                    $(".alert").removeClass("alert-success").addClass("alert-danger");
                    $(".alert").removeClass("hidden");
                }
            },
            error: function() {
                $(".alert>p").text("发布失败，请检查网络状况是否良好，稍后再试");
                $(".alert").removeClass("alert-success").addClass("alert-danger");
                $(".alert").removeClass("hidden");
            }
        });
    });
    </script>
</body>

</html>