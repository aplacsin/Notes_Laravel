@extends('layout')

@section('content')
<div class="container">
    <h3>Заметки</h3><br>
    <a href="{{ route('notes.create') }}" class="btn btn-success">Создать</a>
    <a href="{{ route('notes.export') }}" class="btn btn-success">Экспорт CSV</a>
    <a href="{{ route('notes.import') }}" class="btn btn-success">Импорт</a>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <br>


            <!-- Message success -->
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            <!-- Message errors -->
            @if ($message = Session::get('errors'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            @endif

            <!-- Create table -->
            <table class="table table-bordered">
                <thead class="main-text">
                    <tr>
                        <th>№</th>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Изображения</th>
                        <th width="100px;">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notes as $note)
                    <tr>
                        <td>{{ $note->id }}</td>
                        <td>
                            <div class="wrapper-title">
                                <div class="title">
                                    {{ $note->title }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="wrapper-content">
                                <div class="content">
                                    {!! $note->content !!}
                                </div>
                            </div>
                        </td>
                        <td width="150px;">

                            @isset($note->image)
                            @foreach($note->image as $img)
                            <div class="wrapper-image-main">
                                <div class="image-main">
                                    <img src="{{ url('images/'.$img->image)}}" alt="{{$img->image}}">
                                </div>
                            </div>
                            @endforeach
                            @endisset

                        </td>
                        <td>
                            <div class="actions">
                            <a href="{{ route('notes.show', $note->id) }}" class="btn btn-primary btn-edit">
                                    Посмотреть
                                </a>
                                <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-warning btn-edit">
                                    Редактировать
                                </a>
                                {!! Form::open(['method' => 'DELETE',
                                'route' => ['notes.destroy', $note->id]]) !!}
                                <button onclick="return confirm('Точно удалить?')" class="btn btn-danger">
                                    Удалить
                                </button>
                                {!! Form::close() !!}
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
