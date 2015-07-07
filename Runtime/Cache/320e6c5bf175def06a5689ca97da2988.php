<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo ($list["title"]); ?>-梦海网络</title>
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
    
    .form-group a.login {
        position: relative;
        top: 32px;
        left: 36px;
        font: 18px/18px "";
    }
    
    .orgname {
        padding-left: 10px;
        margin-bottom: 20px;
        font: 18px/18px "";
    }
    
    .vlded-color {
        color: #48C629;
    }
    
    .nvlded-color {
        color: #F00;
    }
    .tab-content{
      margin-top:20px;
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
            <!--left-->
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php if($job_error_info): ?><h3><?php echo ($job_error_info); ?></h3>
                            <?php else: ?>
                            <h3><?php echo ($list["title"]); ?></h3><?php endif; ?>
                        <div class="row">
                            <div class="col-md-3"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>&nbsp;<?php echo (date("m月d日 h:i",$list["ctime"])); ?>发布</div>
                            <div class="col-md-3"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp;<?php echo ($list["pv"]); ?>次浏览</div>
                            <div class="col-md-3"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span>&nbsp;<?php echo ($list["current_peo"]); ?>人已申请</div>
                            <div class="col-md-3"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span>&nbsp;<?php echo ($list["name"]); ?></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">详细信息</div>
                    <div class="panel-body">
                        <div class="orgname">
                            公司名称：<a href="<?php echo U("OrgInfo/index");?>?oid=<?php echo ($list["oid"]); ?>"><?php echo ($list["orgname"]); ?></a>
                            <?php if($list["is_validate"] == 0): ?><span class="glyphicon glyphicon-question-sign nvlded-color"></span><span class="nvlded-color">未认证</span>
                                <?php else: ?>
                                <span class="glyphicon glyphicon-ok-sign vlded-color"></span><span class="vlded-color">已认证</span><?php endif; ?>
                            <div class="bdsharebuttonbox" style="float:right;"><a href="#" class="bds_more" data-cmd="more"></a><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"#小蜜蜂的兼职分享#","bdMini":"2","bdMiniList":false,"bdPic":"http://test.xiaomifengjob.com/Public/xmf_share.png","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                        </div>
                        <!--基本信息-->
                        <div class="rows clearfix">
                            <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">工资待遇：<?php echo ($list["money"]); ?>
                                        <?php switch($list["money_style"]): case "1": ?>元每小时<?php break;?>
                                            <?php case "2": ?>元每天<?php break;?>
                                            <?php case "3": ?>元每次<?php break;?>
                                            <?php default: ?>元<?php endswitch;?></li>
                                        <li class="list-group-item">招聘人数：<?php echo ($list["want_peo"]); ?>
                                        <?php switch($list["peo_style"]): case "1": ?>个人<?php break;?>
                                            <?php case "2": ?>人左右<?php break;?>
                                            <?php default: ?>个人<?php endswitch;?></li>
                                        <li class="list-group-item">到岗时间：<?php echo (date("m月d日h:i",$list["begin_time"])); ?></li>
                                        <li class="list-group-item">工作时长：<?php echo ($list["work_time"]); ?>小时</li>
                                        <li class="list-group-item">联系人：<?php echo ($list["leader"]); ?><small>（联系我时，请说是在小蜜蜂上看到的）</small></li>
                                        <li class="list-group-item">联系电话：
                                        <?php if($a_tourist): echo ($a_tourist); ?>
                                        <?php else: ?>
                                            <img src="<?php echo U("JobsInfo/generatePhoneImage");?>" /><?php endif; ?>
                                        </li>
                                        <li class="list-group-item">
                                        结算方式：
                                        <?php switch($list["pay_way"]): case "1": ?>支付宝<?php break;?>
                                            <?php case "2": ?>银行卡<?php break;?>
                                            <?php case "3": ?>现金<?php break; endswitch;?></li>
                                        <li class="list-group-item">工作地址：<?php echo ($list["addressname"]); ?></li>
                            </ul>
                            </div>
                            <div class="col-md-6"><div id="mapContainer" style="width:100%;height:350px;" class="pull-right"></div></div>
                        </div>
                        <!--./基本信息-->
                        <button type="button" class="btn btn-primary btn-lg" id="goto-apply">申请此兼职</button>&nbsp;(同时投递简历)

                        <hr />
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">兼职详情</a></li>
                                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">公司介绍</a></li>
                                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">公司评价</a></li>
                                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">申请记录</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                  <?php echo ($list["detail"]); ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                  <?php echo ($list["org_intro"]); ?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="messages">
                                    <table class="table">
                                    <thead><td>名字</td><td>内容</td><td>时间</td></thead>
                                    <?php if($eval_error_info): ?><tr><td><?php echo ($eval_error_info); ?></td></tr>
                                    <?php else: ?>
                                        <?php if(is_array($eval_list)): $i = 0; $__LIST__ = $eval_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lists): $mod = ($i % 2 );++$i;?><tr>
                                            <td><?php echo ($lists["username"]); ?></td>
                                            <td><?php echo ($lists["content"]); ?></td>
                                            <td><?php echo (date("m/d",$lists["ctime"])); ?></td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    </table>
                                    <form class="">
                                        <?php if( session('?uid')): ?><div class="form-group">
                                                <label for="pingjia">评价:</label>
                                                <textarea class="form-control" rows="3" id="assess" name="assess-content" placeholder=""></textarea>
                                            </div>
                                            <button type="button" class="btn btn-default" id="assess-btn">评价</button>
                                            <?php else: ?>
                                            <div class="form-group">
                                                <label for="pingjia">评价:</label>
                                                <a class="login" href="<?php echo U('Login/index');?>">登录</a>
                                                <textarea class="form-control" rows="3" disabled="true" placeholder="">请先登录</textarea>
                                            </div>
                                            <button type="button" disabled="true" class="btn btn-default">评价</button><?php endif; ?>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="settings">
                                  <table class="table">
                                    <thead><td>申请人</td><td>申请时间</td><td>处理结果</td></thead>
                                    <?php if($apply_error_info): ?><tr><td><?php echo ($apply_error_info); ?></td></tr>
                                    <?php else: ?>
                                    <?php if(is_array($applylist)): $i = 0; $__LIST__ = $applylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$applylist): $mod = ($i % 2 );++$i;?><tr>
                                      <td><?php echo ($applylist["username"]); ?></td><td><?php echo (date("m月d日h点",$applylist["ctime"])); ?></td>
                                      <td>
                                      <?php switch($applylist["is_pass"]): case "1": ?>未处理<?php break;?>
                                      <?php case "2": ?><span class="vlded-color">通过</span><?php break;?>
                                      <?php case "3": ?><span class="nvlded-color">未通过</span><?php break; endswitch;?>
                                      </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                  </table>
                                </div>
                            </div>
                        </div>
                        <hr />
                    </div>
                </div>
            </div>
            <!--right-->
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
    <!--modal-->
    <div class="modal fade" id="m-payway">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">申请提示</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
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
    <!--/footer-->
    <script type="text/javascript">
    //申请
    $("#goto-apply").click(function() {
        $.ajax({
            url: "<?php echo U('ApplyJob/apply');?>",
            success: function(data) {
                var i = "<a href=\"<?php echo U("UserCenter/PayInfo");?>\" target=\"_blank\">去填写</a>";
                if(data.data == 1){
                    data.info += i;
                }else if(data.data ==4){
                    data.info += '<br /><small>(为了让您的申请可以被及时看到，请及时联系一下兼职的发布者)</small>';
                }
                $("#m-payway .modal-body").html(data.info);
                $("#m-payway").modal('show');
            },
            error:function(){
                $("#m-payway .modal-body").text("申请失败,请检查网络状况是否良好，稍后再试");
                $("#m-payway").modal('show');
            }
        });
    });
    </script>
    <script type="text/javascript">
    //加载地图
    (function(){
      var x= "<?php echo ($list["address"]["0"]); ?>",y = <?php echo (($list["address"]["1"])?($list["address"]["1"]):'true'); ?>;
      var map;
      if(y === true){
        (function(exprots){
          map = new AMap.Map('mapContainer',{
            view:new AMap.View2D({
              zoom: 13
            })
          });
        })(window);
        return;
      }
      
        (function(exprots){
          map = new AMap.Map('mapContainer',{
            view:new AMap.View2D({
              center: new AMap.LngLat(x,y),
              zoom: 15
            })
          });
        })(window);
        marker = new AMap.Marker({          
        icon:"http://webapi.amap.com/images/marker_sprite.png",
        position:new AMap.LngLat(x,y)
      });
      marker.setMap(map);  //在地图上添加点
    })();
    $("#assess-btn").on('click',function(){
        $.ajax({
            url: "<?php echo U("OrgEvalute/index");?>",
            data:{
                content:$("textarea[name='assess-content']").val()
            },
            type:"POST",
            success:function(data){
                alert(data.info);
                if(data.data == 1){
                    location.href = "";
                }
            }
        });
    });
    </script>
    <!--./footer-->
</body>

</html>