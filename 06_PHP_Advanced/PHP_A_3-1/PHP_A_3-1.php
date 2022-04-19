<?php
// フォームから送信された ID、パスワードを会員リスト(ID,パスワード,名前)と比較し、ID・パスワードが一致したら名前を、それ以外はエラーメッセージを表示してください。
$host = 'localhost';
$user = 'root';
$password = 'root';
$dbname = 'mysql';
$message = '';
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

// PDOに接続
try {
    $connect = new PDO($dsn, $user, $password);
    if (isset($_POST['login'])) {
        // フォーム未記入だった場合のエラー
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $message = 'All fields are required';
            // Emailに関するエラー
        } elseif ($email == false) {
            $message = 'Please enter a valid email address';
        } else {
            // 提出された情報と該当するデータがあるか調べる
            $query =
                'SELECT * FROM users WHERE email = :email AND password =  :password';
            $stmt = $connect->prepare($query);
            $stmt->execute([
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ]);
            // 一致するデータがある場合、名前を表示
            $count = $stmt->rowCount();
            if ($count > 0) {
                // セッションに保存
                $_SESSION['email'] = $_POST['email'];
                $message = 'Login success';
                $row = $stmt->fetch(PDO::FETCH_OBJ);
                echo $row->name . '<br>';
            } else {
                $message = 'Wrong email or password';
            }
        }
    }
} catch (PDOException $error) {
    echo $error->getMessage();
    die();
} finally {
    // 接続を閉じる
    $pdo = null;
}
// ステータスメッセージを表示
echo $message;
