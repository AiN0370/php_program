<?php
// 【PHP_A_1-2】 users テーブルのデータを全件出力する
$host = 'localhost';
$user = 'autumn_tarou';
$password = 'autumn';
$dbname = 'mysql';

// Set DSN
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

// PDO Instance を作成
try {
    $pdo = new PDO($dsn, $user, $password);
    echo 'Connection successful';
    // users table から情報を得て出力
    $sql = 'SELECT * FROM users';
    $users = $pdo->query($sql);
    foreach ($users as $user) {
        echo '<li>' .
            $user['name'] .
            ', ' .
            $user['email'] .
            ', ' .
            $user['password'] .
            '</li>';
    }
} catch (PDOException $error) {
    // PDO connection エラーの場合メッセージ出力
    echo $error->getMessage();
}
