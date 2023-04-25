
<?php
session_start();

require_once("funcs.php");
loginCheck();
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table INNER JOIN gs_user_table ON gs_an_table.user_id=gs_user_table.id");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error();
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<p>';
    $view .= '<a href="detail.php?id='.$r["id"].'">';
    $view .= $r["id"]." | ".$r["name"]." | ".$r["language"]." | ".$r["amount"]." | ".$r["sns"];
    $view .= '</a>';
    $view .= "　";
    if($_SESSION["kanri_flg"]=="1"){
      $view .= '<a class="btn btn-danger" href="delete.php?id='.$r["id"].'">';
      $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
      $view .= '</a>';
    }
    $view .= '</p>';
  }
}



?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-dark">
    <div class="container-fluid">
      <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>翻訳者登録</legend>
    <label>名前：<input type="text" name="name"></label><br>
    <label>SNSリンク　or 連絡先：<input type="text" name="sns"></label><br>
    <label>言語：<select name="language">
    <option>英語</option>
    <option>中国語</option>
    <option>スペイン語</option>
    <option>その他</option>
    </select>
    <label>受託金額（円／文字）：<select name="amount">
    <option>1円～３円</option>
    <option>４円～６円</option>
    </select>
   
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>


<div>
<legend>翻訳者情報一覧</legend>
    <div class="container jumbotron" id="view"><?=$view?></div>
</div>
<!-- Main[End] -->


</body>
</html>







