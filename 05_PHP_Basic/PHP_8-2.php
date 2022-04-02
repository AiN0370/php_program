<?php
// クラスの外から func()を呼び出力してみましょう。(1 の形式と同じように出力してください)
class DataList
{
    public static $infoA = [
        ['name' => '山田', 'age' => 17, 'pref' => '東京'],
        ['name' => '田中', 'age' => 19, 'pref' => '神奈川'],
        ['name' => '佐藤', 'age' => 22, 'pref' => '埼玉'],
        ['name' => '鈴木', 'age' => 25, 'pref' => '千葉'],
    ];

    protected static $infoB = [
        ['name' => '伊藤', 'age' => 18, 'pref' => '山口'],
        ['name' => '黒田', 'age' => 21, 'pref' => '長崎'],
        ['name' => '山形', 'age' => 27, 'pref' => '宮崎'],
        ['name' => '松方', 'age' => 28, 'pref' => '鹿児島'],
    ];

    // 静的なメソッドを使用する
    static function func()
    {
        var_dump(self::$infoA);
        var_dump(self::$infoB);
    }
}
// 静的なメソッドを参照する
echo Datalist::func();

?>
