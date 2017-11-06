<?php

//1.POSTでParamを取得
$id     = $_POST["id"];
$bookname   = $_POST["bookname"];
$url  = $_POST["url"];
$comment = $_POST["comment"];

//2.DB接続
try{
    $pdo = new PDO('mysql:dbname=gs_db01;charset=utf8;host=localhost','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch(PDOException $e){
    exit('DbConnectError:'.$e->getMessage());
}

//3.UPDATE
$stmt = $pdo->prepare("UPDATE gs_bm_table SET bookname=:bookname, url=:url, comment=:comment WHERE id=:id");
$stmt->bindValue(':bookname',  $bookname,   PDO::PARAM_STR);
$stmt->bindValue(':url', $url,  PDO::PARAM_STR);
$stmt->bindValue(':comment',$comment, PDO::PARAM_STR);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  header("Location: selectbm.php");
  exit;
}

?>
