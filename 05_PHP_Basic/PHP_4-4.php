<?php
// 条件分岐を活用し、トランプの High&Low ゲームを作ってみましょう。
// ＜条件＞

// 自身と相手プレイヤーにそれぞれ 1~13 の数字をランダムで与える。
// 「あなたの数字は ◯◯ です。High か Low を選んでください」というメッセージで入力させる。
// High＆Low の条件に従い分岐をさせ、自身が勝った場合、負けた場合でメッセージを出力。
// 条件外の入力がされた場合のエラーをしっかりと考え、処理をする。
// input データの取得は以下のコードを参考にしてください。

$a = rand(1, 13);
$b = rand(1, 13);
echo $a . ', ' . $b . '<br>';
echo 'あなたの数字は' . $a . 'です。HighかLowを入力してください。<br>';
$input = 'High'; //trim(fgets(STDIN));

if ($b < $a) {
    $result = 'high';
} elseif ($b > $a) {
    $result = 'low';
} else {
    $result = 'same';
}

if (strtolower($input) === 'high' || strtolower($input) === 'low') {
    if (strtolower($input) === $result) {
        echo 'You win!!';
    } else {
        echo 'You lose!!';
    }
} else {
    echo 'Error!';
}

?>
