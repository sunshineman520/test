<?php  
mysql_connect('localhost','root','ouyang');
mysql_select_db('test');
//打开锁文件
$fp=fopen('./ou.txt','r');//此处是借助文件来操作数据库
//开启锁
flock($fp,LOCK_EX);//lock_ex排他锁，共享锁lock_sh

						

$rs=mysql_query('select id from num');
$row=mysql_fetch_row($rs);
$id=$row[0];
$id--;
mysql_query("update num set id={$id}");
//释放锁
flock($fp,LOCK_UN);
$fp=fopen();
flock($fp,LOCK_EX)
flock($fp,LOCK_UN);
//fcolse($fp);
//lock table a write;
//unlock tables;
?>