<?php
     /*
	 *           Simple-NMS
	 *         keith.rose.zw@gmail.com
	 *      Licensed under the MIT License Schema
	 * 
	 *  This is the pollers managers class. Instructs the remote pollers what hosts to connect to, and handles the JSON responses.
	 *
	 */
	 require('db.php');
	 error_reporting(E_ALL);
     ini_set('display_errors', True);
	 
	 class simpleNMS{
		var $Agent_Key=null;
	    var $db = null;
	 	function sendList(){
	 		
	 	}
		function handler(){
			$db=new simpleDB();
			$db->connect();
			if($_GET['cmd']=="gl"){  // Get List
				$this->Agent_Key=$_GET['agentKey']; // Need to do some junk filtering here (SQL Injection)
				// Search tbl_Agents for agent with Key == $Agent_Key
				$ResultArray=mysql_fetch_array(mysql_query("SELECT * FROM `tbl_Agents` WHERE `Agent_Key` = '$this->Agent_Key';"));
			//	print_r($ResultArray);
				// Get list of hosts assigned to this agent
				$hostList=$ResultArray['Agent_HostList'];
				$hosts=explode(",",$hostList);
				$HostsData=array();
				$x=0;
				foreach($hosts as $host){
					 $hostArray=mysql_fetch_array(mysql_query("SELECT * FROM `tbl_Hosts` WHERE `Host_ID` = $host LIMIT 0, 30"))or die($mysql_error());
		//			 $hostIP=$HostArray["Host_IP"];
			//		 $hostServices=$HostArray["Host_Services"];
				//	 $hostName=$HostArray["Host_Name"];
					
					 $HostsData[$x]=$hostArray;
					 $x=$x+1;
					}
				echo json_encode($HostsData);
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