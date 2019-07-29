<div class="btn-group form-group float-left" role="group">
    @if(isset($_GET['page']) && $_GET['page'] != 1)
        <button type="submit" form="search" class="btn btn-light text-primary" formaction="?page={{$_GET['page']-1}}" ><<</button>
    @endif
    @for($x=1; $x <= $page_num ; $x++)
        <button type="submit" form="search" class="btn btn-light text-primary {{(!isset($_GET['page']) && $x==1) || (isset($_GET['page']) && $_GET['page']==$x) ? "active":null}}" formaction="?page={{$x}}">{{$x}}</button>
    @endfor
    @if((!isset($_GET['page']) && $page_num != 1) || (isset($_GET['page']) && $_GET['page'] != $page_num))
        <button type="submit" form="search" class="btn btn-light text-primary" formaction="?page={{isset($_GET['page']) ? $_GET['page'] + 1 : 2}}" >>></button>
    @endif
</div>
<div class="btn-group form-group float-left" role="group" style="position: absolute; bottom: 0; left: 20px;">
    @if(isset($_GET['page']) && $_GET['page'] != 1)
        <button type="submit" form="search" class="btn btn-light text-primary" formaction="?page={{$_GET['page']-1}}" ><<</button>
    @endif
    @for($x=1; $x <= $page_num ; $x++)
        <button type="submit" form="search" class="btn btn-light text-primary {{(!isset($_GET['page']) && $x==1) || (isset($_GET['page']) && $_GET['page']==$x) ? "active":null}}" formaction="?page={{$x}}">{{$x}}</button>
    @endfor
    @if((!isset($_GET['page']) && $page_num != 1) || (isset($_GET['page']) && $_GET['page'] != $page_num))
        <button type="submit" form="search" class="btn btn-light text-primary" formaction="?page={{isset($_GET['page']) ? $_GET['page'] + 1 : 2}}" >>></button>
    @endif
</div>
