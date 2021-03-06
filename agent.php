<?php
    /*
	 *           Simple-NMS
	 *         keith.rose.zw@gmail.com
	 *      Licensed under the MIT License Schema
	 * 
	 *  This is the remote polling agent. Designed to be run on a crontab on the remote systems.
	 *
	 */
		 error_reporting(E_ALL);
     ini_set('display_errors', True);
	 date_default_timezone_set('UTC');
	class SimpleNMS{
		var $agentKey="2564256666";
		var $agentVersion="0.0.1";
		
		var $managerURL="http://196.27.98.10/simple/manager.php";
		function getListFromManager()
		{
			$url=$this->managerURL . "?cmd=gl&agentKey=" . $this->agentKey;
			$obj = json_decode(file_get_contents($url),true);
			foreach($obj as $host){
				//echo $host["Host_Name"] . "\n";
				$t=",";
				$str=date("D M j G:i:s T Y") . "\tgetList():$t" . "CustomerID[" . $host['Customer_ID'] . "]" .$t  . $host['Host_Name'] . $t . $host['Host_IP'] .$t.$host['Host_Services']."\n<br>"; // remove BR in production. Purely for http debugging
				echo $str;
				// Call program logic
				$args=explode(",",$host['Host_Services']);
				foreach($args as $cmd){
					if($cmd=="ping"){
						// Call ping() on this host
						$retv=$this->ping($host["Host_IP"]);
						if(!$retv){$retv=0;}
						$str=date("D M j G:i:s T Y") . "\tping():$t" .  "CustomerID[" . $host['Customer_ID'] . "]" .$t  . $host['Host_Name'] . $t . $host['Host_IP'] . $t . $retv . "ms" .  "\n<br>"; // remove BR in production. Purely for http debugging
						echo $str;
					}
				}
			}
		}
		function postJSONPingResponse($hostID,$latency)
		{
			$url=$this->managerURL . "?cmd=pp&agentKey=" . $this->agentKey . "&Host_ID=" . $hostID . "&Host_Latency=" . $latency;
			echo $url;
		}
		function ping($host)
		{
        	/*exec(sprintf('./ping -c 1 -W 5 %s', escapeshellarg($host)), $res, $rval);
        	if ($rval){
        		return 1;
        	}else{
        		return 0;
			}*/
			exec("./ping -c 1 " . $host . " | head -n 2 | tail -n 1 | awk '{print $7}'", $ping_time);
			return substr($ping_time[0], 5);
		}
		
	}
	$s=new SimpleNMS();
	$s->getListFromManager(); 
?>