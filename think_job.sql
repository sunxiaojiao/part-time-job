-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 06 月 02 日 17:16
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
  `aid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `province` varchar(12) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `city` varchar(12) NOT NULL,
  `area` varchar(12) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `xm_industry`
--

CREATE TABLE IF NOT EXISTS `xm_industry` (
  `ind_id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`ind_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

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
  `pay_way` int(1) unsigned NOT NULL DEFAULT '3' COMMENT '支付方式，1为支付宝，2为银行卡，3为现金',
  `money` varchar(20) NOT NULL COMMENT '20字的工资说明',
  `money_style` int(1) unsigned NOT NULL COMMENT '1为小时，2为天，3为每次',
  `work_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '工作时间长',
  `begin_time` int(10) unsigned NOT NULL COMMENT '开始时间',
  `want_peo` int(255) NOT NULL COMMENT '需要的人数',
  `peo_style` int(1) unsigned NOT NULL COMMENT '1为精确的，2为范围的',
  `current_peo` int(255) NOT NULL COMMENT '目前人数',
  `crowd_uids` mediumtext NOT NULL COMMENT '申请人的uid',
  `address` varchar(30) NOT NULL COMMENT '精确的地址坐标（经纬度）',
  `addressname` varchar(40) NOT NULL COMMENT '地址字符串',
  `leader` varchar(10) NOT NULL COMMENT '负责人',
  `leader_phone` varchar(11) NOT NULL COMMENT '发布人电话',
  `expire_time` int(10) unsigned NOT NULL COMMENT '过期时间',
  `ctime` int(10) unsigned NOT NULL COMMENT '申请时间',
  `pv` int(255) unsigned NOT NULL COMMENT '浏览次数',
  PRIMARY KEY (`jid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='邮箱验证链接' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `xm_mold`
--

CREATE TABLE IF NOT EXISTS `xm_mold` (
  `mid` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

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

-- --------------------------------------------------------

--
-- 表的结构 `xm_passwd_find`
--

CREATE TABLE IF NOT EXISTS `xm_passwd_find` (
  `pfind_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `pfind_code` varchar(20) NOT NULL,
  `pfind_email` varchar(20) NOT NULL,
  `pfind_utype` int(1) unsigned NOT NULL COMMENT '1user,2org',
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pfind_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='密码找回表' AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- 表的结构 `xm_pay_way`
--

CREATE TABLE IF NOT EXISTS `xm_pay_way` (
  `pay_id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `pay_uid` int(255) unsigned NOT NULL,
  `pay_jid` int(255) unsigned NOT NULL,
  `pay_way` int(1) unsigned NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付方式表' AUTO_INCREMENT=1 ;

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
  `default_payway` int(1) unsigned NOT NULL DEFAULT '3' COMMENT '默认的支付方式，1支付宝，2银行卡，3现金',
  `pay_alipay_id` varchar(21) NOT NULL COMMENT '支付宝账号',
  `pay_ccard_id` varchar(19) NOT NULL COMMENT '银行卡号',
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='普通用户' AUTO_INCREMENT=20 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
