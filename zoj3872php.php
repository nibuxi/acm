<?php
fscanf(STDIN, "%d", $t);
while ($t--) {
    fscanf(STDIN, "%d", $n);
    $str = "";
    $len = 0;
    $a = [];
    $dp = [];
    $pos = [];
    while ($len != $n) {
        $str = fgets(STDIN);
        $str = str_replace("\r\n", "", $str);
        $tmp = [];
        $tmp = explode(' ', $str);
        $a = array_merge($a, $tmp);
        $len += count($tmp);
    }
    for ($i = 0; $i < $n; $i++) {
        $a[$i] = (int)$a[$i];
        $pos[$a[$i]] = -1;
    }
    $dp[0] = $a[0];
    $pos[$a[0]] = 0;
    for ($i = 1; $i < $n; $i++) {
        $dp[$i] = $dp[$i - 1] + ($i - $pos[$a[$i]]) * $a[$i];
        $pos[$a[$i]] = $i;
    }
    $ans = 0;
    for ($i = 0; $i < $n; $i++) $ans += $dp[$i];
    echo "$ans\n";
}
?>