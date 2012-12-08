<?php

$str = "2012-12-08T19:25:00+02:00";
echo $y = substr($str, 0,-21) . " ";
echo $m = substr($str, 5,-18) . " ";
echo $d = substr($str, 8,-15). " ";
echo $hr = substr($str, 11, -12). " ";
echo $min = substr($str, 14, -9);

echo $d = ltrim($d, '0');  

?>