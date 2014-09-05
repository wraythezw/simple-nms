<?php
    /*
	 *           Simple-NMS
	 *         keith.rose.zw@gmail.com
	 *      Licensed under the MIT License Schema
	 * 
	 *  This is the remote polling agent. Designed to be run on a crontab on the remote systems.
	 *
	 */
	
	class SimpleNMS{
		var $agentID="";
		var $agentKEY="";
		var $agentLocation="";
		var $agentVersion="";
		
		var $managerURL="http://196.27.98.10/simple/manager.php";
		function getListFromManager()
		{
			
		}
		function ping($host)
		{
        	exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($host)), $res, $rval);
        	if ($rval){
        		return 1;
        	}else{
        		return 0;
			}
		}
		
	} 
?>