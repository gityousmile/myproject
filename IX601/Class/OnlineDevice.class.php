<?php
	require('RegisteredDevice.class.php');
	class OnlineDevice extends RegisteredDevice{
		public $ip;

		function  __construct($deviceid,$alias,$register_time,$ip){
    		$this->deviceid=$deviceid;
			$this->alias=$alias;
			$this->register_time=$register_time;
			$this->ip=$ip;
		}
	}
?>