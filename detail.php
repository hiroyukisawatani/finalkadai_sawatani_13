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
    <div class="navbar-header"><a class="navbar-brand" href="index.php">翻訳者一覧</a></div>
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

  <div class="jumbotron">
   <fieldset>
    <legend>[編集]</legend>
     <label>名前：<input type="text" name="name" value="<?=$result["name"]?>"></label><br>
     <label>SNSリンク　or 連絡先：<input type="text" name="sns" value="<?=$result["sns"]?>"></label><br>
     <label>言語：<select name="language" value="<?=$result["language"]?>">
    <option>英語</option>
    <option>中国語</option>
    <option>スペイン語</option>
    <option>その他</option>
    </select>
    <label>受託金額（円／文字）：<select name="amount" value="<?=$result["amount"]?>">
    <option>1円～３円</option>
    <option>４円～６円</option>
    </select>
    
     <input type="submit" value="送信">
     <input type="hidden" name="id" value="<?= $result['id']?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
