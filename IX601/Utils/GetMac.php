<?php
   $MacReturn = shell_exec("cat /etc/sysconfig/network-scripts/ifcfg-eth0");
   $index = strpos($MacReturn,"HWADDR=");
   $mac = str_replace(":", "", substr($MacReturn,$index+7,17));
   echo $mac;
?>