<?php
// 1~10 の数値をランダムで生成し、偶数か奇数かを判定して表示してください
// 生成したランダム値も表示してください。※ランダム値生成：rand(1,10);
$randomNum = rand(1, 10);
if ($randomNum % 2 === 0) {
  echo "偶数: $randomNum";
} else {
  echo "奇数: $randomNum";
}
?>
