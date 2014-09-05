<?php
     /*
	 *           Simple-NMS
	 *         keith.rose.zw@gmail.com
	 *      Licensed under the MIT License Schema
	 * 
	 *  This is the pollers managers class. Instructs the remote pollers what hosts to connect to, and handles the JSON responses.
	 *
	 */
	 class simpleNMS{
	 	var $my_host="localhost";
		var $my_user="simple";
		var $my_pass="simple";
		var $my_db="simple";
		var $my_tbl_prefix="tbl_";
		
	 	function sendList(){
	 		
	 	}
		function handler(){
			if($_GET['cmd']=="gl"){  // Get List
				die('gl');
			}else if($_GET['cmd']=='ud'){ // Upload data
				die('ud');
			}else{
				die('invalid command.');
			}
		}
	 }
	 
	 $simple=new simpleNMS();
	 $simple->handler();
?>