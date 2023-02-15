<?php include_once "base.php";
$row = $Movie->find($_GET['id']);
$ondate = $row['ondate'];
$today = strtotime(date("Y-m-d"));
$tt = 3 + (strtotime($ondate)-$today)/(60*60*24) ;
for($i=0;$i<=$tt;$i++){
    $date = date("Y-m-d",strtotime("+$i day"));
    $str = date("m月d日 l",strtotime("+$i day"));
    echo "<option value=$date>";
    echo $str;
    echo "</option>";
}

