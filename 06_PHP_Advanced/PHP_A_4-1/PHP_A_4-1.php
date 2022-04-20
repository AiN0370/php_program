<?php
session_start();
// 【PHP_A_4-1】 簡易ポーカーゲーム

// 山札（データベース）から、自分と相手に5枚ずつカードを渡す。
// 勝負！ボタンを押したら強弱を判別し、勝ったらYou Win、負けたらYou　Loesを表示する。
// 勝敗数をカウントし、一番下に表示しておく
// ※データベースの設定は個人で行う課題です。
// リセットボタンを押したら勝敗履歴がリセットされる

// 〜勝敗について〜
// 役は、ワンペア、ツーペア、スリーカード、フォーカードで戦う。
// ※絵柄については判定しなくて良いです。
$host = 'localhost';
$user = 'root';
$password = 'root';
$dbname = 'mysql';

// PDO 接続
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
$pdo = new PDO($dsn, $user, $password);

// セッションから手札を読み込み
if (isset($_POST['shuffle_card'])) {
    $player1 = [];
    $player2 = [];
} else {
    $player1 = $_SESSION['player1'];
    $player2 = $_SESSION['player2'];
}

// PDO Prepare
$sql = 'SELECT * FROM trumps WHERE id = :id';
$stmt = $pdo->prepare($sql);

// 乱数用配列
$rands = [];
// カードを重複無しに二人のプレイヤーにランダムに配布
if (isset($_POST['shuffle_card'])) {
    for ($i = 0; $i < 5; $i++) {
        while (true) {
            // SQLのIDをランダムに選ぶ
            $card = rand(1, 52);
            $stmt->execute(['id' => $card]);
            $post = $stmt->fetch();
            // 重複がなかったらplayer1配列にIDのマークと番号を追加
            if (!in_array($card, $rands)) {
                array_push($player1, [
                    'mark' => $post['mark'],
                    'number' => intval($post['number']),
                ]);
                $rands[] = $card;
                break;
            }
        }
        while (true) {
            $card = rand(1, 52);
            $stmt->execute(['id' => $card]);
            $post = $stmt->fetch();
            // 重複がなかったらplayer2配列に追加
            if (!in_array($card, $rands)) {
                array_push($player2, [
                    'mark' => $post['mark'],
                    'number' => intval($post['number']),
                ]);
                $rands[] = $card;
                break;
            }
        }
    }
}

function markOutput($i)
{
    if ($i == 'spade') {
        return '♠';
    } elseif ($i == 'heart') {
        return '♥';
    } elseif ($i == 'diamond') {
        return '♦';
    } elseif ($i == 'club') {
        return '♣';
    }
}

// 勝負！ボタンを押したら強弱を判別する
function setScore($player)
{
  // 数字とマークに分ける
    $numbers = [];
    $marks = [];
    foreach ($player as $key => $value) {
      $numbers[] = $value['number'];
      $marks[] = $value['mark'];
    }
    // 同じ数字の数によってスコアのポイントを決める
    $result = array_count_values($numbers);
    $score = ['point' => 0, 'status' => []];

    foreach ($result as $key => $value) {
        if ($value == 5) {
            $score['point'] += 5;
            array_push($score['status'], 'ファイブカード');
        } elseif ($value == 4) {
            $score['point'] += 4;
            array_push($score['status'], 'フォーカード');
        } elseif ($value == 3) {
            $score['point'] += 3;
            array_push($score['status'], 'スリーカード');
        } elseif ($value == 2 && array_count_values($marks) == 3) {
            $score['point'] += 2;
            array_push($score['status'], 'ツーペア');
        } elseif ($value == 2) {
            $score['point'] += 1;
            array_push($score['status'], 'ワンペア');
        }
    }
    if ($score['point'] == 0) {
        array_push($score['status'], 'ノーペア');
    }
    return $score;
}

$score1 = setScore($player1);
$score2 = setScore($player2);

// 勝ったらYou Win、負けたらYou　Loesを表示する。
function judgeScore($score1, $score2)
{
    if ($score1 > $score2) {
        return 'You Win!!';
    } elseif ($score1 < $score2) {
        return 'You Lose!!';
    } else {
        return 'Draw';
    }
}

// ワンペア、ツーペアなどを表示する
function displayStatus($status)
{
    foreach ($status as $key => $value) {
        echo $value . ' ';
    }
}
// Win, Lose を記録する
if (isset($_POST['judge_game'])) {
    if ($score1 > $score2) {
        $_SESSION['win'] += 1;
    } elseif ($score1 < $score2) {
        $_SESSION['lose'] += 1;
    }
}
if (isset($_POST['reset'])) {
    $_SESSION['win'] = 0;
    $_SESSION['lose'] = 0;
}
// セッションに記録
$_SESSION['player1'] = $player1;
$_SESSION['player2'] = $player2;

?>
