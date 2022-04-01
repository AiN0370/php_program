<?php
// クラスの中から func()を呼んでみましょう。(クラス内からの呼び方は$dataList->func();をクラス外に記載することで可能・出力されます)
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
$dataList = new DataList();
$dataList->func();
?>
