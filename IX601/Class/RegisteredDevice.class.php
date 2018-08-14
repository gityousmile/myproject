<?php
	class RegisteredDevice{
		public $deviceid;
		public $alias;
		public $register_time;
		public $group_name;

		function  __construct($deviceid,$alias,$register_time,$group_name){
    		$this->deviceid=$deviceid;
			$this->alias=$alias;
			$this->register_time=$register_time;
			$this->group_name=$group_name;
		}
	}
?>