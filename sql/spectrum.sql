CREATE TABLE `task`.`spectrum` ( 
     `sid` INT NOT NULL AUTO_INCREMENT COMMENT '每次获取频谱数据的id' ,
      PRIMARY KEY (`sid`), 
     `uid` INT NOT NULL COMMENT '用户id' ,
      FOREIGN KEY (uid)
        REFERENCES t_user(uid) ,
     `did` INT NOT NULL COMMENT '设备id' , 
     `f0` DOUBLE NOT NULL COMMENT '中心频率' , 
     `bw` DOUBLE NOT NULL COMMENT '带宽' , 
     `g` INT NOT NULL COMMENT '设备增益' , 
     `nfft` INT NOT NULL COMMENT '采样点数' , 
     `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
 ) ENGINE = InnoDB DEFAULT CHARSET=utf8; 

ALTER TABLE `spectrum` ADD `data` MEDIUMTEXT NULL COMMENT '频点数据' AFTER `nfft`;


CREATE TABLE `task`.`spectrum_data` (
   `sid` INT NOT NULL ,
    FOREIGN KEY (sid)
        REFERENCES spectrum(sid) ,
   `data` TEXT NOT NULL 
)ENGINE = InnoDB DEFAULT CHARSET=utf8; 