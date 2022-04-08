<?php
// 【PHP_A_1-1】 以下フォームからデータを受け取り、「XX さんは XX 歳です」と表示してください。また、年齢が 120 歳以上ならエラーを表示してください。
// フォームに記載があるかチェック
if (!empty($_GET['name']) && !empty($_GET['age'])) {
    $name = htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8');
    $age = htmlspecialchars($_GET['age'], ENT_QUOTES, 'UTF-8');

    // 年齢が120歳未満の時、入力されたデータを出力
    if (is_numeric($age) && $age < 120) {
        $output = $name . 'さんは' . $age . '歳です';
    } elseif (!is_numeric($age)) {
        $output = 'Error: 年齢は数字を入力してください';
    } else {
        $output = 'Error: 年齢を120歳未満にしてください';
    }
} else {
    $output = 'Error: 全てのフォームに入力がありません';
} ?>
<html>
  <head>
    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
  </head>
<body>

<div class="d-flex align-items-center justify-content-center">
  <p class="fs-3 p-5">
    <?php echo $output; ?>
  </p>
</div>

</body>
</html>