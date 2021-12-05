    <div class="page-navigation">
        <a href="{{$routePage($page - 1)}}" class="{{$page <= 1 ? 'inactive' : ''}}">&blacktriangleleft;</a>
        <span>Seite {{$page}} von {{$maxPages}}</span>
        <a href="{{$routePage($page + 1)}}" class="{{$page>=$maxPages ? 'inactive' : ''}}">&blacktriangleright;</a>
    </div>
