class Index {

    static init() {
      // Firebaseの初期化
  
      /**
      [注意]ここの値は、FireBaseのプロジェクトサイトを参照する。
      */
      var config = {
        apiKey: "AIzaSyAhzPiExCiG5S6Z14n8cf3D-ziT3yyDBow",
        authDomain: "finalkadai-sawatani.firebaseapp.com",
        projectId: "finalkadai-sawatani",
        storageBucket: "finalkadai-sawatani.appspot.com",
        messagingSenderId: "704431177788",
        appId: "1:704431177788:web:59c617de461d401798c339",
        measurementId: "G-EHYMD7QEZV"
      };
      firebase.initializeApp(config);
  
      // FirebaseUIインスタンス初期化
      var ui = new firebaseui.auth.AuthUI(firebase.auth());
  
      // FirebaseUIの各種設定
      var uiConfig = {
        callbacks: {
          signInSuccess: function (currentUser, credential, redirectUrl) {
            // サインイン成功時のコールバック関数
            // 戻り値で自動的にリダイレクトするかどうかを指定
            return true;
          },
          uiShown: function () {
            // FirebaseUIウィジェット描画完了時のコールバック関数
            // 読込中で表示しているローダー要素を消す
            document.getElementById('loader').style.display = 'none';
          }
        },
        signInSuccessUrl: 'main.html',
        signInOptions: [
          // サポートするプロバイダを指定
          firebase.auth.EmailAuthProvider.PROVIDER_ID,
        ],
        // Terms of service url.(サービス利用規約ページの)
        tosUrl: '',
        //アカウント選択を行う画面の防止
        credentialHelper: firebaseui.auth.CredentialHelper.NONE
      };
  
      // FirebaseUI描画開始
      ui.start('#firebaseui-auth-container', uiConfig);
  
    }
  }
  