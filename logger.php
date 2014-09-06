<?php
  class simpleLogger{
  	var $log_file="log.txt";
	
	function log($msg){
		$string = date("D M j G:i:s T Y") + "\t" + $msg + "\n";
		file_put_contents($this->log_file, $string, FILE_APPEND | LOCK_EX);
	}
  }
?>