<?php
define("IN_TG", true);
require $_SERVER['DOCUMENT_ROOT'] . "/functions/commonFun.php";
require BASE_DIR . "/functions/mysqlFun.php";

/**
 * 建立商品表
 */
function creGoodTable()
{
    //建立商品表:
    $sql = "
create table tg_good (

    tg_id         int           unsigned not null auto_increment  comment '//id',
    tg_pName      varchar(20)   not null                          comment '//商品名称',
    tg_pIns       varchar(50)                                     comment '//商品简介',
    tg_pOlodPrice mediumint(8)  unsigned                          comment '//商品原价',
    tg_pNewPrice  mediumint(8)  unsigned                          comment '//商品现价',
    tg_pReaUser   varchar(20)   not null                          comment '//商品发布者',
    tg_pMainImg   varchar(50)                                     comment '//商品主要图片',
    tg_pReaTime   datetime      not null                          comment '//商品发布日期',
    tg_beInTime   tinyint       unsigned                          comment '//商品上架天数'
    PRIMARY KEY (tg_id)

)ENGINE=MyISAM DEFAULT CHARSET=utf8 auto_increment=50;";
    _query($sql);
}

/**
 * 创建商品和用户关系表
 */
function creUserGoodTable()
{
    $sql = "
create table if not exists tg_userGood(

  tg_id         int           unsigned  not null  auto_increment comment '//关系id',
  tg_userName   varchar(20)             not null                 comment '//用户名',
  tg_goodId     int           unsigned  not null                 comment '//商品id',
  tg_buyCount   mediumint(8)  unsigned                           comment '//购买数量',
  tg_comment    varchar(2000)                                    comment '//用户评价',
  tg_comment1   varchar(2000)                                    comment '//用户追评',
  tg_userMark   char(1)                                          comment '//用户评分',
  PRIMARY KEY (tg_id)

)ENGINE=MyISAM default charset = utf8 ;";

    _query($sql);
}



/**
 * 创建订单表
 */
function creOrderTable(){
    $sql = "create table if not exists tg_order(

  tg_id         int           unsigned not null auto_increment  comment '//id',
  tg_buyerName  varchar(20 )           not null                 comment '//购买者名字',
  tg_buyTime    datetime                                        comment '//购买时间',
  tg_cart       varchar(500)           not null                 comment '//当时的购物车内容',
  tg_gId        int           unsigned not null                 comment '//购买物品Id',
  tg_gPrice     mediumint(8)  unsigned not null                 comment '//当时购买的单价',
  tg_count      mediumint(5)  unsigned not null default 1       comment '//购买数量',
  primary key (tg_id)
)engine=MyISAM default charset=utf8 ;
    ";
    _query($sql);
}


//给tg_user 添加字段
function addColumn(){
    $sql = "alter table tg_user add tg_collect varchar(500)";
    _query($sql);
}


//创建用户表,首先写明字段，
$arr = ['username', 'password', 'uniqid', 'active', 'sex', 'level', 'reg_time',
    'last_time', 'login_ip', 'login_count'];
//创建网站模块表
$html = ['title', 'slogan'];

_connect();
creDataBase();
_select_db();
_set_names();


creUserTable($arr);
creGoodTable();
creUserGoodTable();
creHtmlTable($html);

createTriggerDir();

_close();


