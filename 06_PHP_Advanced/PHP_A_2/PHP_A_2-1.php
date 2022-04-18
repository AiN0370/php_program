<?php
// 【PHP_A_2-1】 json ファイルを読み込んで各都道府県名（キー名：name）を表示させてください
$json = file_get_contents('prefecture.json');
$prefecture = json_decode($json, true);
foreach ($prefecture[0] as $key => $value) {
    echo '(' . $key . ': ' . $value['name'] . ')<br>';
}
?>
