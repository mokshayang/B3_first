<?php include_once "base.php";
$row = $Movie->find($_GET['id']);
$date = $_GET['date'];
$hr = date("G");
if($date === date("Y-m-d") && $hr>=14){
    $start = floor($hr/2)-5;
}else{
    $start = 1;
}
for($i=$start;$i<=5;$i++){
    echo "<option value='{$Movie->sss[$i]}'>";
    echo $Movie->sss[$i];
    echo "座位剩 20";
    echo "</option>";
}





