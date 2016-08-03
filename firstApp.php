<?php
/**
 * 使用接口获取请求的获取URL参数
 */
//引入接口类
	require_once('./xmlandJson.php');
	require_once("./singleapp.php");
	require_once("./file.php");
	$page=isset($_GET['page'])?$_GET['page']:1;
	$pageSize=isset($_GET['pageSize'])? $_GET['pageSize']:5;
	if(!is_numeric($page)||!is_numeric($pageSize))
	{
		 return Response::show(401,'数据不合法');
	}
//获取数据
	$offset=($page-1)*$pageSize;
	$sql="select * from message where id>37 order by id desc limit $offset,$pageSize";
	$catchFile=new cacheClass();
	$arr=array();
	if(!$arr=$catchFile->cache('index'.$page.$pageSize))
	{
		try{
			$conncetObj=Db::getInstance()->connect();
		   }catch(Exception $e)
		   {
		   		return Response::show(403,'数据库链接失败');
		   }
		
		$result=mysql_query($sql,$conncetObj);
		while($rs=mysql_fetch_assoc($result))
		{
			$arr[]=$rs;
		}
		if($arr)
		{
			$catchFile->cache('index'.$page.$pageSize,$arr,1200);

		}
	}
		if($arr)
		{
			return Response::show(200,'首页数据返回成功',$arr);
		}
		else
		{
			return Response::show(400,'首页数据返回失败');
		}

?>
