@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Film
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($film, ['route' => ['films.update', $film->id], 'method' => 'patch']) !!}

                        @include('films.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection