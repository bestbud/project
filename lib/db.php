<?php
/*
时间：15/10/*
功能：链接数据库
*/
// database connection and schema constants
define('DB_HOST', 'localhost');
define('DB_USER', 'task');
define('DB_PASSWORD', '1234');
define('DB_SCHEMA', 'task');
define('DB_TBL_PREFIX', 'task_');

// establish a connection to the database server
if (!$GLOBALS['DB'] = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD))
{
    die('Error: 无法连接到数据库');
}
if (!mysql_select_db(DB_SCHEMA, $GLOBALS['DB']))
{
    mysql_close($GLOBALS['DB']);
    die('Error: 无法连接到数据库');
}
mysql_query('SET NAMES utf8');
?>
