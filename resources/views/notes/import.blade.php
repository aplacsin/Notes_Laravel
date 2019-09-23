@extends('layout')

@section('content')

<div class="container">
    <h3>Импортирование заметок</h3>

    @include('errors')

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('notes.index') }}">Назад</a>
            </div>
            {!! Form::open(['route' => 'notes.get_import', 'enctype' => 'multipart/form-data' ])!!}
            @method('POST')
            @csrf
            <div>
                <div class="form-group form-import">
                    {!! Form::file('import_file') !!}
                </div>
                <div class="form-group form-import">
                <input type='submit' name='submit' value='Импортировать' class="btn btn-success">
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
