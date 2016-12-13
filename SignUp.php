<?php
// ini_set('session.cookie_secure', 1);
// セッション開始
session_start();
include_once('index.php');

// エラーメッセージ、登録完了メッセージの初期化
$SignUpMessage = "";

// ログインボタンが押された場合
if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["username"])) {  // 値が空のとき
        $function->set_error('ユーザーIDが未入力です。');
    } else if (empty($_POST["email"])) {
        $function->set_error('E-mailが未入力です。');
    } else if (empty($_POST["password"])) {
        $function->set_error('パスワードが未入力です。');
    } else if (empty($_POST["password2"])) {
        $function->set_error('パスワードが未入力です。');
    }

    else if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] == $_POST["password2"]) {
        // 入力したユーザIDとメールアドレス，パスワードを登録
        // add_user($_POST["username"], $_POST["email"], $_POST["password"]);
        $function->add_user($_POST["username"], $_POST["email"], $_POST["password"]);

    } else if($_POST["password"] != $_POST["password2"]) {
        $function->set_error('パスワードに誤りがあります。');
    }
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>新規登録</title>
    </head>
    <body>
        <h1>新規登録画面</h1>
        <!-- $_SERVER['PHP_SELF']はXSSの危険性があるので、actionは空にしておく -->
        <form id="loginForm" name="loginForm" action="" method="POST">
            <fieldset>
                <legend>新規登録フォーム</legend>
                <div><font color="#ff0000"><?php echo $function->get_error(); ?></font></div>
                <div><font color="#0000ff"><?php echo $SignUpMessage ?></font></div>
                <label for="username">ユーザー名</label><input type="text" id="username" name="username" placeholder="ユーザー名を入力" value="<?php if (!empty($_POST["username"])) {echo htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");} ?>">
                <br>
                <label for="email">メールアドレス</label><input type="text" id="email" name="email" placeholder="メールアドレスを入力" value="<?php if (!empty($_POST["email"])) {echo htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <label for="password2">パスワード(確認用)</label><input type="password" id="password2" name="password2" value="" placeholder="再度パスワードを入力">
                <br>
                <input type="submit" id="signUp" name="signUp" value="新規登録">
            </fieldset>
        </form>
        <br>
        <form action="Login.php">
            <input type="submit" value="戻る">
        </form>
    </body>
</html>