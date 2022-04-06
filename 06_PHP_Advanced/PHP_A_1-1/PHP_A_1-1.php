<?php
// 【PHP_A_1-1】 以下フォームからデータを受け取り、「XX さんは XX 歳です」と表示してください。また、年齢が 120 歳以上ならエラーを表示してください。
?>
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
        <?php if (isset($_GET['name']) && isset($_GET['age'])) {
            $name = $_GET['name'];
            $age = $_GET['age'];
            // 120歳以下の時、入力されたデータを出力
            if ($age < 120) {
                echo $name . 'さんは' . $age . '歳です';
            } else {
                echo 'Error: 年齢を120歳以下にしてください';
            }
        } ?></p>
    </div>

</body>
</html>