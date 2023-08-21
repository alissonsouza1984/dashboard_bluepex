<?php
$memory_info = shell_exec("free -m | grep Mem");
$memory_parts = preg_split('/\s+/', $memory_info);
$total_memory = $memory_parts[1];
$used_memory = $memory_parts[2];
$memory_usage_percent = ($used_memory / $total_memory) * 100;

echo round($memory_usage_percent, 2);
?>
