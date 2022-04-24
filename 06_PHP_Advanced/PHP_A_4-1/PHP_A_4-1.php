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
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
// PDO 接続
try {
    $pdo = new PDO($dsn, $user, $password);
    // トランプの情報を取得 (一回で全て取得する方法)
    $sql = 'SELECT * FROM trumps ORDER BY RAND() LIMIT 10;';
    $cards = $pdo->query($sql);
    $rows = $cards->fetchAll();
} catch (PDOException $e) {
    echo $error->getMessage();
    die();
} finally {
    // 接続を閉じる
    $pdo = null;
}

$playerOne = [];
$playerTwo = [];
// 勝負ボタンが押された回数を記録
if (isset($_SESSION['clickCount'])) {
    $clickCount = $_SESSION['clickCount'];
} else {
    $clickCount = 0;
}

// Postの値によって変数を定義
// 初めてアクセス
if (empty($_POST)) {
    $_SESSION['win'] = 0;
    $_SESSION['lose'] = 0;
    $clickCount = 1;
} elseif (isset($_POST['shuffle_card'])) {
    // シャッフルボタンが押されたらカードを二人のプレイヤーに配布
    list($playerOne, $playerTwo) = array_chunk($rows, ceil(count($rows) / 2));
    $clickCount = 0;
} elseif (isset($_POST['judge_game'])) {
    // 勝負ボタンが押されたらセッションからスコアを受け取る
    $playerOne = $_SESSION['playerOne'];
    $playerTwo = $_SESSION['playerTwo'];
    $clickCount += 1;
} elseif (isset($_POST['reset'])) {
    $_SESSION['win'] = 0;
    $_SESSION['lose'] = 0;
}

// スコアを割り振る
$scoreOne = setScore($playerOne);
$scoreTwo = setScore($playerTwo);

// Win, Lose を記録する
if (isset($_POST['judge_game']) && $clickCount <= 1) {
    if ($scoreOne > $scoreTwo) {
        $_SESSION['win'] += 1;
    } elseif ($scoreOne < $scoreTwo) {
        $_SESSION['lose'] += 1;
    }
}

// セッションに記録
$_SESSION['playerOne'] = $playerOne;
$_SESSION['playerTwo'] = $playerTwo;
$_SESSION['clickCount'] = $clickCount;

// --------------------Functions--------------------------

// カードのマークを表示する
function showMark($mark)
{
    if ($mark === 'spade') {
        return '♠';
    } elseif ($mark === 'heart') {
        return '♥';
    } elseif ($mark === 'diamond') {
        return '♦';
    } elseif ($mark === 'club') {
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
    rsort($result);

    $score = ['point' => 0, 'status' => []];

    foreach ($result as $key => $value) {
        if ($value === 5) {
            $score['point'] += 5;
            array_push($score['status'], 'ファイブカード');
        } elseif ($value === 4) {
            $score['point'] += 4;
            array_push($score['status'], 'フォーカード');
        } elseif ($value === 3) {
            $score['point'] += 3;
            array_push($score['status'], 'スリーカード');
            // スリーカードが出た場合ワンペアは無視
            break;
        } elseif ($value === 2 && array_count_values($marks) === 3) {
            $score['point'] += 2;
            array_push($score['status'], 'ツーペア');
        } elseif ($value === 2) {
            $score['point'] += 1;
            array_push($score['status'], 'ワンペア');
        }
    }
    if ($score['point'] === 0) {
        array_push($score['status'], 'ノーペア');
    }
    return $score;
}

// 勝ったらYou Win、負けたらYou　Loesを表示する。
function judgeScore($scoreOne, $scoreTwo)
{
    if ($scoreOne > $scoreTwo) {
        return 'You Win!!';
    } elseif ($scoreOne < $scoreTwo) {
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

include 'index.html';

?>
