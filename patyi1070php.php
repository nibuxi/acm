<?php
fscanf(STDIN, "%d", $n);
$a = [];
while (count($a) != $n) {
    $line = fgets(STDIN);
    $line = str_replace("\r\n", "", $line);
    $tmp = explode(' ', $line);
    $a=array_merge($a,$tmp);

}
for($i=0;$i<$n;$i++) $a[$i]=(int)$a[$i];
sort($a);
$s=$a[0];
for($i=1;$i<$n;$i++)//共连n-1次
    $s=$s*0.5+$a[$i]*0.5;
printf("%d\n",(int)floor($s));
?>