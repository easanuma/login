<?php

session_start();
if($_SESSION["kanri_flg"] != 1){
  header("Location: login.php");
  exit;
}

//1.POSTでParamを取得
$id = $_GET["id"];

//2. DB接続します

try{
    $pdo = new PDO('mysql:dbname=gs_db01;charset=utf8;host=localhost','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(PDOException $e){
    exit('DbConnectError:'.$e->getMessage());
}

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("DELETE FROM gs_user_table WHERE id=:id");
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  header("Location: selectadmin.php");
  exit;
}

?>
