<?php include_once "base.php";
//查詢3天內的影片
$start = date("Y-m-d",strtotime("-2 day"));
$today = date("Y-m-d");
$rows = $Movie->all(['sh'=>1]," && ondate between '$start' and '$today'");
foreach($rows as $row){
    echo "<option value='{$row['id']}'>";
    echo $row['name'];
    echo "</option>";
}



