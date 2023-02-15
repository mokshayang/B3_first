<?php include_once "base.php";
// dd($_POST);
if(!empty($_POST['seats'])){
$max_id = $Ord->max('id')+1;
// $_POST['num'] = date("Ymd").sprintf("%04d",$max_id);
$_POST['num'] = date("Ymd").str_pad($max_id, 4, 0, STR_PAD_LEFT);
$_POST['qt']=count($_POST['seats']);

sort($_POST['seats']);//顯示訂單資料那邊用
$_POST['seats']=serialize($_POST['seats']);

$Ord->save($_POST);
?>
<div class="ct">
<h3>感謝您的訂購，您的訂單號碼是 : <?=$_POST['num']?></h3>
<p>點影名稱 :<?=$_POST['movie']?></p>
<p>日期 :<?=$_POST['date']?></p>
<p>場次時間 :<?=$_POST['session']?></p>
<p>座位 : <br>
<?php
$seats = unserialize($_POST['seats']);
foreach($seats as $seat){
    echo floor(($seat/5)+1)."排".($seat%5+1)."號";
    echo "<br>";
}

?>
<br>
共 <?=count($seats)?> 張電影票

</p>
<p>
    <button onclick="location.href='index.php'">確定</button>
</p>
</div>


<?php }else{ ?>
<div class="ct">
    <h3>請選擇你的座位 !</h3>
    
    <button onclick="booking()" type="button">選擇座位</button>
</div>
<?php } ?>
