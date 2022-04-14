<?php
// 【PHP_A_1-3】 orders テーブルから、ID が一番大きいものを削除する
$host = 'localhost';
$user = 'autumn_tarou';
$password = 'autumn';
$dbname = 'mysql';

// PDO 接続
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
try {
    $pdo = new PDO($dsn, $user, $password);
    // 一番大きいIDのデータを削除
    $delete = 'DELETE FROM orders ORDER BY id DESC LIMIT 1;';
    $stmt = $pdo->query($delete);

    // 確認のためテーブルを出力
    $select = 'SELECT * FROM orders';
    $orders = $pdo->query($select);
    $rows = $orders->fetchAll();
    foreach ($rows as $order) {
        echo $order['id'] . '<br>';
    }
} catch (PDOException $error) {
    // エラー処理
    echo $error->getMessage();
    die();
} finally {
    // PDOを閉じる
    $pdo = null;
}

?>
