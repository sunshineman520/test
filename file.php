<?php
class cacheClass
{
	private $dir;
	static private $ext=".txt";
	public function __construct()
	{
		//获取文件的所在的根目录
		$this->dir=dirname(__FILE__).'/files/';
	}
	//实现文件缓存的功能
	public function cache($key,$data="",$cacheTime="")
	{
		$filename=$this->dir.$key.self::$ext;
		//var_dump($filename);
		//exit;
		if($data!=="")
		{
			if(is_null($data))
			{
				return @unlink($filename);
			}
			$dir=dirname($filename);
			if(!is_dir($dir))
			{
				mkdir($dir,0777);
			}
			$cacheTime=sprintf("%011d",$cacheTime);
			//var_dump(file_put_contents($filename, $cacheTime.json_encode($data)));
			return file_put_contents($filename, $cacheTime.json_encode($data));
		}
		if(!is_file($filename))
		{
			return false;
		}
		else
		{
			 $content=file_get_contents($filename,true);
			 $times=(int)substr($content,0,11);
			 $value=substr($content,11);
			 if($times!=0&&$times+filemtime($filename)<time())
			 {
			 	@unlink($filename);
			 	return false;
			 }
			 return json_decode($value,true);
		}
	}
}

$data=array(
	'id'=>1,
	'name'=>'fuck',
);
//实例化并操作类
$file=new cacheClass();
$con=$file->cache('capc');
var_dump ($con);
?>