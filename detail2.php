<?php
session_start();
$id = $_GET["id"]; //?id~**を受け取る
require_once("funcs.php");
loginCheck();
$pdo = db_conn();



//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
    sql_error();
}else{
    $result = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>翻訳者データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="index2.php">翻訳者一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<form method="POST" action="update.php">
<div class="jumbotron">
  <legend>データ詳細</legend>
  <table style="border:solid 1p ; width:100%">
    <tr>
      <th style="border:solid 1px; width:25%">名前</th>
      <th style="border:solid 1px; width:25%">SNSリンク</th>
      <th style="border:solid 1px; width:25%">言語</th>
      <th style="border:solid 1px; width:25%">受託金額（円／文字）：</th>
    </tr>
    <tr>
      <td style="border:solid 1px; width:25%"> <?= $result['name'] ?> </td>
      <td style="border:solid 1px; width:25%"> <?= $result['sns'] ?> </td>
      <td style="border:solid 1px; width:25%"> <?= $result['language'] ?> </td>
      <td style="border:solid 1px; width:25%"> <?= $result['amount'] ?> </td>
    </tr>
  </table>
  </div>

<!-- Main[Start] -->
</form>
<!-- Main[End] -->


</body>
</html>
