<?php
// 【PHP_A_1-1】 以下フォームからデータを受け取り、「XX さんは XX 歳です」と表示してください。また、年齢が 120 歳以上ならエラーを表示してください。
?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>フォームの練習</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<div class="card w-50 d-flex align-items-center justify-content-center m-auto mt-5 p-5" style="border-radius: 50px;">
    <form method="GET" class="w-50">
        <h1 class="h4 mb-3 fw-normal text-center">チェックフォーム</h1>
        <label for="inputUserName" class="visually-hidden">ユーザー名</label>
        <input type="text" name="name" id="inputUserName" class="form-control my-5" placeholder="ユーザー名" required autofocus>
        <label for="inputAge" class="visually-hidden">年齢</label>
        <input type="number" name="age" id="inputAge" class="form-control my-5" placeholder="年齢" required> 
        <button class="w-100 btn btn-lg btn-outline-primary" type="submit">実行する</button>
    </form>
</div>
<!-- 以下に結果を出力 -->
<div class="d-flex align-items-center justify-content-center">
    <p class="fs-3 p-5">
      <?php if (isset($_GET['name']) && isset($_GET['age'])) {
          $name = $_GET['name'];
          $age = $_GET['age'];
          // 120歳以下の場合、入力されたデータを出力
          if ($age < 120) {
              echo $name . 'さんは' . $age . '歳です';
          } else {
              echo 'Error: 年齢を120歳以下にしてください';
          }
      } ?>
    </p>
</div>

</body>
</html>