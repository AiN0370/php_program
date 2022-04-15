<?php
// 【PHP_A_2-1】 json ファイルを読み込んで各都道府県名（キー名：name）を表示させてください
$json_data = file_get_contents('prefecture.json');
$prefecture = json_decode($json_data, JSON_OBJECT_AS_ARRAY);
foreach ($prefecture as $key => $value) {
    foreach ($value as $x => $y) {
        echo $y['name'] . '<br>';
    }
}
?>
