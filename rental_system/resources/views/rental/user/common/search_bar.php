<div name="search_bar">
    <div class="form-group row">
        <form method="post" action="/search.php">
            <div class="col-sm-2 mb-3 mb-sm-0">
                <input type="text" name="name" class="form-control form-control-user" value="" placeholder="端末名を入力" >
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary btn-user btn-block" form="check" onclick="submitAction('search.php')">検索</button>
            </div>
            <div class="col-2">
                <input type="reset" class="btn btn-dark btn-user btn-block" value="リセット">
            </div>
        </form>
    </div>
</div>

