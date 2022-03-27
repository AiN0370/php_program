<?php
// 条件分岐を活用し、トランプの High&Low ゲームを作ってみましょう。
// ＜条件＞

// 自身と相手プレイヤーにそれぞれ 1~13 の数字をランダムで与える。
// 「あなたの数字は ◯◯ です。High か Low を選んでください」というメッセージで入力させる。
// High＆Low の条件に従い分岐をさせ、自身が勝った場合、負けた場合でメッセージを出力。
// 条件外の入力がされた場合のエラーをしっかりと考え、処理をする。
// input データの取得は以下のコードを参考にしてください。

$scoreA = 0;
$scoreB = 0;
// 自分:a と相手:b のカード番号をランダムに取得
$a = rand(1, 13);
$b = rand(1, 13);
echo 'あなたの数字は' . $a . 'です。HighかLowを入力してください。';
$input = trim(fgets(STDIN));

// 自分と相手のカード番号を比較して結果を取得and出力
if ($a > $b) {
    $result = 'high';
} elseif ($a < $b) {
    $result = 'low';
} else {
    $result = 'draw';
}
echo $a . ', ' . $b . ', 結果：' . $result . ' ';

// ユーザーの予想と結果に応じてそれぞれに点数を分け与える
if (strtolower($input) === 'high' || strtolower($input) === 'low') {
    if ($result === 'draw') {
        echo 'Draw! ';
    } elseif (strtolower($input) === $result) {
        echo 'Correct! ';
        $scoreA += 2;
    } else {
        echo 'Incorrect! ';
        $scoreB += 2;
    }
    // 自分と相手のスコアを出力
    echo 'You:' . $scoreA . ' Opponent:' . $scoreB . ' ';
} else {
    echo 'Error! HighかLow以外の入力がされました。もう一度トライしてください。';
}

// 勝ち負けを表示
if ($scoreA > $scoreB) {
    echo 'You won🔥 ';
} elseif ($scoreA < $scoreB) {
    echo 'You lost💧 ';
} else {
    echo 'Try again! ';
}

?>
