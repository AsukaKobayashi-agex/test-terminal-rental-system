  <!-- Logout Modal-->
  <div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
          <?php
          if($check=='rental'){
            echo '貸出を確定します。よろしいですか?';
          }elseif($check=='return'){
            echo '返却を確定します。よろしいですか?';
          }
          ?>
          </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <?php
              if($check=='rental'){
                echo '本日中に必ず返却してください。';
              }elseif($check=='return'){
                echo '必ず元の場所に返却してください。';
              }
            ?>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
          <a class="btn btn-primary" href="/">確定</a>
        </div>
      </div>
    </div>
  </div>
