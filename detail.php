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

<!-- JQuery -->
<script src="js/jquery-3.5.1.min.js">

</script>
<!-- JQuery -->



<!--** 以下Firebase **-->
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyAhzPiExCiG5S6Z14n8cf3D-ziT3yyDBow",
    authDomain: "finalkadai-sawatani.firebaseapp.com",
    databaseURL: "https://finalkadai-sawatani-default-rtdb.firebaseio.com",
    projectId: "finalkadai-sawatani",
    storageBucket: "finalkadai-sawatani.appspot.com",
    messagingSenderId: "704431177788",
    appId: "1:704431177788:web:59c617de461d401798c339",
    measurementId: "G-EHYMD7QEZV"
  };

  // Initialize Firebase


// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
    // realtimedatabase に接続
    const db = getDatabase(app); 
    // realtimedatabase 内のchatを使う
    const dbRef = ref(db, "chat");  
    // #sendがクリックされたら　名前・本文情報を取得する
    $("#send").on("click", function () {
        const msg = {
            uname: $("#uname").val(),
            text: $("#text").val()
        };
        const newPostRef = push(dbRef);
        set(newPostRef, msg);
    });
    // DBからメッセージを取得し表示する
    onChildAdded(dbRef, function (data){
      const key = data.key
      const msg = data.val();
      console.log(msg);
      const a = "./img/" + msg.uname + ".png"
      const time =  $("#date").text()
      const h = `<p><img src=${a} class="icon"> ${msg.uname}<br></p><p class="textbox">${msg.text}</p><p id="time">${time}</p>`
      $("#output").append(h)
    })
    // $("#text").on("keydown", function(e){
    //   console.log(e.keyCode);
    //   if(e.keyCode  === 13){
    //     const msg = {
    //         uname: $("#uname").val(),
    //         text: $("#text").val()
    //     };
    //     const newPostRef = push(dbRef);
    //     set(newPostRef, msg);
    //   }
    // })



    // 削除機能（未完成）
    $('#clear').on("click" , function (){
                alert("ok")
                remove(db,"chat");
            });


// 日時表示
$(function(){
setInterval(function(){
var now = new Date();
var y = now.getFullYear();
var m = now.getMonth() + 1;
var d = now.getDate();
var w = now.getDay();
var wd = ['日', '月', '火', '水', '木', '金', '土'];
var h = now.getHours();
var mi = now.getMinutes();
var s = now.getSeconds();
$('#date').text(y + '/' + m + '/' + d + '  ' + h + ':' + mi );
}, 1000);
});


</script>

</body>
</html>
