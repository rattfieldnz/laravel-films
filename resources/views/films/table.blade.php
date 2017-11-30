<table class="table table-responsive" id="films-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Slug</th>
        <th>Description</th>
        <th>Release Date</th>
        <th>Rating</th>
        <th>Ticket Price</th>
        <th>Country</th>
        <th>Photo Url</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($films as $film)
        <tr>
            <td>{!! $film->name !!}</td>
            <td>{!! $film->slug !!}</td>
            <td>{!! $film->description !!}</td>
            <td>{!! $film->release_date !!}</td>
            <td>{!! $film->rating !!}</td>
            <td>{!! $film->ticket_price !!}</td>
            <td>{!! $film->country !!}</td>
            <td>{!! $film->photo_url !!}</td>
            <td>
                {!! Form::open(['route' => ['films.destroy', $film->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('films.show', [$film->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('films.edit', [$film->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>