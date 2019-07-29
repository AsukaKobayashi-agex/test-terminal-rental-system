<div class="btn-group form-group float-left" role="group">
    @if(isset($_GET['page']) && $_GET['page'] != 1)
        <button type="submit" form="search" class="btn btn-light text-primary" formaction="?page={{$_GET['page']-1}}" ><<</button>
    @endif
    @for($x=1; $x <= $page_num ; $x++)
        <button type="submit" form="search" class="btn btn-light text-primary" formaction="?page={{$x}}">{{$x}}</button>
    @endfor
    @if((!isset($_GET['page']) && $page_num != 1) || (isset($_GET['page']) && $_GET['page'] != $page_num))
        <button type="submit" form="search" class="btn btn-light text-primary" formaction="?page={{isset($_GET['page']) ? $_GET['page'] + 1 : 2}}" >>></button>
    @endif
</div>
