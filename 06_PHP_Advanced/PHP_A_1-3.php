<?php
// 【PHP_A_1-3】 orders テーブルから、ID が一番大きいものを削除する
$host = 'localhost';
$user = 'autumn_tarou';
$password = 'autumn';
$dbname = 'mysql';

// PDO 接続
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
$pdo = new PDO($dsn, $user, $password);
// SQL作成
$stmt = $pdo->prepare('DELETE FROM orders WHERE id = :id');
// 一番大きいID＝10のデータを削除
echo 'Delete "id=10" <br>';
$id = 10;
$res = $stmt->execute(['id' => $id]);

// 確認のためテーブルを出力
$stmt = $pdo->query('SELECT * FROM orders');
while ($order = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $order['id'] . '<br>';
}

?>
