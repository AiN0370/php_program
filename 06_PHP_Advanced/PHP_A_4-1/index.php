<?php include 'PHP_A_4-1.php'; ?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>ポーカーゲームを実装！</title>
    <!-- MDB -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
      rel="stylesheet"
    />
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
  <body >
    <div class="shadow-lg card text-center w-75 d-flex m-auto mt-5">
      <div class="card-header bg-danger fs-2 text-light font-weight-bold">ポーカーゲーム</div>
      <div class="card-body">
        <h5 class="card-title">あなたの手札</h5>
        <!-- 手札 -->
         <div class="px-5 py-4 d-flex justify-content-between">
            <?php foreach ($_SESSION['playerOne'] as $key => $value) { ?>
              <div class="card p-2 border-dark" style="width: 8rem; height: 12rem">
              <h4 class="card-title fs-2"><?php echo showMark($value['mark']); ?></h4>
              <div style="height: 2rem"></div>
              <h3 class="card-text"><?php echo $value['number']; ?></h3>
              </div>
            <?php } ?>
        </div> 
        <!-- ここまで -->
        <div
          class="d-flex align-items-center justify-content-between m-auto"
          style="width: 20%"
        >
          <form method="POST" action="">
            <input
            name="shuffle_card"
            class="btn btn-secondary"
            type="submit"
            value="シャッフル" 
            />
          </form>
          <form method="POST">
            <input
            name="judge_game"
            class="btn btn-danger"
            type="submit"
            value="勝負"
            />
          </form>
        </div>
        <p class="fs-10 pt-3">勝敗結果</p>
        <p class="fs-3 text-danger pb-3">
          <?php if ($clickCount <= 1) {
              if (isset($_POST['judge_game'])) {
                  echo judgeScore($scoreOne['point'], $scoreTwo['point']);
                  echo ' ';
                  displayStatus($scoreOne['status']);
              }
          } elseif ($clickCount > 1) {
              echo 'シャッフルしてください';
          } ?></p>
        <p class="card-text">
          <?php if (isset($_POST['judge_game']) && $clickCount <= 1) {
              echo '【 相手の手札 】';
              foreach ($_SESSION['playerTwo'] as $key => $value) {
                  echo $value['number'] . ', ';
              }
              displayStatus($scoreTwo['status']);
          } ?>
        </p>
        
        <p>
          【　役による序列　】：ワンペア &lt; ツーペア &lt; スリーカード &lt;
          フォーカード &lt; ファイブカード
        </p>

      </div>
      <div
        class="card-footer text-muted d-flex justify-content-between align-items-center bg-light"
      >
        <div class="d-flex">
          <div class="mx-3">勝った回数：<?php echo $_SESSION['win']; ?>回</div>
          <div class="mx-3">負けた回数：<?php echo $_SESSION['lose']; ?>回</div>
        </div>
        <div>
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-toggle="modal"
            data-bs-target="#confirmModal"
          >
            リセット
          </button>
          <!-- Modal -->
          <div
            class="modal fade"
            id="confirmModal"
            tabindex="-1"
            aria-labelledby="confirmModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="confirmModalLabel">
                    勝敗履歴のリセット
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <pre style="white-space: pre-line; font-size: 16px">
                                勝敗履歴をリセットします。
                                よろしいですか？
                  </pre>
                  <div
                    class="w-50 m-auto d-flex align-items-center justify-content-between"
                  >
                  <form action="" method="post" id="form1"> </form>
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-bs-dismiss="modal"
                    >
                      前に戻る
                    </button>
                    <button  class="btn btn-danger" name="reset" type="submit" value="reset" form="form1">
                      リセット
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
