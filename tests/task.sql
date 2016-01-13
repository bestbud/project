-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-11-15 07:49:21
-- 服务器版本： 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- 表的结构 `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `uid` int(11) NOT NULL,
  `latitude` double NOT NULL COMMENT '设备所在位置经度',
  `longitude` double NOT NULL COMMENT '设备所在位置纬度',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `modify_time` int(10) NOT NULL COMMENT '修改时间',
  `activation` tinyint(1) NOT NULL DEFAULT '0' COMMENT '?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `spectrum`
--

CREATE TABLE IF NOT EXISTS `spectrum` (
  `uid` int(11) NOT NULL,
  `device_id` int(16) NOT NULL COMMENT '设备id',
  `intensity` double NOT NULL COMMENT '??',
  `create_time` int(10) NOT NULL COMMENT '频谱信息获取时间',
  `activation` tinyint(1) NOT NULL DEFAULT '0' COMMENT '?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `task_pending`
--

CREATE TABLE IF NOT EXISTS `task_pending` (
  `USER_ID` int(10) unsigned NOT NULL,
  `TOKEN` varchar(50) NOT NULL,
  `TOKEN_EXPTIME` int(10) NOT NULL,
  `CREATED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `task_pending`
--

INSERT INTO `task_pending` (`USER_ID`, `TOKEN`, `TOKEN_EXPTIME`, `CREATED_DATE`) VALUES
(0, 'df0e3dc46e13d3d7fc5d3ac55dd6a70d', 1444553068, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `task_user`
--

CREATE TABLE IF NOT EXISTS `task_user` (
  `UID` int(10) unsigned NOT NULL,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` char(40) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `IS_ACTIVE` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=gb2312;

--
-- 转存表中的数据 `task_user`
--

INSERT INTO `task_user` (`UID`, `USERNAME`, `PASSWORD`, `EMAIL`, `IS_ACTIVE`) VALUES
(1, 'user1', '81dc9bdb52d04dc20036dbd8313ed055', 'wordm1@126.com', 0),
(14, 'task', '81dc9bdb52d04dc20036dbd8313ed055', 'oktask@126.com', 0),
(16, 'user8', '81dc9bdb52d04dc20036dbd8313ed055', 'wordm8@126.com', 0),
(17, 'user9', '7bccfde7714a1ebadf06c5f4cea752c1', 'wordm9@126.com', 0),
(25, 'user2', '81dc9bdb52d04dc20036dbd8313ed055', 'wordm2@126.com', 0);

-- --------------------------------------------------------

--
-- 表的结构 `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `uid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `token` varchar(50) NOT NULL COMMENT '帐号激活码',
  `token_exptime` int(10) NOT NULL COMMENT '激活码有效期',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,0-未激活,1-已激活',
  `regtime` int(10) NOT NULL COMMENT '注册时间'
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `t_user`
--

INSERT INTO `t_user` (`uid`, `username`, `password`, `email`, `token`, `token_exptime`, `status`, `regtime`) VALUES
(33, 'user2', '173egPg7ec2g4IIsl79y7VFddbpbyfHqwQzodt7BNzm9', 'wordm2@126.com', '1744e4ce7bbde30e2ede061bba78e53b', 1445564453, 1, 1445478053),
(34, 'user3', '783dhDLbeJhTb2KlwRMoCI4bXmIUWbqtKMSDNkZrZAmBACI7fw', 'wordm3@126.com', '8e9ef251dcc52210cbeab63e49de7bde', 1445568376, 1, 1445478830),
(35, '453815603@qq.com', 'bad4dyObTjLtd3PxuQT5XBOSH1CYBRaS4hJB6RkbMIh4', '453815603@qq.com', '5412b5488c22ef2e2fd47bb25fe08ded', 1445584458, 0, 1445497954),
(36, 'user1', '6f0fjfi4UeLpF35tvGhmbIYJCTXYvZ8KUy0pbw0cLxRP', 'wordm1@126.com', 'ae986d2212daa3bc17fb18e351ad0ca8', 1447651461, 1, 1445498869),
(37, 'task', 'c80d2NV/QtIV1ZevoS82Vn2AEkF8QvpCDNP+FrI5qKX0', 'oktask@126.com', '5349a9611672a90e7db33db61a902a20', 1445667027, 1, 1445509930),
(38, 'user4', '5857cJDF2Ik3Kn+rr8b5idXIyFLCPV4hVgEibkB8Sjtx', 'wordm4@126.com', 'c6a7097b33bbbaa3e4e60d79ebf4c5cb', 1445598889, 1, 1445511375),
(39, '小穗', 'acb7hhztnz3W2HoD1rcgi3+rgodynjAObbnpKzPgceZB', '1114956625@qq.com', '80bc228330f267bfff6727f4cfb24679', 1447651537, 1, 1447563040);

-- --------------------------------------------------------

--
-- 表的结构 `t_user_info`
--

CREATE TABLE IF NOT EXISTS `t_user_info` (
  `uid` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL COMMENT '用户姓名',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别 0男1女',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `location` varchar(100) DEFAULT '省份/地级市/市、县级市、县' COMMENT '所在地',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `mobile` varchar(13) DEFAULT NULL COMMENT '手机号',
  `qq` varchar(13) DEFAULT NULL COMMENT 'qq号码'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `t_user_info`
--

INSERT INTO `t_user_info` (`uid`, `name`, `sex`, `birthday`, `location`, `email`, `mobile`, `qq`) VALUES
(33, '宋二毛', 0, '2015-01-26', '北京/北京/北京市/二毛家', 'wordm2@126.com', '15062286157', '123415648'),
(34, '宋三毛', 0, '2014-11-05', '河北/保定/安国市/三毛家', 'wordm3@126.com', '18744021856', '12345648'),
(35, NULL, 0, NULL, '省份/地级市/市、县级市、县', '453815603@qq.com', NULL, NULL),
(36, '宋三毛', 1, '2015-07-14', '辽宁/鞍山/鞍山市/交付的卡了', 'wordm1@126.com', '18744021856', '12312'),
(37, '宋OK', 0, '2018-10-29', '福建/福州/长乐市/OK家', 'oktask@12', '18744021856', '1234564'),
(38, '四毛', 0, '0123-12-03', '福建/福州/长乐市/四毛家', 'wordm4@126.com', '145229565', '12312645'),
(39, NULL, 0, NULL, '省份/地级市/市、县级市、县', '1114956625@qq.com', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `spectrum`
--
ALTER TABLE `spectrum`
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `task_pending`
--
ALTER TABLE `task_pending`
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `task_user`
--
ALTER TABLE `task_user`
  ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `t_user_info`
--
ALTER TABLE `t_user_info`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `spectrum`
--
ALTER TABLE `spectrum`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task_user`
--
ALTER TABLE `task_user`
  MODIFY `UID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- 限制导出的表
--

--
-- 限制表 `device`
--
ALTER TABLE `device`
ADD CONSTRAINT `device_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `t_user` (`uid`);

--
-- 限制表 `spectrum`
--
ALTER TABLE `spectrum`
ADD CONSTRAINT `spectrum_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `t_user` (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
