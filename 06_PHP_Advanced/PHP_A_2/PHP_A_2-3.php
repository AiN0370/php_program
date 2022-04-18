<?php
// 【PHP_A_2-3】 下記の形式に配列にして表示させてください。
// [
//     "北海道地方" => [
//         "県名" => [県名1, ...],
//         "市町村名" => [市町村名1, ...],
//         ...
//     "東北地方" => [
//         "県名" => [県名2, ...],
//         "市町村名" => [市町村名2, ...],
//         ...
//         ...
// ]
$json = file_get_contents('prefecture.json');
$prefecture = json_decode($json, true);

// それぞれの地方のIDを定義
$hokkaidoId = [1];
$tohokuId = range(2, 7);
$kantoId = range(8, 14);
$chubuId = range(15, 23);
$kinkiId = range(24, 30);
$chugokuId = range(31, 35);
$shikokuId = range(36, 39);
$kyushuId = range(40, 47);

// 最終的な配列を定義
$area = [
    '北海道地方' => ['県名' => [], '市町村名' => []],
    '東北地方' => ['県名' => [], '市町村名' => []],
    '関東地方' => ['県名' => [], '市町村名' => []],
    '中部地方' => ['県名' => [], '市町村名' => []],
    '近畿地方' => ['県名' => [], '市町村名' => []],
    '中国地方' => ['県名' => [], '市町村名' => []],
    '四国地方' => ['県名' => [], '市町村名' => []],
    '九州地方' => ['県名' => [], '市町村名' => []],
];

// ID が一致しているJSONデータをArea配列に入れる
// 北海道地方
foreach ($prefecture[0] as $key => $value) {
    if (in_array(intval($value['id']), $hokkaidoId)) {
        array_push($area['北海道地方']['県名'], $value['name']);
        foreach ($value['city'] as $key => $value) {
            array_push($area['北海道地方']['市町村名'], $value['city']);
        }
    }
}
// 東北地方
foreach ($prefecture[0] as $key => $value) {
    if (in_array(intval($value['id']), $tohokuId)) {
        array_push($area['東北地方']['県名'], $value['name']);
        foreach ($value['city'] as $key => $value) {
            array_push($area['東北地方']['市町村名'], $value['city']);
        }
    }
}
// 関東地方
foreach ($prefecture[0] as $key => $value) {
    if (in_array(intval($value['id']), $kantoId)) {
        array_push($area['関東地方']['県名'], $value['name']);
        foreach ($value['city'] as $key => $value) {
            array_push($area['関東地方']['市町村名'], $value['city']);
        }
    }
}
// 中部地方
foreach ($prefecture[0] as $key => $value) {
    if (in_array(intval($value['id']), $chubuId)) {
        array_push($area['中部地方']['県名'], $value['name']);
        foreach ($value['city'] as $key => $value) {
            array_push($area['中部地方']['市町村名'], $value['city']);
        }
    }
}
// 近畿地方
foreach ($prefecture[0] as $key => $value) {
    if (in_array(intval($value['id']), $kinkiId)) {
        array_push($area['近畿地方']['県名'], $value['name']);
        foreach ($value['city'] as $key => $value) {
            array_push($area['近畿地方']['市町村名'], $value['city']);
        }
    }
}
// 中国地方
foreach ($prefecture[0] as $key => $value) {
    if (in_array(intval($value['id']), $chugokuId)) {
        array_push($area['中国地方']['県名'], $value['name']);
        foreach ($value['city'] as $key => $value) {
            array_push($area['中国地方']['市町村名'], $value['city']);
        }
    }
}
// 四国地方
foreach ($prefecture[0] as $key => $value) {
    if (in_array(intval($value['id']), $shikokuId)) {
        array_push($area['四国地方']['県名'], $value['name']);
        foreach ($value['city'] as $key => $value) {
            array_push($area['四国地方']['市町村名'], $value['city']);
        }
    }
}
// 九州地方
foreach ($prefecture[0] as $key => $value) {
    if (in_array(intval($value['id']), $kyushuId)) {
        array_push($area['九州地方']['県名'], $value['name']);
        foreach ($value['city'] as $key => $value) {
            array_push($area['九州地方']['市町村名'], $value['city']);
        }
    }
}
// 課題の要件通りに出力
echo '<pre>';
var_dump($area);
echo '</pre>';
?>
