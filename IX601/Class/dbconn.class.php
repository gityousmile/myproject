<?php
	class DBConn{
		private static $db_host="127.0.0.1";
		private static $db_user="root";
		private static $db_psw="123456";
		private static $db_name="terminal";
		private static $connection;
		static function getConn(){
			$connection= new mysqli(self::$db_host,self::$db_user,self::$db_psw,self::$db_name);
			return $connection;
		}
	}
?>