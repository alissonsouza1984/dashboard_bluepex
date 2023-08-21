<?php
$disk_info = shell_exec("df -h | grep /dev/");
$disk_parts = preg_split('/\s+/', $disk_info);
$used_space = $disk_parts[2];
$total_space = $disk_parts[1];
$disk_usage_percent = ($used_space / $total_space) * 100;

echo round($disk_usage_percent, 2);
?>
