<?php
/**
 * 生成app的单例模式
 */
class Db
{
	/**
	 * 数据库连接配置参数
	 * 
	 */
	private $dbconfig=array(
		'host'=>'127.0.0.1',
		'user'=>'root',
		'password'=>'ouyang',
		'database'=>'test', 
	);
	static private $connect;
	static private $instance;	
	/**
	 * 将构造函数私有化
	 */
	private function __construct()
	{

	}
	/**
	 * 链接数据库
	 */
	public function connect()
	{
		if(!self::$connect)
		{
			self::$connect=mysql_connect($this->dbconfig['host'],$this->dbconfig['user'],$this->dbconfig['password']);
			if(!self::$connect)
			{
				throw new Exception('mysql conncect error'.mysql_error());
			}
			mysql_select_db("{$this->dbconfig['database']}",self::$connect);
			mysql_query("set names utf8",self::$connect);
		}
		return self::$connect;
	}
	/**
	 * 
	 * 防止克隆
	 */
	private function __clone()
	{

	}
	/**
	 * 
	 * 单例模式函数
	 */
	public static function getInstance()
	{
		if(!self::$instance instanceof self)
			self::$instance=new self();
		return self::$instance;
	}
}
?>