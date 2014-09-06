<?php
    class simpleDB{
        var $my_host="localhost";
		var $my_user="simple";
		var $my_pass="simple";
		var $my_db="simple";
		var $my_tbl_prefix="tbl_";
		
		var $my_connection=null;
		
		function connect(){
			$this->my_connection=mysql_connect($this->my_host,$this->my_user,$this->my_pass)or $this->connectError(mysql_error());
			mysql_select_db($this->my_db);
		}
		
		function connectError($error){
			die($error);
		}
		
    }
?>