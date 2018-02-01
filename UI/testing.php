<?php
$number = "(+63) 111-111-1111";
$number = explode("(+63) ", $number);
$number = explode("-", $number[1]);
$number = "0".$number[0].$number[1].$number[2];
echo $number;
?>