<div class="row">
    <div class="col-md-10">
        <div class="panel-body">
            <div class="panel panel-danger" id="user">
                <div class="panel-heading">Mysql 创建数据库</div>
                CREATE DATABASE `testguest` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
                USE `testguest`;
            </div>

        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-10">
        <div class="panel-body">
            <div class="panel panel-danger" id="user">
                <div class="panel-heading">Mysql 的ini文件配置</div>

                [mysql]<br>
                default-character-set=utf8
                <br>
                [mysqld]<br>
                character-set-server=utf8
            </div>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-10">
        <div class="panel-body">
            <div class="panel panel-danger" id="user">
                <div class="panel-heading">创建用户表</div>
             <pre>
                    CREATE TABLE `tg_user` (
                `tg_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT '//用户自动编号',
                `tg_uniqid` char(40) NOT NULL COMMENT '//验证身份的唯一标识符',
                `tg_active` char(40) NOT NULL COMMENT '//激活登录用户',
                `tg_username` varchar(20) NOT NULL COMMENT '//用户名',
                `tg_password` char(40) NOT NULL COMMENT '//密码',
                `tg_question` varchar(20) NOT NULL COMMENT '//密码提示',
                `tg_answer` char(40) NOT NULL COMMENT '//密码回答',
                `tg_email` varchar(40) default NULL COMMENT '//邮件',
                `tg_qq` varchar(10) default NULL COMMENT '//QQ',
                `tg_url` varchar(40) default NULL COMMENT '//网址',
                `tg_sex` char(1) NOT NULL COMMENT '//性别',
                `tg_face` char(12) NOT NULL COMMENT '//头像',
                `tg_switch` tinyint(1) unsigned NOT NULL default '0' COMMENT '//个性签名开关',
                `tg_autograph` varchar(200) default NULL COMMENT '//签名内容',
                `tg_level` tinyint(1) unsigned NOT NULL default '0' COMMENT '//会员等级',
                `tg_post_time` varchar(20) NOT NULL default '0' COMMENT '//发帖的时间戳',
                `tg_article_time` varchar(20) NOT NULL default '0' COMMENT '//回帖的时间戳',
                `tg_reg_time` datetime NOT NULL COMMENT '//注册时间',
                `tg_last_time` datetime NOT NULL COMMENT '//最后登录的时间',
                `tg_last_ip` varchar(20) NOT NULL COMMENT '//最后登录的IP',
                `tg_login_count` smallint(4) unsigned NOT NULL default '0' COMMENT '//登录次数',
                PRIMARY KEY  (`tg_id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;
             </pre>
            </div>

        </div>
    </div>
</div>