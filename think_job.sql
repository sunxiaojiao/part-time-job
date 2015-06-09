-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 06 月 09 日 13:05
-- 服务器版本: 5.5.40
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `think_job`
--

-- --------------------------------------------------------

--
-- 表的结构 `xm_address`
--

CREATE TABLE IF NOT EXISTS `xm_address` (
  `aid` int(255) NOT NULL AUTO_INCREMENT,
  `province` varchar(12) NOT NULL,
  `city` varchar(12) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `xm_address`
--

INSERT INTO `xm_address` (`aid`, `province`, `city`) VALUES
(1, '山东省', '烟台市');

-- --------------------------------------------------------

--
-- 表的结构 `xm_admin`
--

CREATE TABLE IF NOT EXISTS `xm_admin` (
  `admin_id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `passwd` char(32) NOT NULL,
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `xm_admin`
--

INSERT INTO `xm_admin` (`admin_id`, `username`, `passwd`, `ctime`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1428755880);

-- --------------------------------------------------------

--
-- 表的结构 `xm_advice`
--

CREATE TABLE IF NOT EXISTS `xm_advice` (
  `advice_id` int(255) NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `uid` bigint(255) NOT NULL,
  `oid` int(255) NOT NULL,
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`advice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `xm_advice`
--

INSERT INTO `xm_advice` (`advice_id`, `content`, `uid`, `oid`, `ctime`) VALUES
(1, '&lt;p&gt;上的发达省份&lt;/p&gt;', 0, 0, 0),
(2, '&lt;p&gt;大嵩岛&lt;/p&gt;', 0, 0, 0),
(3, '&lt;p&gt;大嵩岛&lt;img src=&quot;https://ss2.bdstatic.com/lfoZeXSm1A5BphGlnYG/skin/485.jpg&quot; _src=&quot;https://ss2.bdstatic.com/lfoZeXSm1A5BphGlnYG/skin/485.jpg&quot;/&gt;&lt;/p&gt;', 0, 0, 0),
(4, '&lt;p&gt;dfsdfds&lt;/p&gt;', 0, 0, 0),
(5, '&lt;p&gt;&lt;img src=&quot;http://www.test.com/Public/Upload/20150517/14318671174009.jpg&quot; _src=&quot;http://www.test.com/Public/Upload/20150517/14318671174009.jpg&quot;/&gt;&lt;/p&gt;', 0, 0, 0),
(6, '&lt;p&gt;\r\n', 0, 0, 1431870199),
(7, '&lt;p&gt;eee&lt;/p&gt;', 0, 0, 1431909944),
(8, '&lt;p&gt;\n    &lt;br/&gt;\n&lt;/p&gt;&lt;sc<x>ript&gt;alert('''')&lt;/sc<x>ript&gt;', 0, 0, 1431910098),
(9, '&lt;p&gt;dfasdf&lt;br/&gt;&lt;/p&gt;', 0, 1, 1431911165);

-- --------------------------------------------------------

--
-- 表的结构 `xm_apply`
--

CREATE TABLE IF NOT EXISTS `xm_apply` (
  `app_id` bigint(255) NOT NULL AUTO_INCREMENT,
  `app_oid` int(255) NOT NULL,
  `app_jid` int(255) NOT NULL COMMENT '兼职id',
  `app_uid` int(255) NOT NULL,
  `is_pass` int(3) NOT NULL DEFAULT '1' COMMENT '1为未处理，2为通过，3为拒绝',
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `xm_apply`
--

INSERT INTO `xm_apply` (`app_id`, `app_oid`, `app_jid`, `app_uid`, `is_pass`, `ctime`) VALUES
(35, 1, 60, 1, 2, 1433738970),
(36, 1, 54, 1, 2, 1433778936),
(37, 1, 57, 1, 2, 1433780021),
(38, 1, 46, 1, 2, 1433781206);

-- --------------------------------------------------------

--
-- 表的结构 `xm_industry`
--

CREATE TABLE IF NOT EXISTS `xm_industry` (
  `ind_id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`ind_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

--
-- 转存表中的数据 `xm_industry`
--

INSERT INTO `xm_industry` (`ind_id`, `name`) VALUES
(1, '房地产'),
(2, '建筑'),
(3, '物业管理'),
(4, 'IT/互联网/网络'),
(5, '电子/半导体/电器/仪表'),
(6, '计算机软硬件'),
(7, '通信'),
(8, '服务业'),
(9, '贸易/物流'),
(10, '市场/策划/公关'),
(11, '销售贸易'),
(12, '保险'),
(13, '财务/审计/税务'),
(14, '证券/金融/投资/银行'),
(15, '技术工人'),
(16, '玩具礼品'),
(17, '家居用品'),
(18, '法律'),
(19, '办公文教'),
(20, '医药卫生'),
(21, '服务咨询'),
(22, '行政/后勤'),
(23, '经营管理'),
(24, '人力资源'),
(25, '广告'),
(26, '新闻/出版'),
(27, '艺术设计'),
(28, '影视/媒体'),
(29, '电力/能源'),
(30, '电子电工'),
(31, '石油化工'),
(32, '百货/零售'),
(33, '餐饮/旅游/娱乐'),
(34, '美容/健身'),
(35, '物流/交通/仓储'),
(36, '服装/纺织品'),
(37, '机械'),
(38, '汽车'),
(39, '其他行业'),
(40, '房地产'),
(41, '建筑'),
(42, '物业管理'),
(43, 'IT/互联网/网络'),
(44, '电子/半导体/电器/仪表'),
(45, '计算机软硬件'),
(46, '通信'),
(47, '服务业'),
(48, '贸易/物流'),
(49, '市场/策划/公关'),
(50, '销售贸易'),
(51, '保险'),
(52, '财务/审计/税务'),
(53, '证券/金融/投资/银行'),
(54, '技术工人'),
(55, '玩具礼品'),
(56, '家居用品'),
(57, '法律'),
(58, '办公文教'),
(59, '医药卫生'),
(60, '服务咨询'),
(61, '行政/后勤'),
(62, '经营管理'),
(63, '人力资源'),
(64, '广告'),
(65, '新闻/出版'),
(66, '艺术设计'),
(67, '影视/媒体'),
(68, '电力/能源'),
(69, '电子电工'),
(70, '石油化工'),
(71, '百货/零售'),
(72, '餐饮/旅游/娱乐'),
(73, '美容/健身'),
(74, '物流/交通/仓储'),
(75, '服装/纺织品'),
(76, '机械'),
(77, '汽车'),
(78, '其他行业');

-- --------------------------------------------------------

--
-- 表的结构 `xm_jobs`
--

CREATE TABLE IF NOT EXISTS `xm_jobs` (
  `jid` bigint(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '20字以内的标题',
  `detail` longtext NOT NULL,
  `mold_id` int(255) NOT NULL DEFAULT '11' COMMENT '类型',
  `is_pass` int(1) NOT NULL DEFAULT '0' COMMENT '0为未处理，1为通过，2为拒绝',
  `pub_oid` int(255) NOT NULL COMMENT '发布组织',
  `pay_way` int(1) NOT NULL DEFAULT '3' COMMENT '支付方式，1为支付宝，2为银行卡，3为现金',
  `money` int(255) NOT NULL COMMENT '20字的工资说明',
  `money_style` int(1) NOT NULL COMMENT '1为小时，2为天，3为每次',
  `work_time` int(10) NOT NULL DEFAULT '0' COMMENT '工作时间长',
  `begin_time` int(10) NOT NULL COMMENT '开始时间',
  `want_peo` int(255) NOT NULL COMMENT '需要的人数',
  `peo_style` int(1) NOT NULL COMMENT '1为精确的，2为范围的',
  `current_peo` int(255) NOT NULL COMMENT '目前人数',
  `address` varchar(30) NOT NULL COMMENT '精确的地址坐标（经纬度）',
  `city` varchar(20) NOT NULL COMMENT '城市字符串',
  `addressname` varchar(40) NOT NULL COMMENT '地址字符串',
  `leader` varchar(10) NOT NULL COMMENT '负责人',
  `leader_phone` varchar(11) NOT NULL COMMENT '发布人电话',
  `expire_time` int(10) NOT NULL COMMENT '过期时间',
  `ctime` int(10) NOT NULL COMMENT '申请时间',
  `pv` int(255) NOT NULL COMMENT '浏览次数',
  PRIMARY KEY (`jid`),
  KEY `city` (`city`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- 转存表中的数据 `xm_jobs`
--

INSERT INTO `xm_jobs` (`jid`, `title`, `detail`, `mold_id`, `is_pass`, `pub_oid`, `pay_way`, `money`, `money_style`, `work_time`, `begin_time`, `want_peo`, `peo_style`, `current_peo`, `address`, `city`, `addressname`, `leader`, `leader_phone`, `expire_time`, `ctime`, `pv`) VALUES
(37, '测试', '结合扫', 11, 0, 1, 3, 100, 1, 0, 1430378100, 10, 1, 0, '121.357984,37.511432', '烟台市', '', '孙小蛟', '', 1434465705, 1430361401, 1),
(38, '测试', '结合扫', 11, 0, 1, 3, 100, 1, 0, 1430378100, 10, 1, 0, '121.357984,37.511432', '烟台市', '', '孙小蛟', '', 1434465705, 1430361441, 1),
(39, '测试', '结合扫', 11, 0, 1, 3, 100, 1, 0, 1430378100, 10, 1, 0, '121.357984,37.511432', '烟台市', '', '孙小蛟', '', 1434465705, 1430361498, 1),
(40, '测试2', '结合扫的', 11, 0, 1, 3, 10, 1, 0, 1430361300, 10, 1, 0, '121.357984,37.514155', '烟台市', '芝罘区', '孙小蛟', '', 1434465705, 1430361980, 6),
(41, '测试三', '戒杀破', 11, 0, 1, 3, 12, 1, 0, 1430154300, 1, 2, 1, '121.37927,37.512521', '烟台市', '', '伞形科', '', 1434465705, 1430410095, 6),
(42, 'sss', '结合扫', 11, 0, 1, 3, 1, 1, 0, 1431395100, 10, 1, 0, '121.38545,37.541927', '烟台市', '121.38545,37.541927', '鹅鹅鹅', '', 1434465705, 1430410601, 5),
(43, '我是', '介绍', 11, 0, 1, 1, 2, 2, 0, 1430774700, 1, 2, 0, '121.37721,37.516061', '烟台市', '烟台市芝罘区', '问问', '', 1434465705, 1430410976, 28),
(44, '111', 'asdfsdfsdfsdfsdf', 11, 0, 1, 1, 10, 1, 0, 1432086300, 1, 1, 0, '121.429834,37.4216', '烟台市', '烟台市芝罘区', '222', '', 1434465705, 1432169771, 2),
(45, '谁是谁', '阿瓦达芙洒洒的', 11, 0, 1, 2, 10, 1, 0, 1430790300, 10, 1, 0, '119.114465,36.718137', '烟台市', '潍坊市昌邑市', '111', '', 1434465705, 1432214087, 2),
(46, '趣味额', '打发打发', 11, 0, 1, 1, 1, 1, 0, 1430185500, 10, 1, 1, '121.193628,37.508801', '烟台市', '烟台市芝罘区', '趣味额', '', 1434465705, 1432310530, 2),
(47, '哦趣味额', '大法的事', 11, 0, 1, 2, 1, 1, 0, 1430790300, 19, 1, 0, '121.455412,37.474614', '烟台市', '烟台市莱山区', '撒旦', '', 1434465705, 1432310689, 1),
(48, '阿斯顿飞', '阿斯顿飞撒旦', 11, 0, 1, 2, 1, 1, 0, 1432100700, 1, 1, 0, '120.758467,37.815915', '烟台市', '烟台市蓬莱市', '阿道夫', '', 1434465705, 1432310784, 4),
(49, '阿斯顿飞', '阿斯顿飞撒旦', 11, 0, 1, 2, 1, 1, 0, 1432100700, 1, 1, 0, '120.758467,37.815915', '烟台市', '烟台市蓬莱市', '阿道夫', '', 1434465705, 1432310952, 0),
(50, '阿斯顿飞', '阿斯顿飞撒旦搜索', 11, 0, 1, 2, 1, 1, 0, 1432100700, 1, 1, 0, '120.758467,37.815915', '烟台市', '烟台市蓬莱市', '阿道夫', '', 1434465705, 1432310976, 3),
(51, '阿斯顿飞', '阿斯顿飞撒旦搜索', 11, 0, 1, 2, 1, 1, 0, 1432100700, 1, 1, 0, '120.758467,37.815915', '烟台市', '烟台市蓬莱市', '阿道夫', '', 1434465705, 1432311052, 2),
(52, '阿斯顿飞', '阿斯顿飞撒旦搜索', 11, 0, 1, 2, 1, 1, 0, 1432100700, 1, 1, 0, '120.758467,37.815915', '烟台市', '烟台市蓬莱市', '阿道夫', '', 1434465705, 1432311064, 2),
(53, '阿斯顿飞', '阿斯顿飞撒旦搜索', 11, 0, 1, 2, 1, 1, 0, 1432100700, 1, 1, 0, '120.758467,37.815915', '烟台市', '烟台市蓬莱市', '阿道夫', '', 1434465705, 1432311411, 2),
(54, '阿斯顿飞', '阿斯顿飞撒旦搜索', 6, 0, 1, 2, 1, 1, 0, 1432100700, 1, 1, 1, '120.758467,37.815915', '烟台市', '烟台市蓬莱市', '阿道夫', '', 1434465705, 1432311419, 2),
(55, '阿斯顿飞', '阿斯顿飞撒旦搜索', 1, 0, 1, 2, 1, 1, 0, 1432100700, 1, 1, 0, '120.758467,37.815915', '烟台市', '烟台市蓬莱市', '阿道夫', '', 1434465705, 1432311443, 5),
(56, '趣味额', '阿斯顿发大水', 2, 0, 1, 1, 10, 2, 0, 1431499800, 10, 2, 0, '120.519342,37.641586', '烟台市', '烟台市龙口市', '权威', '13256929238', 1434465705, 1432312549, 9),
(57, '发传单', '阿德所发生的', 1, 0, 1, 1, 10, 1, 0, 0, 10, 1, 1, '121.377489,37.548903', '烟台市', '烟台市芝罘区', '孙小蛟', '13256929238', 1434465705, 1433425811, 2),
(58, '1111', '', 11, 0, 1, 3, 0, 0, 0, 0, 0, 0, 0, '', '烟台市', '', '1111', '13256929238', 1434465705, 1433432671, 1),
(59, '111', '阿呆沙发第三方', 1, 0, 1, 2, 11, 3, 0, 1433370600, 1, 1, 0, '121.394987,37.486329', '烟台市', '烟台市芝罘区', '111', '13256929238', 1434465705, 1433434544, 1),
(60, '11', 'asdsadfasdaDS', 1, 0, 1, 1, 10, 1, 0, 1433477400, 10, 1, 9, '121.391897,37.540556', '烟台市', '烟台市芝罘区', '11111', '13256929238', 1434465705, 1433479700, 7);

-- --------------------------------------------------------

--
-- 表的结构 `xm_mailreg_url`
--

CREATE TABLE IF NOT EXISTS `xm_mailreg_url` (
  `reg_id` int(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `vld_code_value` varchar(10) NOT NULL COMMENT '验证字符',
  `vld_code_key` int(10) NOT NULL COMMENT '验证键',
  `ispass` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为未通过，1未通过',
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='邮箱验证链接' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `xm_mold`
--

CREATE TABLE IF NOT EXISTS `xm_mold` (
  `mid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `xm_mold`
--

INSERT INTO `xm_mold` (`mid`, `name`) VALUES
(1, '家教'),
(2, '促销员'),
(3, '服务生'),
(4, '发单员'),
(5, '礼仪'),
(6, '钟点工'),
(7, '会计'),
(8, '网站建设'),
(9, '翻译'),
(10, '设计制图'),
(11, '其他兼职');

-- --------------------------------------------------------

--
-- 表的结构 `xm_orgs`
--

CREATE TABLE IF NOT EXISTS `xm_orgs` (
  `oid` int(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `passwd` char(32) NOT NULL COMMENT '1-10位密码',
  `orgname` varchar(25) NOT NULL,
  `is_validate` tinyint(2) NOT NULL DEFAULT '1' COMMENT '是否通过营业执照验证，0为未认证，1为认证',
  `avatar` varchar(120) NOT NULL,
  `intent` varchar(1000) NOT NULL,
  `org_address` varchar(60) NOT NULL,
  `website` varchar(36) NOT NULL COMMENT '公司网址',
  `phone` varchar(20) NOT NULL COMMENT '公司客服电话',
  `fixed_phone` varchar(20) NOT NULL COMMENT '固定电话',
  `org_intro` mediumtext NOT NULL COMMENT '公司介绍',
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `xm_orgs`
--

INSERT INTO `xm_orgs` (`oid`, `email`, `passwd`, `orgname`, `is_validate`, `avatar`, `intent`, `org_address`, `website`, `phone`, `fixed_phone`, `org_intro`, `ctime`) VALUES
(1, '1451583383@qq.com', '21232f297a57a5a743894a0e4a801fc3', '百度', 1, '/Uploads/avatar/20150607/xm_1_20150607035704_581_E3SQZ3BI.jpg', 'a:4:{i:0;s:1:"2";i:1;s:1:"3";i:2;s:1:"4";i:3;s:2:"11";}', '区啊啊啊', 'http://www.baidu.com', '13256929238', '64449872', '阿斯顿发生的dasd11', 1428928216),
(2, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', '', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(3, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', '', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(4, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', '', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(5, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', '', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(6, '', '062af77ea3850e6078c64c71ff142b2e', '', 0, '', '', '', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(7, '', '062af77ea3850e6078c64c71ff142b2e', 'sunxiaojiao', 0, '', '', 'sunxiajiao', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(8, 'sunxiaojiao001@sina.com', 'c5df4f4eabf1cbcfeb50fbbf97c5289f', '鲁东', 0, '', '', '鲁东大学', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(9, '', '062af77ea3850e6078c64c71ff142b2e', '', 1, '', '', '', '', '13256929238', '', '', 1433309911),
(10, '', '062af77ea3850e6078c64c71ff142b2e', '', 1, '', '', '', '', '13256929238', '', '', 1433310335),
(11, '', 'b59c67bf196a4758191e42f76670ceba', '', 1, '', '', '', '', '12345678901', '', '', 1433310397),
(12, '', 'b59c67bf196a4758191e42f76670ceba', '', 1, '', '', '', '', '13256929322', '', '', 1433310441),
(13, '', 'b59c67bf196a4758191e42f76670ceba', '', 1, '', '', '', '', '1111111111', '', '', 1433310523),
(14, '', 'b0baee9d279d34fa1dfd71aadb908c3f', '', 1, '', '', '', '', '13256929238', '', '', 1433310696);

-- --------------------------------------------------------

--
-- 表的结构 `xm_orgs_auth`
--

CREATE TABLE IF NOT EXISTS `xm_orgs_auth` (
  `auth_id` int(255) NOT NULL AUTO_INCREMENT,
  `auth_oid` int(255) NOT NULL,
  `license_num` char(15) NOT NULL COMMENT '执照编号',
  `industry` int(255) NOT NULL COMMENT '企业类型',
  `nature` varchar(10) NOT NULL COMMENT '企业性质',
  `size` varchar(10) NOT NULL COMMENT '企业规模',
  `contact` varchar(10) NOT NULL COMMENT '联系人',
  `idcard_num` char(18) NOT NULL COMMENT '负责人身份证号码',
  `phone` varchar(20) NOT NULL COMMENT '公司客服电话',
  `is_pass` int(1) NOT NULL DEFAULT '3' COMMENT '3为未处理，1为通过，2为未通过',
  `license_img` varchar(255) NOT NULL,
  `idcard_img1` varchar(255) NOT NULL,
  `idcard_img2` varchar(255) NOT NULL,
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `xm_orgs_auth`
--

INSERT INTO `xm_orgs_auth` (`auth_id`, `auth_oid`, `license_num`, `industry`, `nature`, `size`, `contact`, `idcard_num`, `phone`, `is_pass`, `license_img`, `idcard_img1`, `idcard_img2`, `ctime`) VALUES
(5, 1, '1', 5, '私营企业', '50-100', 'sxj', '370782199412130838', '13256929238', 3, 'Uploads/auth/20150505/55489d242d240.png', 'Uploads/auth/20150505/55489d3f128eb.png', 'Uploads/auth/20150505/55489d3f17de2.png', 1430822211);

-- --------------------------------------------------------

--
-- 表的结构 `xm_org_evalute`
--

CREATE TABLE IF NOT EXISTS `xm_org_evalute` (
  `eva_id` int(255) NOT NULL AUTO_INCREMENT,
  `to_oid` int(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `from_uid` int(255) NOT NULL,
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`eva_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='公司评价' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `xm_org_evalute`
--

INSERT INTO `xm_org_evalute` (`eva_id`, `to_oid`, `content`, `from_uid`, `ctime`) VALUES
(1, 1, '', 1, 0),
(2, 1, '', 1, 0),
(3, 1, '纳尼好哈好哦ihaohaohoahaohaohoahohaohohohaohaohohoho  ', 1, 0),
(4, 1, '长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办长度太长怎么办', 1, 0),
(6, 1, '', 1, 1430464883),
(7, 1, '', 1, 1430464895),
(8, 1, '11', 1, 1430464986),
(9, 1, '11', 1, 1430465329),
(10, 1, '11', 1, 1430465348);

-- --------------------------------------------------------

--
-- 表的结构 `xm_passwd_find`
--

CREATE TABLE IF NOT EXISTS `xm_passwd_find` (
  `pfind_id` int(255) NOT NULL AUTO_INCREMENT,
  `pfind_code` varchar(20) NOT NULL,
  `pfind_email` varchar(20) NOT NULL,
  `pfind_utype` int(1) NOT NULL COMMENT '1user,2org',
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`pfind_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='密码找回表' AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `xm_passwd_find`
--

INSERT INTO `xm_passwd_find` (`pfind_id`, `pfind_code`, `pfind_email`, `pfind_utype`, `ctime`) VALUES
(2, 'jCCrpm6T', '1451583383@qq.com', 0, 1433163252),
(3, 'MUNbQGga', '1451583383@qq.com', 0, 1433163416),
(5, 'Q82J3kFR', '1451583383@qq.com', 0, 1433230772),
(8, 'XtkdKtXa', '1451583383@qq.com', 0, 1433232052),
(9, 'qzBHx0WU', '1451583383@qq.com', 0, 1433232144),
(10, 'rh2v05BD', '1451583383@qq.com', 0, 1433232180),
(11, 'JLgYN7eK', '1451583383@qq.com', 0, 1433233417),
(12, 'ThU687NZ', '1451583383@qq.com', 0, 1433233473),
(13, 'EJ83cz3a', '1451583383@qq.com', 0, 1433233520),
(14, 'WdP7XeI3', '1451583383@qq.com', 2, 1433233603),
(16, 'v91Es0Hk', '1451583383@qq.com', 2, 1433233984),
(19, 'hIvQX4Cc', '1451583383@qq.com', 2, 1433234838),
(20, '1phB0ywH', '1451583383@qq.com', 1, 1433235639);

-- --------------------------------------------------------

--
-- 表的结构 `xm_pay_way`
--

CREATE TABLE IF NOT EXISTS `xm_pay_way` (
  `pay_id` int(255) NOT NULL AUTO_INCREMENT,
  `pay_uid` int(255) NOT NULL,
  `pay_jid` int(255) NOT NULL,
  `pay_way` int(1) NOT NULL,
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付方式表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `xm_users`
--

CREATE TABLE IF NOT EXISTS `xm_users` (
  `uid` bigint(255) NOT NULL AUTO_INCREMENT,
  `avatar` varchar(100) NOT NULL DEFAULT '/Public/person.png' COMMENT '头像',
  `passwd` char(32) NOT NULL COMMENT '6-10位',
  `username` varchar(20) NOT NULL COMMENT '最多20个字符',
  `email` varchar(75) NOT NULL COMMENT 'email',
  `phone` char(11) NOT NULL COMMENT '11位的手机号',
  `qq` varchar(10) NOT NULL COMMENT '10位以内的qq号',
  `school` varchar(255) NOT NULL,
  `age` tinyint(150) NOT NULL,
  `sex` tinyint(3) NOT NULL COMMENT '2女 1男 3和空保密',
  `address` varchar(255) NOT NULL,
  `exp` longtext NOT NULL,
  `intent` varchar(255) NOT NULL,
  `default_payway` int(1) unsigned NOT NULL DEFAULT '3' COMMENT '默认的支付方式，1支付宝，2银行卡，3现金',
  `pay_alipay_id` varchar(21) NOT NULL COMMENT '支付宝账号',
  `pay_ccard_id` varchar(19) NOT NULL COMMENT '银行卡号',
  `ctime` int(10) unsigned NOT NULL,
  `apply_count` int(1) unsigned NOT NULL DEFAULT '3' COMMENT '可以申请的次数',
  `apply_time` int(10) unsigned NOT NULL COMMENT '最后一次申请的时间',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='普通用户' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `xm_users`
--

INSERT INTO `xm_users` (`uid`, `avatar`, `passwd`, `username`, `email`, `phone`, `qq`, `school`, `age`, `sex`, `address`, `exp`, `intent`, `default_payway`, `pay_alipay_id`, `pay_ccard_id`, `ctime`, `apply_count`, `apply_time`) VALUES
(1, '/Uploads/avatar/20150607/xm_1_20150607034852_237_PJ2IPN8Y.jpg', '21232f297a57a5a743894a0e4a801fc3', '1451583383', '', '13256929238', '962783114', '鲁东大学', 100, 1, 'a:3:{s:8:"province";s:9:"山东省";s:4:"city";s:9:"烟台市";s:4:"area";s:9:"芝罘区";}', '干过兼职，干过保姆，干过小蜜', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:7;s:1:"8";}', 2, '111111111111111', '6217002190002680333', 2015, 1, 1433781206),
(2, '/Public/person.png', 'c5df4f4eabf1cbcfeb50fbbf97c5289f', '孙小蛟', 'sunxiaojiao001@sina.com', '', '', '', 0, 0, '0', '', '', 3, '', '', 2015, 3, 0),
(3, '/Public/person.png', 'd41d8cd98f00b204e9800998ecf8427e', '孙小蛟', '', '', '', '', 0, 0, '0', '', '', 3, '', '', 0, 3, 0),
(4, '/Public/person.png', 'e00cf25ad42683b3df678c61f42c6bda', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, '0', '', '', 3, '', '', 1430105164, 3, 0),
(5, '/Public/person.png', '21232f297a57a5a743894a0e4a801fc3', '孙小蛟', '', '', '', '', 0, 0, '0', '', '', 3, '', '', 1430189410, 3, 0),
(6, '/Public/person.png', 'e00cf25ad42683b3df678c61f42c6bda', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, '0', '', '', 3, '', '', 1430189802, 3, 0),
(7, '/Public/person.png', 'e00cf25ad42683b3df678c61f42c6bda', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, '0', '', '', 3, '', '', 1430190007, 3, 0),
(8, '/Public/person.png', 'e00cf25ad42683b3df678c61f42c6bda', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, '0', '', '', 3, '', '', 1430202732, 3, 0),
(9, '/Public/person.png', 'e00cf25ad42683b3df678c61f42c6bda', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, '0', '', '', 3, '', '', 1430202800, 3, 0),
(10, '/Public/person.png', 'e00cf25ad42683b3df678c61f42c6bda', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, '0', '', '', 3, '', '', 1430202810, 3, 0),
(11, '/Public/person.png', 'e00cf25ad42683b3df678c61f42c6bda', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, '0', '', '', 3, '', '', 1430204753, 3, 0),
(12, '/Public/person.png', 'b59c67bf196a4758191e42f76670ceba', '', '', '13256929239', '', '', 0, 0, '0', '', '', 3, '', '', 1432789230, 3, 0),
(13, '/Public/person.png', '21232f297a57a5a743894a0e4a801fc3', '', '', '13245111111', '', '', 0, 0, '0', '', '', 3, '', '', 1432789937, 3, 0),
(14, '/Public/person.png', '21232f297a57a5a743894a0e4a801fc3', '', '', '13256922222', '', '', 0, 0, '0', '', '', 3, '', '', 1432789977, 3, 0),
(15, '/Public/person.png', '21232f297a57a5a743894a0e4a801fc3', '', '', '13211111111', '', '', 0, 0, '0', '', '', 3, '', '', 1432790158, 3, 0),
(16, '/Public/person.png', '96e79218965eb72c92a549dd5a330112', 'sxj', '', '13256999999', '', '', 0, 0, '0', '', '', 3, '', '', 1432796665, 3, 0),
(17, '/Public/person.png', 'b59c67bf196a4758191e42f76670ceba', 'sxj', '', '13256999991', '', '', 0, 0, '0', '', '', 3, '', '', 1432796747, 3, 0),
(18, '/Public/person.png', 'b59c67bf196a4758191e42f76670ceba', 'sxj', '', '13256999992', '', '', 0, 0, '0', '', '', 3, '', '', 1432796817, 3, 0),
(19, '/Public/person.png', '74b87337454200d4d33f80c4663dc5e5', 'aaaa', '', '13211112222', '11111', '鲁东大学', 19, 1, '0', 'ADSFASD', 'a:6:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";i:5;s:1:"6";}', 3, '', '', 1432796848, 3, 0),
(20, '/Public/person.png', 'c5df4f4eabf1cbcfeb50fbbf97c5289f', 'sunxiaojiao001', '', '13233333333', '', '', 10, 1, 'a:3:{s:8:"province";s:9:"天津市";s:4:"city";s:18:"天津市市辖区";s:4:"area";s:9:"河东区";}', '1111', 'a:1:{i:2;s:1:"3";}', 3, '', '', 1433384370, 3, 0),
(21, '/Public/person.png', '062af77ea3850e6078c64c71ff142b2e', 'sxj', '', '13256000000', '', '', 0, 0, '', '', '', 3, '', '', 1433824048, 3, 0);

-- --------------------------------------------------------

--
-- 表的结构 `xm_user_evalute`
--

CREATE TABLE IF NOT EXISTS `xm_user_evalute` (
  `eva_id` int(255) NOT NULL AUTO_INCREMENT,
  `from_oid` int(255) NOT NULL,
  `to_uid` bigint(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`eva_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='公司对普通用户的评价' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `xm_user_evalute`
--

INSERT INTO `xm_user_evalute` (`eva_id`, `from_oid`, `to_uid`, `content`, `ctime`) VALUES
(1, 0, 0, 'nihao', 0),
(2, 0, 0, 'ssss', 0),
(3, 1, 0, 'eeee', 0),
(4, 1, 1, 'www', 1430931279),
(5, 1, 1, '', 1430960969),
(6, 1, 1, '来了', 1431776975);

-- --------------------------------------------------------

--
-- 表的结构 `xm_working`
--

CREATE TABLE IF NOT EXISTS `xm_working` (
  `work_id` int(255) NOT NULL AUTO_INCREMENT,
  `work_uid` int(255) NOT NULL COMMENT '用户id',
  `work_jid` int(255) NOT NULL COMMENT '工作id',
  `work_status` int(1) NOT NULL DEFAULT '0' COMMENT '0为待做，1为正在进行，2为做完',
  `begin_time` int(10) NOT NULL COMMENT '开始时间',
  `end_time` int(10) NOT NULL COMMENT '结束时间',
  `is_pass` int(1) NOT NULL DEFAULT '2' COMMENT '0为未通过，1通过 ，2为等待审核',
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`work_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='工作进行的状态' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `xm_working`
--

INSERT INTO `xm_working` (`work_id`, `work_uid`, `work_jid`, `work_status`, `begin_time`, `end_time`, `is_pass`, `ctime`) VALUES
(2, 1, 60, 2, 1433777087, 1433777102, 2, 1433777066),
(3, 1, 54, 2, 1433778987, 1433778997, 1, 1433778954),
(4, 1, 57, 2, 1433780296, 1433781136, 0, 1433780083),
(5, 1, 46, 2, 1433781272, 1433781299, 1, 1433781261);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
