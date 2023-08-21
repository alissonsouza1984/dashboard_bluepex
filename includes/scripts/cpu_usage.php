<?php
$cpu_usage = shell_exec("top -b -n 1 | grep 'Cpu(s)' | awk '{print $2 + $4}'");
echo $cpu_usage;
?>