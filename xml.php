<?php
class Response
{
	/*
	*	按照json格式返回数据
	*	@param int $code 状态码
	*	@param string $message 提示信息
	*	@param array $data 数据
	*	return string
	*/
	 
	public static function json($code,$message="",$data=array())
	{
		if(!is_numeric($code))
			return '';
		$result=array(
			'code'=>$code,
			'message'=>$message,
			'data'=>$data,
		);
		echo json_eccode($result);
		exit;
	}

	/*
	*	按照xml格式返回数据
	*	@param int $code 状态码
	*	@param string $message 提示信息
	*	@param array $data 数据
	*	return string
	*/
	 public static function xml()
	 {
	 	$xml="";
	 	$xml.="<?xml version='1.0' encoding='utf-8' ?>\n";
	 	$xml.="<root>\n";
	 	$xml.="<code>200</code>\n";
	 	$xml.="<message>success</message>\n";
	 	$xml.="<data>1</data>\n";
	 	$xml.="<name>tom</name>\n";
	 	$xml.="</root>";
	 	header('Content-Type:text/xml');
	 	echo $xml;
	 }
	 public  static function  xmlEncode($code,$message="",$data="")
	 {
	 	if(!is_numeric($code))
	 		return '';
	 	$result=array(
	 		'code'=>$code,
	 		'message'=>$message,
	 		'data'=>$data,
	 	);
	 	header('Content-Type:text/xml');
	 	
	 	$xml="<?xml version='1.0' encoding='utf-8'?>";
	 	$xml.="<root>\n";
	 	$xml.=self::xmlToEncode($result);
	 	$xml.="</root>\n";
	 	echo $xml;
	 }
	 public static function xmlToEncode($data)
	 {
	 	$xml="";
	 	$attr="";
	 	foreach($data as $k=>$v)
	 	{
	 		if(is_numeric($k))
	 		{
	 			$attr=" id='{$k}'";
	 			$k="item";
	 		}
	 		$xml.="<{$k}{$attr}>\n";
	 		$xml.=is_array($v)?self::xmlToEncode($v):$v;
	 		$xml.="</{$k}>\n";
	 	}
	 	return $xml;
	 }
}
$data=array(
	'id'=>'1',
	'name'=>'tom',
	'type'=>array(
		1,2,3=>array(123,'test'),
	),
);
Response::xmlEncode(200,'success',$data);
?>