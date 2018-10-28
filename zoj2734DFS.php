<?php
//分析：从dfs(1元)搜到dfs(val元)，累计和$sum能达到val元时，ans++
function dfs($x)//搜x元的卡，看$sum
{
    global $val, $n, $ans, $sum, $num;
    if ($sum == $val) {//满足换卡价值要求
        $ans++;
        return;
    }
    //若$sum尚未达到换卡价值要求，再增加一张该卡值再查
    for ($i = $x; $i <= $val; $i++) {
        //价值i的卡片还有余量，且还没达到换卡价值要求
        if (isset($num[$i]) && $num[$i] > 0 && $sum + $i <= $val)
        {
            //至此，还未达到换卡价值要求
            $num[$i]--;
            $sum += $i;//加一张再试
            dfs($i);//一路递归，成功与不成功
            $sum -= $i;//回溯，恢复状态后换下一种类型卡再试
            $num[$i]++;//回溯后恢复状态
        }
    }
}

function main()
{
    global $val, $n, $ans, $sum, $num;
    $flag = 0;
    while (fscanf(STDIN, "%d%d", $val, $n)!=null) {
        $num = [];
        $x=$y=$ans=$sum=0;
        while ($n--) {
            fscanf(STDIN, "%d%d", $x, $y);
            $num[$x] = $y;//mike手上某卡价值x，数量y
        }

        dfs(1);//从1元的卡开始搜，最多搜到val元
        if ($flag++) echo "\n";
        printf("%d\n", $ans);
        if($flag) fgets(STDIN);
    }
}
main();
?>