<?php 
/**
 * 封装js与xml接口
 */
	class Response
	{
		static private $JSON="json";
		/**
		 * 封装js接口
		 * @param int $code状态码
		 * @param string $type 数据传输类型
		 * @param string $message 数据传输提示信息
		 * @param array $data 传输的数据
		 */
		public static function show($code,$message,$data="")
		{
			if(!is_numeric($code))
			{
				return '';
			}
			$result=array(
				'code'=>$code,
				'message'=>$message,
				'data'=>$data,
			);
			$type=isset($_GET['formt'])? $_GET['formt']:self::$JSON;
			if($type=='json')
			{
				self::json($code,$message,$data);
				exit;
			}
			elseif($type=='array')
			{
				var_dump($result);
			}
			elseif($type=="xml")
			{
				self::xmlEncode($code,$message,$data);
				exit;
			}
			else
			{

			}
		}
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
		echo json_encode($result);
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
	 public  static function xmlEncode($code,$message="",$data="")
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
?>