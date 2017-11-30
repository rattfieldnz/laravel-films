<li class="{{ Request::is('films*') ? 'active' : '' }}">
    <a href="{!! route('films.index') !!}"><i class="fa fa-edit"></i><span>Films</span></a>
</li>

<li class="{{ Request::is('films*') ? 'active' : '' }}">
    <a href="{!! route('films.index') !!}"><i class="fa fa-edit"></i><span>Films</span></a>
</li>

<li class="{{ Request::is('comments*') ? 'active' : '' }}">
    <a href="{!! route('comments.index') !!}"><i class="fa fa-edit"></i><span>Comments</span></a>
</li>

<li class="{{ Request::is('genres*') ? 'active' : '' }}">
    <a href="{!! route('genres.index') !!}"><i class="fa fa-edit"></i><span>Genres</span></a>
</li>

