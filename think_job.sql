-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 04 月 05 日 12:57
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
-- 表的结构 `xm_apply`
--

CREATE TABLE IF NOT EXISTS `xm_apply` (
  `app_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `app_oid` int(255) unsigned NOT NULL,
  `app_jid` int(255) unsigned NOT NULL COMMENT '兼职id',
  `app_uid` int(255) unsigned NOT NULL,
  `is_pass` int(2) unsigned NOT NULL DEFAULT '1' COMMENT '是否通过申请',
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `xm_apply`
--

INSERT INTO `xm_apply` (`app_id`, `app_oid`, `app_jid`, `app_uid`, `is_pass`, `ctime`) VALUES
(1, 1, 0, 25, 1, 1427982544),
(2, 1, 25, 1, 1, 1427982580),
(3, 1, 22, 1, 1, 1427982801),
(4, 1, 19, 1, 1, 1428036122);

-- --------------------------------------------------------

--
-- 表的结构 `xm_jobs`
--

CREATE TABLE IF NOT EXISTS `xm_jobs` (
  `jid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '20字以内的标题',
  `detail` longtext NOT NULL,
  `apply` int(255) unsigned NOT NULL COMMENT '申请人',
  `pub_oid` int(255) unsigned NOT NULL COMMENT '发布组织',
  `money` varchar(20) NOT NULL COMMENT '20字的工资说明',
  `want_peo` int(255) NOT NULL COMMENT '需要的人数',
  `current_peo` int(255) NOT NULL COMMENT '目前人数',
  `crowd_uids` mediumblob NOT NULL COMMENT '申请人的uid',
  `address` varchar(30) NOT NULL COMMENT '30字的工作地点说明',
  `leader` int(255) NOT NULL COMMENT '负责人',
  `ctime` int(10) unsigned NOT NULL COMMENT '申请时间',
  `pv` int(255) NOT NULL COMMENT '浏览次数',
  PRIMARY KEY (`jid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `xm_jobs`
--

INSERT INTO `xm_jobs` (`jid`, `title`, `detail`, `apply`, `pub_oid`, `money`, `want_peo`, `current_peo`, `crowd_uids`, `address`, `leader`, `ctime`, `pv`) VALUES
(1, '发传单', '发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊', 1, 1, '1000', 1, 0, '', '芝罘区', 1, 1427243030, 0),
(2, '发传单', '发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊', 1, 1, '1000', 1, 0, '', '芝罘区', 1, 2015, 0),
(3, '发传单', '发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊', 1, 1, '1000', 1, 0, '', '芝罘区', 1, 2015, 0),
(4, '发传单', '发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊', 1, 1, '1000', 1, 0, '', '芝罘区', 1, 2015, 0),
(5, '发传单', '发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊发传单啊', 1, 1, '1000', 1, 0, '', '芝罘区', 1, 2015, 0),
(6, '发传单', '贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告贴小广告', 1, 1, '1000', 1, 0, '', '芝罘区', 1, 2015, 0),
(7, '', '', 0, 0, '', 0, 0, '', '', 0, 2015, 0),
(8, '', '', 0, 0, '', 0, 0, '', '', 0, 2015, 0),
(9, '', '', 0, 0, '', 0, 0, '', '', 0, 2015, 0),
(10, '', '', 0, 0, '', 0, 0, '', '', 0, 2015, 0),
(11, '', '', 0, 0, '', 0, 0, '', '', 0, 2015, 0),
(12, '拉拉', '你好啊', 0, 1, '100', 10, 0, '', '芝罘区', 1, 0, 0),
(13, '拉拉', '你好啊', 0, 0, '100', 10, 0, '', '芝罘区', 1, 0, 0),
(14, '', '', 0, 0, '', 0, 0, '', '', 0, 2015, 0),
(15, '', '', 0, 0, '', 0, 0, '', '', 0, 2015, 0),
(16, '', '', 0, 0, '', 0, 0, '', '', 0, 2015, 0),
(17, '买水果', '买水果买水果买水果买水果买水果买水果买水果买水果买水果买水果', 0, 1, '100', 100, 0, '', '买水果', 1, 0, 0),
(18, '买水果', '买水果买水果买水果买水果买水果买水果买水果买水果买水果买水果', 0, 1, '100', 100, 0, '', '买水果', 1, 0, 0),
(19, '买水果', '买水果买水果买水果买水果买水果买水果买水果买水果买水果买水果', 0, 1, '100', 100, 0, '', '买水果', 1, 0, 0),
(20, '买水果', '买水果买水果买水果买水果买水果买水果买水果买水果买水果买水果', 0, 1, '100', 100, 0, '', '买水果', 1, 1427176868, 0),
(21, 'asdfasd', 'sdfadlaskd', 0, 1, '2000', 10, 0, '', 'adfads', 2, 1427614920, 0),
(22, '百度兼职', '百度兼职', 0, 1, '10', 10, 0, '', '山东', 0, 1427704862, 0),
(23, '百度兼职', '百度兼职', 0, 1, '10', 10, 0, '', '山东', 0, 1427707685, 0),
(24, '百度兼职', '百度兼职', 0, 1, '10', 10, 0, '', '山东', 0, 1427707749, 0),
(25, '百度兼职', '百度兼职', 0, 1, '10', 10, 0, '', '山东', 0, 1427707836, 0),
(26, 'kaishi', 'adflakdsjflaskjdflkjas', 0, 1, '1111', 222, 0, '', '111', 0, 1427712255, 0);

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
  `is_validate` tinyint(2) unsigned NOT NULL COMMENT '是否通过营业执照验证',
  `headlogo` varchar(60) NOT NULL,
  `org_address` varchar(60) NOT NULL,
  `website` varchar(36) NOT NULL COMMENT '公司网址',
  `phone` varchar(20) NOT NULL COMMENT '公司客服电话',
  `org_intro` mediumtext NOT NULL COMMENT '公司介绍',
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `xm_orgs`
--

INSERT INTO `xm_orgs` (`oid`, `email`, `passwd`, `orgname`, `is_validate`, `headlogo`, `org_address`, `website`, `phone`, `org_intro`, `ctime`) VALUES
(1, '123@qq.com', '21232f297a57a5a743894a0e4a801fc3', '百度', 0, './Public/person.jpg	', '北京', 'http://www.baidu.com/', '13256929238', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 0),
(2, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', 'http://www.baidu.com', '13256929238', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 0),
(3, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', 'http://www.baidu.com', '13256929238', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 0),
(4, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', 'http://www.baidu.com', '13256929238', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 0),
(5, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 0, '', '', 'http://www.baidu.com', '13256929238', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 0),
(6, '', '062af77ea3850e6078c64c71ff142b2e', '', 0, '', '', 'http://www.baidu.com', '13256929238', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 0),
(7, '', '062af77ea3850e6078c64c71ff142b2e', 'sunxiaojiao', 0, '', 'sunxiajiao', 'http://www.baidu.com', '13256929238', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 0),
(8, 'sunxiaojiao001@sina.com', 'c5df4f4eabf1cbcfeb50fbbf97c5289f', '鲁东', 0, '', '鲁东大学', 'http://www.baidu.com', '13256929238', '公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍公司介绍', 0);

-- --------------------------------------------------------

--
-- 表的结构 `xm_users`
--

CREATE TABLE IF NOT EXISTS `xm_users` (
  `uid` int(255) NOT NULL AUTO_INCREMENT,
  `headlogo` varchar(100) NOT NULL DEFAULT './Public/person.jpg' COMMENT '头像',
  `passwd` char(32) NOT NULL COMMENT '6-10位',
  `username` varchar(10) NOT NULL COMMENT '最多十个字符',
  `email` varchar(75) NOT NULL COMMENT 'email',
  `phone` char(11) NOT NULL COMMENT '11位的手机号',
  `qq` varchar(10) NOT NULL COMMENT '10位以内的qq号',
  `school` varchar(255) NOT NULL,
  `age` tinyint(150) NOT NULL,
  `sex` int(3) NOT NULL COMMENT '2女 1男 3和空保密',
  `address` int(255) NOT NULL,
  `exp` longtext NOT NULL,
  `intent` varchar(255) NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='普通用户' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `xm_users`
--

INSERT INTO `xm_users` (`uid`, `headlogo`, `passwd`, `username`, `email`, `phone`, `qq`, `school`, `age`, `sex`, `address`, `exp`, `intent`, `ctime`) VALUES
(1, './Public/person.jpg', '21232f297a57a5a743894a0e4a801fc3', '1451583383', '1451583383@qq.com', '13345678910', '962783114', '鲁东大学', 100, 3, 0, '干过兼职，干过保姆，干过小蜜', 'a:5:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";i:4;s:1:"5";}', 2015),
(2, './Public/person.jpg', 'c5df4f4eabf1cbcfeb50fbbf97c5289f', '', 'sunxiaojiao001@sina.com', '', '', '', 0, 0, 0, '', '', 2015);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
