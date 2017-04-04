<?php
// 连接数据库
$link = @mysql_connect("localhost","root","") or die("连接数据库失败");
//选择数据库
mysql_select_db("shop");
//设置字符集
mysql_query("set names utf8");
?>