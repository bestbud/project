CREATE TABLE IF NOT EXISTS `device` ( 
  `uid` int(11) NOT NULL AUTO_INCREMENT, 
  `latitude` double NOT NULL COMMENT '设备所在位置经度',
  `longitude` double NOT NULL COMMENT '设备所在位置纬度',
  `create_time`timestamp NOT NULL COMMENT '创建时间',
  `modify_time`timestamp NOT NULL COMMENT '修改时间',
  `activation` tinyint(1) NOT NULL DEFAULT '0' COMMENT '?', 
 FOREIGN KEY (uid)
        REFERENCES t_user(uid)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8; 