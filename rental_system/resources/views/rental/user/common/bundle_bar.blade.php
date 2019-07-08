<div id="bundle_bar">
    <div class="form-group row">
        <form method="post" id="action">
            @csrf
        <div class="col-lg-6 mb-3 mb-sm-0">
        </div>
        <div class="col-lg-2 mb-3 mb-sm-0">
            <button type="submit" class="btn btn-primary btn-user btn-block bundle" disabled="disabled" formaction="/rental">一括貸出</button>
        </div>
        <div class="col-lg-2 mb-3 mb-sm-0">
            <button type="submit" class="btn btn-danger btn-user btn-block bundle" disabled="disabled" formaction="/return">一括返却</button>
        </div>
        <div class="col-lg-2 mb-3 mb-sm-0">
            <button type="submit" class="btn btn-success btn-user btn-block bundle" disabled="disabled" formaction="/mylist-register">マイリスト登録</button>
        </div>
        </form>
    </div>
</div>
