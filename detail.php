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
    $row = $stmt->fetch();
}




?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<?php include("menu.php"); ?>
<!-- Head[End] -->

<!-- Main[Start] -->

<!-- Main[End] -->




<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>翻訳者を探そう</title>
</head>
<body>
    <h1>評価を投稿しよう</h1>
    <form action="write.php" method="post" enctype="multipart/form-data">
        <p>お名前:<input type="text" name="name" size="30"></p>
        <p>メールアドレス:<input type="text" name="email" size="30"></p>
        <p>満足度（最高5、最低1）：
            <select name="score">
                <option value="">選択してください</option>
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select></p>
        <p>コメント:<textarea name="comment" rows="4" cols="50" ></textarea></p>
        <p><input type="submit" value="送信"></p>
    </form>
    
</body>

</main>

<!--/ コンテンツ表示画面 -->


</body>
</html>
