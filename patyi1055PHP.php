<?php
class Person{
    public $name,$height;
    public function __construct($name,$height){
        $this->name=$name;$this->height=$height;
    }
}
function cmp(Person $a,Person $b){
    if ($a->height!== $b->height) {
        return $a->height<$b->height;
    }else{
        return strcmp($a->name,$b->name);
    }
}
function outputLine($start, $num) {
    global $a;
    $mid = (int)($num / 2);
    $sign = -1;
    $inc=1;
	//vector<int> pos(num);
    $pos=[];//存输出排的下标
	$pos[$mid] = $start;
	for ($j = 1; $j < $num; $j++) {//把剩余的num-1个位置存入pos中
        $pos[$mid + ($sign)*$inc] = $start+$j;//先存入mid位置的左侧
        $sign = -$sign;
        if ($j % 2 == 0)$inc++;//左右一轮后自增
    }
	for ($j = 0; $j < $num; $j++) {
        if ($j != $num - 1)
            echo $a[$pos[$j]]->name." ";
        else echo $a[$pos[$j]]->name."\n";
    }
}
fscanf(STDIN,"%d%d",$n,$row);
global $a;
$a=array();
for($i=0;$i<$n;$i++){
    fscanf(STDIN,"%s%d",$name,$height);
    $a[$i]=new Person($name,$height);
}
//使用用户自定义的比较函数对数组中的值进行排序
usort($a,"cmp");
//var_dump($a);
$perRow = floor($n / $row);
if ($row > 1) {
    $num = $n - $perRow*($row - 1);//最后排总人数
    $num2 = floor($n / $row);//其它排人数
		outputLine(0, $num);
		for ($i = 1; $i < $row; $i++) {
            outputLine($num+$num2*($i-1), $num2);
        }
	}
else outputLine(0, $n);
?>