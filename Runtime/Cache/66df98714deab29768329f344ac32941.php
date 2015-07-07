<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>小蜜蜂用户使用协议-梦海网络</title>
    <link rel="stylesheet" href="./__GROUP__/css/validationEngine.jquery.css" type="text/css" />
    <link href="/Public/xmf32.ico" type="image/x-icon" rel=icon />
<link href="/Public/xmf32.ico" type="image/x-icon" rel="shortcut icon" />

<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap-theme.min.css">

<script src="http://cdn.staticfile.org/jquery/1.11.1-rc2/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/__GROUP__/css/common.css">
<script src="/__GROUP__/js/common.js"></script>
    <script src="./__GROUP__/js/jquery.validationEngine-zh_CN.js" type="text/javascript" charset="utf-8"></script>
    <script src="./__GROUP__/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
    <style type="text/css">
    </style>
    <script>
    </script>
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
            <h1>用户协议<small></small></h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <pre>
                <h2 style="text-align:center;">小蜜蜂用户使用协议</h2>
    本协议服务条款(以下简称“服务条款”)是由用户(您)与烟台梦海网络有限公司(以下简称"小蜜蜂")就小蜜蜂提供的兼职招聘服务所订立的相关权利义务规范，本服务条款对您及小蜜蜂均具有法律效力。 

<strong>前言：</strong>小蜜蜂是一个网络兼职信息对接平台。小蜜蜂提供包括兼职/校园招聘信息浏览、发布和电子公告板等服务（以下称“小蜜蜂服务”）。小蜜蜂上的信息是由用户（主要为企业用户）自行发布，所有内容均由发布者对信息的真实性负责，小蜜蜂有义务对其真实性进行审核、监督。
 
<strong>1   定义</strong>
    用户，包含注册用户和非注册用户。注册用户是指通过 www.xiaomifengjob.com 完成全部注册程序后，使用小蜜蜂服务的用户。非注册用户指未进行注册，直接登录 www.xiaomifengjob.com 或通过其他网站或客户端进入 www.xiaomifengjob.com 使用小蜜蜂服务的用户。
<strong>2   用户协议的接受和修改</strong>
    用户应当在使用小蜜蜂服务之前认真阅读本协议全部内容。如用户对本协议有任何疑问的，应向小蜜蜂咨询。无论用户以任何方式使用小蜜蜂服务，包括但不限于发布信息，浏览信息，发布广告，均被认为用户已经阅读且接受本协议。无论用户是否在使用小蜜蜂服务之前认真阅读了本协议内容，只要用户使用小蜜蜂服务，则本协议即产生约束力，届时用户不应以未阅读本协议内容为由，主张本协议无效，或主张撤销本协议。
如遇国家法律法规变更或小蜜蜂产品和服务规则发生调整，小蜜蜂有权根据需要不时地修改本协议，并以网站公示的方式进行公示，如用户不同意相关变更内容，请停止使用小蜜蜂服务。如果用户继续享用服务，则视为无条件接受本协议条款的变动。
小蜜蜂拥有对本协议的最终解释权。
<strong>3   用户资格</strong>
    小蜜蜂的服务仅向18周岁以上有完全民事行为能力人提供。用户使用小蜜蜂服务时应确认为具备相应民事行为能力的自然人、法人或其他组织。若用户不具备前述主体资格，则用户及用户的监护人应承担因此导致的一切后果，且小蜜蜂有权注销用户的账户，并可向用户及用户监护人索偿。小蜜蜂有权单方面无理由禁止某一用户使用小蜜蜂服务。
<strong>4   用户账户</strong>
    用户完成注册程序时，小蜜蜂会向用户提供唯一编号的小蜜蜂账户，并由用户自行选择密码。小蜜蜂识别特定用户的方式是且只是用户使用特定账户和与之匹配的密码登录。故用户应保证账户和密码的安全，并对通过账户和密码实施的行为负责。对于他人使用任何手段获取用户账户及其密码登录小蜜蜂并实施任何的行为，小蜜蜂都视为用户本人的行为，用户不得以该登录非其本人所为为理由要求小蜜蜂为任何行为。除非有法律规定且征得小蜜蜂的同意，否则，用户账户和密码不得以任何方式转让、赠与或继承（与账户相关的财产权益除外）。
<strong>5   内容</strong>
    使用小蜜蜂服务前，用户应理解小蜜蜂提供的信息及论坛内的所有信息，包括其中包含的文字，图片，链接等（以下称“内容”）均由用户自行上传，并且承担全部责任，小蜜蜂不对信息的真实性，准确性，有效性和安全性负责，用户在交易中发生的任何纠纷与小蜜蜂无关。为了最大限度地保障用户的权益不被侵害，我们制定了“安全交易须知”和“认证用户权利声明”。用户必须保证自己拥有所提供的信息的版权，或获得他人授权，并保证该信息不侵犯到任何第三人的合法权益；如用户违反本条规定造成小蜜蜂被第三人索赔的，用户应全额承担小蜜蜂一切损失(包括但不限于各种赔偿费、诉讼代理费及为此支出的其它合理费用)。同时当用户向小蜜蜂提供内容时，用户即授予小蜜蜂永久性的、全球的、不可撤销的、免使用费的、可再次授权给他人的使用权。用户必须自行评估和承担在小蜜蜂上提供和使用内容而产生的一切风险、损失。 最后，小蜜蜂有权利单方面无理由删除任何免费信息，有权利暂停任何付费信息的发布直至用户提供相关证据证明该信息的真实性。
<strong>6   禁止</strong>
    用户应在适当的城市或分类内发布、浏览或使用信息，不应做出任何法律法规禁止的行为。对于违反国家规定的《互联网违禁信息》的内容，小蜜蜂一经发现，将立即删除。
用户使用小蜜蜂服务时，不得违背社会公共利益或公共道德，不得损害他人的合法权益，不得违反本协议及相关规则。如果违反前述承诺，用户应自行承担所有法律师后果，小蜜蜂不负任何连带责任。
用户违反本协议及相关规则时，小蜜蜂有权终止对用户提供的小蜜蜂服务，且无须征得用户同意或提前通知用户。
对于用户在小蜜蜂上的行为，小蜜蜂有权单方认定用户行为是否构成对本协议及相关规则的违反，并据此采取相应处理措施。
<strong>7   费用与服务</strong>
    小蜜蜂是个对大多数用户免费的分类信息网站，但针对小蜜蜂的特定服务收费。若用户所使用的服务需支付费用，用户有权决定是否使用并接受该收费服务。小蜜蜂上的收费服务以人民币计价，定价上可能随时调整。我们将以网站公告的方式，来通知用户收费政策的变更。小蜜蜂也可选择在促销或新服务推出时，暂时调整我们的服务收费，该调整于我们公布促销或新服务时开始生效。付费服务是在系统接收到用户的付款后才开始。请注意：付费服务功能一旦开始，用户不得以任何理由要求取消、终止服务或退款，若因个人行为（如:自行删除）或发布信息内容违反小蜜蜂公约（公约以付费实际发生时的公约为准）而被转移类目或被删除，小蜜蜂将不予退款。小蜜蜂因网站自身需要进行改版的，若涉及付费产品的实质性变化，包括但不限于产品取消、服务内容发生增加或减少、登载页面变更、发布城市变更的，小蜜蜂可提前终止服务并将客户已付款但未履行服务部分款项退还客户。此类情况不视为小蜜蜂违约。
<strong>8   账户余额</strong>
    小蜜蜂账户余额是小蜜蜂内部使用的现金账户，方便用户进行付费产品的购买，或者享受更多的优惠。用户可以使用充值的方式增加小蜜蜂账户的余额，同时小蜜蜂也会通过活动的方式奖励一定的现金到用户的小蜜蜂账户中。所有账户余额中的部分都仅限于在小蜜蜂内部进行使用，不能提现或退款。
<strong>9   侵权通知</strong>
    用户发现小蜜蜂上的任何内容不符合法律规定，不符合本用户协议规定，或不符合小蜜蜂公约的规定时，用户有权利和义务通过点击“举报”链接向小蜜蜂申述。 当用户确认自己的个人信息被盗用，或者用户的版权或者其他权利被侵害，请将此情况报告给小蜜蜂。我们接受在线提交举报（在首页跳入投诉建议并按要求提交信息）或书面邮寄方式举报，书面邮寄方式举报请邮寄到如下地址： 中国广州市广州大学城外环东路232号13栋A418，邮政编码：510006。请同时提供以下信息：
①　侵犯用户权利的信息的网址，编号或其他可以找到该信息的细节；
②　用户提供所述的版权或个人信息的合法拥有者的声明；
③　用户提供初步能证明侵权的证据；
④　用户的姓名，地址，电话号码和电子邮件等各类有效联系方式；
⑤　用户的签名。
小蜜蜂会在核实后，根据相应法规予以配合处理。小蜜蜂保留在用户提供的证据不尽充分详实或是难以与用户取得联系进一步核实时暂停处理侵权通知的权利。
<strong>10  免责</strong>
    鉴于小蜜蜂仅作为用户网上发布信息的网络平台提供者，并非信息的发布者，因此小蜜蜂无法保证其内容的真实性、准确性、有效性和安全性。用户应确认在使用小蜜蜂所提供的服务前，用户已经知晓，理解并认可此情况。用户在使用非小蜜蜂自行上传的内容时遭受的损失和其它一切后果由用户独自承担。 用户如因为浏览小蜜蜂的内容或第三方发布和上传的内容而因此遭受到任何损失，或与其他用户发生争议，就上述损失或争议或任何方面产生有关的索赔、要求、诉讼、损失和损害，用户同意免除小蜜蜂、烟台小蜜蜂有限公司及其关联公司、小蜜蜂的管理层、董事、代理人、关联公司、母公司、子公司和雇员的责任。 由于小蜜蜂上的大多数内容来自用户，小蜜蜂不保证这些信息和用户联络方式的准确性和有效性、以及所提供内容质量的安全性或合法性，用户同意不就其他用户发布的内容或所作所为追究小蜜蜂的责任。小蜜蜂对于用户由于使用小蜜蜂而造成的任何金钱、商誉、名誉的损失，或任何特殊的、间接的、或结果性的损失都不负任何责任。用户同意就用户自身行为之合法性单独承担责任。
<strong>11  隐私</strong>
    用户使用小蜜蜂提供的任何服务包括但不限于发布信息，浏览信息，发布广告等将导致用户的IP地址为小蜜蜂获得并在网页中显示作为用户的身份标识，同时小蜜蜂将可能根据法律法规的规定向第三方提供该IP地址，用户应对此表示知情并认可。
用户使用小蜜蜂服务、参加小蜜蜂活动、或访问小蜜蜂网页时，小蜜蜂自动接收并记录的用户浏览器传递给小蜜蜂服务器的数据。但使用小蜜蜂就意味着同意小蜜蜂将用户发帖时使用的IP地址显示出来作为身份标识，即用户IP地址不受本隐私权政策保护；用户在网络上公开的其他个人信息亦不受此保护；
    小蜜蜂不会向任何人出售或出借用户的个人信息，除非事先得到用户的许可；小蜜蜂亦不允许任何第三方以任何手段收集、编辑、出售、传播或披露用户的个人信息。任何用户如从事上述活动，一经发现，小蜜蜂将采取法律手段追究责任；
为服务用户的目的，小蜜蜂可能通过使用用户的个人信息，向用户提供服务，包括但不限于向用户发出产品和服务信息，或者与小蜜蜂合作伙伴共享信息以便他们向用户发送有关其产品和服务的信息。
用户的个人信息将在下述情况下部分或全部被披露：
①　经用户同意，向第三方披露；
②　如果用户是具备资格的知识产权投诉人并已提起投诉，应被投诉人要求而向被投诉人披露，以便双方处理可能的权利纠纷；
③　根据法律的有关规定，或者行政、司法机构的要求，向第三方或者行政、司法机构披露；
④　如果用户出现违反中国有关法律或者网站政策的情况而需要向第三方披露；
⑤　为提供用户所要求的产品和服务，而必须和第三方分享用户的个人信息；
⑥　其它小蜜蜂依据法律或者网站政策认为合适的披露；
⑦　在小蜜蜂上创建的某一分类信息交易中，如交易任何一方履行或部分履行了交易义务并提出信息披露请求的，小蜜蜂有权可以决定向该用户提供其交易对方的联络方式等必要信息，以促成交易的完成或纠纷的解决。
在使用小蜜蜂服务进行网上交易时，用户不可避免的要向交易对方或潜在的交易对方提供自己的个人信息，如联络方式或者邮政地址等。请用户妥善保护自己的个人信息，仅在必要的情形下向他人提供；若发生用户信息被泄露或盗用的情况，小蜜蜂也提供诸如自动系统举报删帖、客服电话等服务配合用户的信息安全保护工作。
“Cookies”是网站为了纪录客户所传送至客户电脑硬盘上的一小段资料。Cookies可以让网站记住某些关于客户的资讯，使客户在浏览网页的时候更为便利。就如同现今绝大多数的网站一样，小蜜蜂使用了Cookies技术以便让您有一个更为愉快的网络体验。如果不愿意接受Cookies的话，请使用网路浏览器中的选项，关闭接受Cookies的选项，或是将选项选择为在接收到Cookies的时候通知使用者。请点选浏览器中的“说明”选项以了解关于调整接受Cookies的方法。如果选择不接收Cookies，客户将可能无法享受网站上所提供的某些便利功能。通过小蜜蜂所设Cookies所取得的有关信息，将适用本政策；在小蜜蜂上发布广告的公司或个人通过广告在用户计算机上设定的Cookies，将按其自己的隐私权政策使用。
链接至其他网站，在赞助商广告或用户登录的信息中，或许会在小蜜蜂网站中提供链接至小蜜蜂以外的网站上。小蜜蜂将不为其他网站的隐私权保护规定负责。
<strong>12  争议的解决</strong>
    本协议的所有内容和条款均受中华人民共和国法律管辖。与小蜜蜂内容、服务相关的争议、小蜜蜂所有用户间的争议、网站与用户间的争议等全部相关争议均不可撤销地受小蜜蜂所有权和运营权所有者烟台小蜜蜂有限公司实际经营地所在地人民法院的管辖。用户自愿放弃选择以网络终端、服务器所在地、侵权行为所在地等其它地点作为相关管辖地的权利。本协议的规定是可分割的，如本协议的任何规定被裁定为无效或不可执行，该规定可被删除而其余条款继续有效并应予以执行。用户同意，在发生并购时，本协议和所有纳入的协议所确定的权利可由小蜜蜂自行酌情决定向第三方转让。小蜜蜂未就用户或其他方的违约行为采取行动并不等于小蜜蜂放弃就随后或类似的违约行为采取行动的权利。
<strong>13  通知与披露</strong>
    小蜜蜂提供服务有关的用户协议和服务条款的修改、服务的变更、收费政策的变更或其它重要事件的通告都会以网站发布的方式通知用户。


                </pre>
            </div>
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
        <!--end container-->
        <!--footer-->
        <div class="container">
  <hr />
  <p class="text-center">梦海网络</p>
  <p class="my-info text-center"><a href="http://www.xiaomifengjob.com">首页</a>/<a href="<?php echo U("Advice/index");?>">投诉建议</a>/<a href="http://www.xiaomifengjob.com">关于梦海网络</a>/<a href="http://www.xiaomifengjob.com">联系我们</a></p>
  <p class="copyright text-center">Copyright © 梦海网络 / 备案号：/ 地址：烟台市红旗中路</p>
  <p class="hidden"><script src="http://s11.cnzz.com/z_stat.php?id=1255390287&web_id=1255390287" language="JavaScript"></script></p>
</div>
        <!--end footer-->
</body>