<div class="form-group float-left">
    <div class="btn-group" role="group">
        <button type="submit" form="search" class="btn btn-light text-primary" formaction="?page={{isset($_GET['page'])? $_GET['page']-1:1}}" {{isset($_GET['page']) && $_GET['page'] != 1 ? null : 'disabled'}}><<</button>
        @if(!isset($_GET['page']) || $_GET['page']<3)
            @for($x=1; $x <= $page_num && $x <= 5 ; $x++)
                <button type="submit" form="search" class="btn btn-light text-primary {{(!isset($_GET['page']) && $x==1) || (isset($_GET['page']) && $_GET['page']==$x) ? "active":null}}" formaction="?page={{$x}}">{{$x}}</button>
            @endfor
        @elseif($_GET['page']>=$page_num-1)
            @for($x=$page_num-4; $x <= $page_num ; $x++)
                <button type="submit" form="search" class="btn btn-light text-primary {{(!isset($_GET['page']) && $x==1) || (isset($_GET['page']) && $_GET['page']==$x) ? "active":null}}" formaction="?page={{$x}}">{{$x}}</button>
            @endfor
        @else
            @for($x=$_GET['page']-2; $x <= $page_num && $x <= $_GET['page']+2 ; $x++)
                <button type="submit" form="search" class="btn btn-light text-primary {{(!isset($_GET['page']) && $x==1) || (isset($_GET['page']) && $_GET['page']==$x) ? "active":null}}" formaction="?page={{$x}}">{{$x}}</button>
            @endfor
        @endif
        <button type="submit" form="search" class="btn btn-light text-primary" formaction="?page={{isset($_GET['page']) ? $_GET['page'] + 1 : 2}}" {{(!isset($_GET['page']) && $page_num != 1) || (isset($_GET['page']) && $_GET['page'] != $page_num) ? null :'disabled'}}>>></button>
    </div>
    <span class="text-secondary text-xs ml-2">全{{$page_num}}ページ</span>
</div>

<div class="form-group float-left"  style="position: absolute; bottom: 0;">
    <div class="btn-group" role="group">
        <button type="submit" form="search" class="btn btn-light text-primary" formaction="?page={{isset($_GET['page'])? $_GET['page']-1:1}}" {{isset($_GET['page']) && $_GET['page'] != 1 ? null : 'disabled'}}><<</button>
        @if(!isset($_GET['page']) || $_GET['page']<3)
            @for($x=1; $x <= $page_num && $x <= 5 ; $x++)
                <button type="submit" form="search" class="btn btn-light text-primary {{(!isset($_GET['page']) && $x==1) || (isset($_GET['page']) && $_GET['page']==$x) ? "active":null}}" formaction="?page={{$x}}">{{$x}}</button>
            @endfor
        @elseif($_GET['page']>=$page_num-1)
            @for($x=$page_num-4; $x <= $page_num ; $x++)
                <button type="submit" form="search" class="btn btn-light text-primary {{(!isset($_GET['page']) && $x==1) || (isset($_GET['page']) && $_GET['page']==$x) ? "active":null}}" formaction="?page={{$x}}">{{$x}}</button>
            @endfor
        @else
            @for($x=$_GET['page']-2; $x <= $page_num && $x <= $_GET['page']+2 ; $x++)
                <button type="submit" form="search" class="btn btn-light text-primary {{(!isset($_GET['page']) && $x==1) || (isset($_GET['page']) && $_GET['page']==$x) ? "active":null}}" formaction="?page={{$x}}">{{$x}}</button>
            @endfor
        @endif
        <button type="submit" form="search" class="btn btn-light text-primary" formaction="?page={{isset($_GET['page']) ? $_GET['page'] + 1 : 2}}" {{(!isset($_GET['page']) && $page_num != 1) || (isset($_GET['page']) && $_GET['page'] != $page_num) ? null :'disabled'}}>>></button>
    </div>
    <span class="text-secondary text-xs ml-2">全{{$page_num}}ページ</span>
</div>
