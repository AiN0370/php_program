<?php
//  1〜50 までの中から、3 が付く数字と 3 の倍数だけの配列を作成し、その後出力してください。
for ($i = 1; $i <= 50; $i++) {
    if ($i % 3 === 0 || str_contains(strval($i), '3')) {
        $array[] = $i;
        continue;
    }
}
print_r($array);
?>
