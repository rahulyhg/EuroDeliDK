<?php 

$now = date('H');
var_dump($now);

$startHour = 9;
$stopHour = 23;


if ($now > $startHour && $now < $startHour) {
    echo "Отвеорено";
} else {
    echo "Затворено";
}












die();
$numbers = [
	1 => 2,
	3 => 1,
	5 => 1,
	6 => 2,
	7 => 1,
	8 => 1
];


$numbers2 = [1,1,3,5,6,6,7,8];

$res = array();
function pc_permute($items, $perms = array(), &$res) {
    if (empty($items)) { 
        $res[] = join('', $perms) . "<br />";
    } else {
        for ($i = count($items) - 1; $i >= 0; --$i) {
             $newitems = $items;
             $newperms = $perms;
             list($foo) = array_splice($newitems, $i, 1);
             array_unshift($newperms, $foo);
             pc_permute($newitems, $newperms, $res);
         }
    }
}

pc_permute($numbers2, array(), $res);

echo "<pre>";
/// var_dump($res);

$nr = array();
foreach ($res as $r) {
	$nr[] = intval($r);
}
sort($nr);
$nr = array_unique($nr);

foreach ($nr as $n) {
	echo $n . "<br/>";
}





/*for ($i = 1; $i < 3000; $i++) {
	echo "Macka".$i."<br/>";
}*/



?>