<div id="bundle_bar" class="form-group row d-md-flex justify-content-end">
    <form method="post" id="bundle">
        @csrf
        <div class="mx-2">
            <button type="submit" class="btn btn-primary btn-user btn-block bundle px-5" disabled="disabled" formaction="/rental">一括貸出</button>
        </div>
        <div class="mx-2">
            <button type="submit" class="btn btn-danger btn-user btn-block bundle px-5" disabled="disabled" formaction="/return">一括返却</button>
        </div>
        <div class="mx-3">
            <button type="submit" class="btn btn-success btn-user btn-block bundle px-4" disabled="disabled" formaction="/mylist-register">マイリスト登録</button>
        </div>
    </form>
</div>
