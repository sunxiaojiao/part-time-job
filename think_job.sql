-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 18 日 10:09
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

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
  `aid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `province` varchar(12) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `city` varchar(12) NOT NULL,
  `area` varchar(12) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `xm_address`
--

INSERT INTO `xm_address` (`aid`, `province`, `city`, `area`) VALUES
(1, '山东', '烟台', '芝罘区'),
(2, '山东', '烟台', '开发区'),
(3, '山东', '烟台', '福山区'),
(4, '山东', '烟台', '莱山区'),
(5, '山东', '烟台', '牟平区');

-- --------------------------------------------------------

--
-- 表的结构 `xm_admin`
--

CREATE TABLE IF NOT EXISTS `xm_admin` (
  `admin_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
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
  `advice_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `oid` int(255) unsigned NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
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
  `app_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `app_oid` int(255) unsigned NOT NULL,
  `app_jid` int(255) unsigned NOT NULL COMMENT '兼职id',
  `app_uid` int(255) unsigned NOT NULL,
  `is_pass` int(3) unsigned NOT NULL DEFAULT '1' COMMENT '1为未处理，2为通过，3为拒绝',
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `xm_apply`
--

INSERT INTO `xm_apply` (`app_id`, `app_oid`, `app_jid`, `app_uid`, `is_pass`, `ctime`) VALUES
(9, 1, 1, 1, 2, 1428290640),
(10, 1, 21, 1, 3, 1428296660),
(11, 1, 2, 1, 2, 1428392044),
(12, 1, 30, 1, 2, 1428721994),
(13, 1, 31, 1, 1, 1429601803),
(14, 1, 34, 1, 1, 1430269748),
(15, 1, 43, 1, 1, 1430465734);

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
  `jid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '20字以内的标题',
  `detail` longtext NOT NULL,
  `mold_id` int(255) unsigned NOT NULL DEFAULT '11' COMMENT '类型',
  `is_pass` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '0为未处理，1为通过，2为拒绝',
  `pub_oid` int(255) unsigned NOT NULL COMMENT '发布组织',
  `money` varchar(20) NOT NULL COMMENT '20字的工资说明',
  `money_style` int(1) unsigned NOT NULL COMMENT '1为小时，2为天，3为每次',
  `work_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '工作时间长',
  `begin_time` int(10) unsigned NOT NULL COMMENT '开始时间',
  `want_peo` int(255) NOT NULL COMMENT '需要的人数',
  `peo_style` int(1) unsigned NOT NULL COMMENT '1为精确的，2为范围的',
  `current_peo` int(255) NOT NULL COMMENT '目前人数',
  `crowd_uids` mediumtext NOT NULL COMMENT '申请人的uid',
  `address` varchar(30) NOT NULL COMMENT '30字的工作地点说明',
  `addressname` varchar(40) NOT NULL COMMENT '地址字符串',
  `leader` varchar(10) NOT NULL COMMENT '负责人',
  `leader_phone` varchar(11) NOT NULL COMMENT '发布人电话',
  `expire_time` int(10) unsigned NOT NULL COMMENT '过期时间',
  `ctime` int(10) unsigned NOT NULL COMMENT '申请时间',
  `pv` int(255) unsigned NOT NULL COMMENT '浏览次数',
  PRIMARY KEY (`jid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- 转存表中的数据 `xm_jobs`
--

INSERT INTO `xm_jobs` (`jid`, `title`, `detail`, `mold_id`, `is_pass`, `pub_oid`, `money`, `money_style`, `work_time`, `begin_time`, `want_peo`, `peo_style`, `current_peo`, `crowd_uids`, `address`, `addressname`, `leader`, `leader_phone`, `expire_time`, `ctime`, `pv`) VALUES
(1, '发传单', '发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊', 3, 0, 1, '1000', 1, 100, 0, 1, 0, 0, '', '芝罘区', '', '1', '123456778', 1429720009, 1427243030, 8),
(2, '发传单', '发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊', 11, 0, 1, '1000', 0, 0, 0, 1, 0, 1, 'a:1:{i:0;s:1:"1";}', '芝罘区', '', '1', '0', 1429720009, 2015, 2),
(3, '发传单', '发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊', 11, 0, 1, '1000', 0, 0, 0, 1, 0, 0, '', '芝罘区', '', '1', '0', 1429720009, 2015, 0),
(4, '发传单', '发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊', 11, 0, 1, '1000', 0, 0, 0, 1, 0, 0, '', '芝罘区', '', '1', '0', 1429720009, 2015, 0),
(5, '发传单', '发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊', 11, 0, 1, '1000', 0, 0, 0, 1, 0, 0, '', '芝罘区', '', '1', '0', 1429720009, 2015, 1),
(6, '发传单', '贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告', 11, 0, 1, '1000', 0, 0, 0, 1, 0, 0, '', '芝罘区', '', '1', '0', 1429720009, 2015, 0),
(7, '', '', 11, 0, 0, '', 0, 0, 0, 0, 0, 0, '', '', '', '0', '0', 1429720009, 2015, 0),
(8, '', '', 11, 0, 0, '', 0, 0, 0, 0, 0, 0, '', '', '', '0', '0', 1429720009, 2015, 0),
(9, '', '', 11, 0, 0, '', 0, 0, 0, 0, 0, 0, '', '', '', '0', '0', 1429720009, 2015, 0),
(10, '', '', 11, 0, 0, '', 0, 0, 0, 0, 0, 0, '', '', '', '0', '0', 1429720009, 2015, 0),
(11, '', '', 11, 0, 0, '', 0, 0, 0, 0, 0, 0, '', '', '', '0', '0', 1429720009, 2015, 0),
(12, '拉拉', '你好啊', 11, 0, 1, '100', 0, 0, 0, 10, 0, 0, '', '芝罘区', '', '1', '0', 1429720009, 0, 1),
(13, '拉拉', '你好啊', 11, 0, 0, '100', 0, 0, 0, 10, 0, 0, '', '芝罘区', '', '1', '0', 1429720009, 0, 0),
(14, '', '', 11, 0, 0, '', 0, 0, 0, 0, 0, 0, '', '', '', '0', '0', 1429720009, 2015, 0),
(15, '', '', 11, 0, 0, '', 0, 0, 0, 0, 0, 0, '', '', '', '0', '0', 1429720009, 2015, 0),
(16, '', '', 11, 0, 0, '', 0, 0, 0, 0, 0, 0, '', '', '', '0', '0', 1429720009, 2015, 0),
(17, '买水果', '买水果买水果买水果买水果买水果买水果买水果买水果买水果买水果', 11, 0, 1, '100', 0, 0, 0, 100, 0, 0, '', '买水果', '', '1', '0', 1429720009, 0, 0),
(18, '买水果', '买水果买水果买水果买水果买水果买水果买水果买水果买水果买水果', 11, 0, 1, '100', 0, 0, 0, 100, 0, 0, '', '买水果', '', '1', '0', 1429720009, 0, 1),
(19, '买水果', '买水果买水果买水果买水果买水果买水果买水果买水果买水果买水果', 11, 0, 1, '100', 0, 0, 0, 100, 0, 0, '', '买水果', '', '1', '0', 1429720009, 0, 1),
(20, '买水果', '买水果买水果买水果买水果买水果买水果买水果买水果买水果买水果', 11, 0, 1, '100', 0, 0, 0, 100, 0, 0, '', '买水果', '', '1', '0', 1429720009, 1427176868, 2),
(21, 'asdfasd', 'sdfadlaskd', 11, 0, 1, '2000', 0, 0, 0, 10, 0, 0, '', 'adfads', '', '2', '0', 1429720009, 1427614920, 4),
(22, '百度兼职', '百度兼职', 11, 0, 1, '10', 0, 0, 0, 10, 0, 0, '', '山东', '', '0', '0', 1429720009, 1427704862, 2),
(23, '百度兼职', '百度兼职', 11, 0, 1, '10', 0, 0, 0, 10, 0, 0, '', '山东', '', '0', '0', 1429720009, 1427707685, 1),
(24, '百度兼职', '百度兼职', 11, 0, 1, '10', 0, 0, 0, 10, 0, 0, '', '山东', '', '0', '0', 1429720009, 1427707749, 1),
(25, '百度兼职', '百度兼职', 11, 0, 1, '10', 0, 0, 0, 10, 0, 4, 'a:1:{i:0;s:1:"1";}', '山东', '', '0', '0', 1429720009, 1427707836, 3),
(26, 'kaishi', 'adflakdsjflaskjdflkjas', 11, 0, 1, '1111', 0, 0, 0, 222, 0, 0, '', '111', '', '0', '0', 1429720009, 1427712255, 4),
(27, 'ss', 'dsfasdf', 11, 0, 1, 'asd', 0, 0, 0, 1, 0, 0, '', 'sdf', '', '0', '0', 1429720009, 1428404874, 1),
(28, '阿呆发生的', '大法师的', 11, 0, 1, '阿道夫', 0, 0, 0, 12, 0, 0, '', '阿呆沙发', '', '0', '0', 1429720009, 1428405501, 2),
(29, 'adf', 'dadsfasdf', 11, 0, 1, 'adf', 0, 0, 0, 10, 0, 0, '', 'fasdf', '', '0', '0', 1429720009, 1428409516, 3),
(30, '兼职', '就是干活', 11, 1, 1, '100', 0, 0, 0, 10, 0, 1, 'a:1:{i:0;s:1:"1";}', '芝罘区', '', '孙小蛟', '2147483647', 1429720009, 1428719277, 3),
(31, '兼职', '阿呆沙发是大法师大法但是', 11, 0, 1, '10', 0, 0, 0, 1, 0, 0, '', '山东', '', '兼职', '', 1429720009, 1429601471, 58),
(32, 'aaaa', 'aaaa', 11, 0, 1, 'aaaa', 0, 0, 0, 0, 0, 0, '', 'aaaa', '', 'aaa', '', 1430269605, 1430269605, 0),
(33, 'aaaa', 'aaaa', 11, 0, 1, 'aaaa', 0, 0, 0, 0, 0, 0, '', 'aaaa', '', 'aaa', '', 1430269695, 1430269695, 0),
(34, 'aaaa', 'aaaa', 11, 0, 1, 'aaaa', 0, 0, 0, 0, 0, 0, '', 'aaaa', '', 'aaa', '', 1430269704, 1430269704, 2),
(35, '111', '介绍', 11, 0, 1, '1000', 0, 0, 2015, 10, 0, 0, '', '121.355924,37.516061', '', '11', '', 1430380399, 1430358799, 4),
(36, '测试', '结合扫', 11, 0, 1, '100', 1, 0, 2015, 10, 1, 0, '', '121.357984,37.511432', '', '孙小蛟', '', 1430374385, 1430359985, 0),
(37, '测试', '结合扫', 11, 0, 1, '100', 1, 0, 1430378100, 10, 1, 0, '', '121.357984,37.511432', '', '孙小蛟', '', 1430375801, 1430361401, 0),
(38, '测试', '结合扫', 11, 0, 1, '100', 1, 0, 1430378100, 10, 1, 0, '', '121.357984,37.511432', '', '孙小蛟', '', 1430375841, 1430361441, 0),
(39, '测试', '结合扫', 11, 0, 1, '100', 1, 0, 1430378100, 10, 1, 0, '', '121.357984,37.511432', '', '孙小蛟', '', 1430375898, 1430361498, 0),
(40, '测试2', '结合扫的', 11, 0, 1, '10', 1, 0, 1430361300, 10, 1, 0, '', '121.357984,37.514155', '芝罘区', '孙小蛟', '', 1430369180, 1430361980, 6),
(41, '测试三', '戒杀破', 11, 0, 1, '12', 1, 0, 1430154300, 1, 2, 0, '', '121.37927,37.512521', '', '伞形科', '', 1430424495, 1430410095, 5),
(42, 'sss', '结合扫', 11, 0, 1, '1', 1, 0, 1431395100, 10, 1, 0, '', '121.38545,37.541927', '121.38545,37.541927', '鹅鹅鹅', '', 1430428601, 1430410601, 2),
(43, '我是', '介绍', 11, 0, 1, '2', 2, 0, 1430774700, 1, 2, 0, '', '121.37721,37.516061', '烟台市芝罘区', '问问', '', 1430418176, 1430410976, 20);

-- --------------------------------------------------------

--
-- 表的结构 `xm_mailreg_url`
--

CREATE TABLE IF NOT EXISTS `xm_mailreg_url` (
  `reg_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `vld_code_value` varchar(10) NOT NULL COMMENT '验证字符',
  `vld_code_key` int(10) NOT NULL COMMENT '验证键',
  `ispass` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0为未通过，1未通过',
  `ctime` int(10) NOT NULL,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='邮箱验证链接' AUTO_INCREMENT=77 ;

--
-- 转存表中的数据 `xm_mailreg_url`
--

INSERT INTO `xm_mailreg_url` (`reg_id`, `email`, `vld_code_value`, `vld_code_key`, `ispass`, `ctime`) VALUES
(73, '1451583383@qq.com', 'XncOfrIe', 0, 0, 1430143334),
(74, '1451583383@qq.com', 'eis6pBHc', 0, 0, 1430189357),
(75, '1451583383@qq.com', '9dbCyecI', 0, 0, 1430825292),
(76, '1451583383@qq.com', 'rUJ0tUHA', 0, 0, 1430827155);

-- --------------------------------------------------------

--
-- 表的结构 `xm_mold`
--

CREATE TABLE IF NOT EXISTS `xm_mold` (
  `mid` int(255) unsigned NOT NULL AUTO_INCREMENT,
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
  `oid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `passwd` char(32) NOT NULL COMMENT '1-10位密码',
  `orgname` varchar(25) NOT NULL,
  `is_validate` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '是否通过营业执照验证，0为未认证，1为认证',
  `avatar` varchar(60) NOT NULL,
  `org_address` varchar(60) NOT NULL,
  `website` varchar(36) NOT NULL COMMENT '公司网址',
  `phone` varchar(20) NOT NULL COMMENT '公司客服电话',
  `fixed_phone` varchar(20) NOT NULL COMMENT '固定电话',
  `org_intro` mediumtext NOT NULL COMMENT '公司介绍',
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `xm_orgs`
--

INSERT INTO `xm_orgs` (`oid`, `email`, `passwd`, `orgname`, `is_validate`, `avatar`, `org_address`, `website`, `phone`, `fixed_phone`, `org_intro`, `ctime`) VALUES
(1, '123@qq.com', '21232f297a57a5a743894a0e4a801fc3', '百度', 1, '/Uploads/xm_1_20150420234949_796_HHR1TDKS.jpg', '芝罘区', 'http://www.baidu.com', '13256929238', '64449872', '百度（Nasdaq：BIDU）是全球最大的中文搜索引擎、最大的中文网站。2000年1月由李彦宏创立于北京中关村，致力于向人们提供“简单，可依赖”的信息获取方式。“百度”二字源于中国宋朝词人辛弃疾的《青玉案·元夕》词句“众里寻他千百度”，...', 1428928216),
(2, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(3, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(4, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(5, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(6, '', '062af77ea3850e6078c64c71ff142b2e', '', 0, '', '', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(7, '', '062af77ea3850e6078c64c71ff142b2e', 'sunxiaojiao', 0, '', 'sunxiajiao', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(8, 'sunxiaojiao001@sina.com', 'c5df4f4eabf1cbcfeb50fbbf97c5289f', '鲁东', 0, '', '鲁东大学', 'http://www.baidu.com', '13256929238', '', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 1428928216),
(9, '1451583383@qq.com', '81dc9bdb52d04dc20036dbd8313ed055', '蓝翔', 1, '', '济南', '', '', '', '', 1430207282);

-- --------------------------------------------------------

--
-- 表的结构 `xm_orgs_auth`
--

CREATE TABLE IF NOT EXISTS `xm_orgs_auth` (
  `auth_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `auth_oid` int(255) NOT NULL,
  `license_num` char(15) NOT NULL COMMENT '执照编号',
  `industry` int(255) unsigned NOT NULL COMMENT '企业类型',
  `nature` varchar(10) NOT NULL COMMENT '企业性质',
  `size` varchar(10) NOT NULL COMMENT '企业规模',
  `contact` varchar(10) NOT NULL COMMENT '联系人',
  `idcard_num` char(18) NOT NULL COMMENT '负责人身份证号码',
  `phone` varchar(20) NOT NULL COMMENT '公司客服电话',
  `is_pass` int(1) NOT NULL DEFAULT '3' COMMENT '3为未处理，1为通过，2为未通过',
  `license_img` varchar(255) NOT NULL,
  `idcard_img1` varchar(255) NOT NULL,
  `idcard_img2` varchar(255) NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
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
(5, 1, '123456789012345678901234567890123456789012345678901234567890', 1, 0),
(6, 1, '', 1, 1430464883),
(7, 1, '', 1, 1430464895),
(8, 1, '11', 1, 1430464986),
(9, 1, '11', 1, 1430465329),
(10, 1, '11', 1, 1430465348);

-- --------------------------------------------------------

--
-- 表的结构 `xm_users`
--

CREATE TABLE IF NOT EXISTS `xm_users` (
  `uid` int(255) NOT NULL AUTO_INCREMENT,
  `avatar` varchar(100) NOT NULL DEFAULT './Public/person.jpg' COMMENT '头像',
  `passwd` char(32) NOT NULL COMMENT '6-10位',
  `username` varchar(10) NOT NULL COMMENT '最多十个字符',
  `email` varchar(75) NOT NULL COMMENT 'email',
  `phone` char(11) NOT NULL COMMENT '11位的手机号',
  `qq` varchar(10) NOT NULL COMMENT '10位以内的qq号',
  `school` varchar(255) NOT NULL,
  `age` tinyint(150) NOT NULL,
  `sex` tinyint(3) NOT NULL COMMENT '2女 1男 3和空保密',
  `address` int(255) NOT NULL,
  `exp` longtext NOT NULL,
  `intent` varchar(255) NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='普通用户' AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `xm_users`
--

INSERT INTO `xm_users` (`uid`, `avatar`, `passwd`, `username`, `email`, `phone`, `qq`, `school`, `age`, `sex`, `address`, `exp`, `intent`, `ctime`) VALUES
(1, '/Uploads/xm_1_20150428220416_186_V1B1DIQS.jpg', '21232f297a57a5a743894a0e4a801fc3', '1451583383', '1451583383@qq.com', '13256929238', '962783114', '鲁东大学', 100, 1, 0, '干过兼职，干过保姆，干过小蜜', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:7;s:1:"8";}', 2015),
(2, './Public/person.jpg', 'c5df4f4eabf1cbcfeb50fbbf97c5289f', '孙小蛟', 'sunxiaojiao001@sina.com', '', '', '', 0, 0, 0, '', '', 2015),
(3, './Public/person.jpg', 'd41d8cd98f00b204e9800998ecf8427e', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, 0, '', '', 0),
(4, './Public/person.jpg', 'd41d8cd98f00b204e9800998ecf8427e', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, 0, '', '', 1430105164),
(5, './Public/person.jpg', '21232f297a57a5a743894a0e4a801fc3', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, 0, '', '', 1430189410),
(6, './Public/person.jpg', '21232f297a57a5a743894a0e4a801fc3', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, 0, '', '', 1430189802),
(7, './Public/person.jpg', 'c5df4f4eabf1cbcfeb50fbbf97c5289f', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, 0, '', '', 1430190007),
(8, './Public/person.jpg', 'd41d8cd98f00b204e9800998ecf8427e', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, 0, '', '', 1430202732),
(9, './Public/person.jpg', 'd41d8cd98f00b204e9800998ecf8427e', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, 0, '', '', 1430202800),
(10, './Public/person.jpg', 'd41d8cd98f00b204e9800998ecf8427e', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, 0, '', '', 1430202810),
(11, './Public/person.jpg', 'b59c67bf196a4758191e42f76670ceba', '孙小蛟', '1451583383@qq.com', '', '', '', 0, 0, 0, '', '', 1430204753);

-- --------------------------------------------------------

--
-- 表的结构 `xm_user_evalute`
--

CREATE TABLE IF NOT EXISTS `xm_user_evalute` (
  `eva_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `from_oid` int(255) unsigned NOT NULL,
  `to_uid` int(255) unsigned NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='工作进行的状态' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `xm_working`
--

INSERT INTO `xm_working` (`work_id`, `work_uid`, `work_jid`, `work_status`, `begin_time`, `end_time`, `is_pass`, `ctime`) VALUES
(1, 1, 1, 2, 1431594405, 1431594523, 1, 2015);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
