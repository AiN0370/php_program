<?php
//テストの点数をランダムで生成して、点数に応じて以下の通り成績を表示してください。
// 0 点〜49 点　　 不可
// 50 点〜69 点　　可
// 70 点〜79 点　　良
// 80 点〜99 点　　優
// 100 点　　　　満点
$score = rand(0, 100);
switch ($score) {
  case $score < 50:
    echo "不可: $score <br>";
    break;
  case $score < 70:
    echo "可: $score <br>";
    break;
  case $score < 80:
    echo "良: $score <br>";
    break;
  case $score < 100:
    echo "優: $score <br>";
    break;
  case ($score = 100):
    echo "満点: $score <br>";
    break;
}
?>
