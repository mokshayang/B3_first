<?php include_once "base.php";
dd($_POST);
$Ord->del([$_POST['type']=>$_POST['val']]);