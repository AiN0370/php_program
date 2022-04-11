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
    echo '<br>';
    // users table から情報を得て出力
    $sql = 'SELECT * FROM users';
    $users = $pdo->query($sql);
    $rows = $users->fetchAll();
    print_r($rows);
} catch (PDOException $error) {
    // PDO connection エラーの場合メッセージ出力
    echo $error->getMessage();
    die();
} finally {
    // 接続を閉じる
    $pdo = null;
}
