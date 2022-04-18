<?php
// 【PHP_A_2-1】 json ファイルを読み込んで各都道府県名（キー名：name）を表示させてください
$json = file_get_contents('prefecture.json');
$arr = json_decode($json, JSON_OBJECT_AS_ARRAY);
$newArr = [];
foreach ($arr as $key => $value) {
    $newArr = $value;
}
foreach ($newArr as $key => $value) {
    echo '(' . $key . ': ' . $value['name'] . ')<br>';
}

?>
