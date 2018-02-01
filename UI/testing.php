<?php
$datetime1 = new DateTime();
$datetime2 = new DateTime('2018-01-31 17:13:00');
$interval = $datetime1->diff($datetime2);
$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
echo $elapsed
?>