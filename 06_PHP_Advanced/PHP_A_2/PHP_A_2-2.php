<?php
// 【PHP_A_2-2】 読み込んだ json を下記の形式の配列にして表示させてください
// [
//     "都道府県名A" => [市町村名1, 市町村名2...],
//     "都道府県名B" => [市町村名3, 市町村名4...],
//     ...
// ]
$json = file_get_contents('prefecture.json');
$prefecture = json_decode($json, true);
$newPrefecture = [];

// 必要なデータを取得してprefecture2配列に格納
foreach ($prefecture[0] as $key => $value) {
    array_push($newPrefecture, [$value['name'] => array_column($value['city'], 'city')]);
}
// 課題の要件通り出力
echo '<pre>';
var_dump($newPrefecture);
echo '</pre>';

?>
