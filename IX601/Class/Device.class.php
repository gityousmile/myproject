<?php
	class Device{
		public $deviceid;
		public $ip;
		public $version;
		public $type;
		public $total_size;
		public $left_size;
		public $system_time;
		public $online;
		public $status;
		public $curmovie;
		public $curr_pos;//播放进度
		public $curid;
		public $valid_start;
		public $valid_end;
		public $net;
		public $count;

		function  __construct($deviceid,$ip,$version,$type,$total_size,$left_size,$system_time,$online,$status,$curmovie,$curr_pos,$curid,$valid_start,$valid_end,$net,$count){
    		$this->deviceid=$deviceid;
			$this->ip=$ip;
			$this->version=$version;
			$this->type=$type;
			$this->total_size=$total_size;
			$this->left_size=$left_size;
			$this->system_time=$system_time;
			$this->online=$online;
			$this->status=$status;
			$this->curmovie=$curmovie;
			$this->curr_pos=$curr_pos;
			$this->curid=$curid;
			$this->valid_start=$valid_start;
			$this->valid_end=$valid_end;
			$this->net=$net;
			$this->count=$count;
		}
	}
?>