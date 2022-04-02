<?php
// クラスの外から呼べるクラス内の配列リストの中で、20 歳以上のメンバーの名前を$ans 配列に格納し、「〜・〜さんは 20 歳以上です。」と 1 行で出力しましょう。
class DataList
{
    public $infoA = [
        ['name' => '山田', 'age' => 17, 'pref' => '東京'],
        ['name' => '田中', 'age' => 19, 'pref' => '神奈川'],
        ['name' => '佐藤', 'age' => 22, 'pref' => '埼玉'],
        ['name' => '鈴木', 'age' => 25, 'pref' => '千葉'],
    ];

    protected $infoB = [
        ['name' => '伊藤', 'age' => 18, 'pref' => '山口'],
        ['name' => '黒田', 'age' => 21, 'pref' => '長崎'],
        ['name' => '山形', 'age' => 27, 'pref' => '宮崎'],
        ['name' => '松方', 'age' => 28, 'pref' => '鹿児島'],
    ];

    function func()
    {
        foreach ($this as $key => $val) {
            echo '<pre>';
            var_dump($key);
            var_dump($val);
            echo '</pre>';
        }
    }
}
$ans = [];
$dataList = new DataList();

// $infoA配列から20歳以上のものを$ans配列にpush
foreach ($dataList->infoA as $key => $value) {
    if ($value['age'] >= 20) {
        array_push($ans, $value['name']);
    }
}

// $ans配列をstringに分けて文章を作成
echo implode('・ ', $ans) . 'さんは 20 歳以上です。';

?>
