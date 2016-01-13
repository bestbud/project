CREATE DATABASE `task3`
  CHARACTER SET 'utf8'
  COLLATE 'utf8_general_ci';
CREATE TABLE IF NOT EXISTS `t_user` ( 
  `uid` int(11) NOT NULL AUTO_INCREMENT, 
  `username` varchar(30) NOT NULL COMMENT '用户名', 
  `password` varchar(100) NOT NULL COMMENT '密码', 
  `email` varchar(30) NOT NULL COMMENT '邮箱', 
  `token` varchar(50) NOT NULL COMMENT '帐号激活码', 
  `token_exptime` int(10) NOT NULL COMMENT '激活码有效期', 
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,0-未激活,1-已激活', 
  `regtime` int(10) NOT NULL COMMENT '注册时间', 
  PRIMARY KEY (`uid`) 
) ENGINE=InnoDB  DEFAULT CHARSET=utf8; 


CREATE TABLE t_user_info (
    uid    int(11) NOT NULL, 
    name   varchar(30)  COMMENT '用户姓名', 
    sex		tinyint(1)  DEFAULT '0' COMMENT '性别 0男1女',
    birthday  date 	COMMENT '生日',
    location varchar(100)  COMMENT '所在地',
    email    varchar(30)  COMMENT '邮箱',
    mobile varchar(11)  COMMENT '手机号',
    qq   varchar(11)  COMMENT 'qq号码',
    s