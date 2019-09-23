@extends('layout')

@section('content')

<div class="container">
    <h3>Редактирование заметки № - {{$note->id}}</h3>

    @include('errors')
    <div class="row">
        <div class="col-md-12">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('notes.index') }}">Назад</a>
            </div>
            {!! Form::open(['route' => ['notes.update', $note->id], 'enctype' => 'multipart/form-data']) !!}
            @method('PUT')
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="title" value="{{$note->title}}"><br>
                <textarea name="content" id="editor" cols="30" rows="10"
                    class="form-control">{{$note->content}}</textarea><br>
                <br>
                <div class="form-group">
                    <div class="wrapper-edit-image-form">
                        <span>
                            <h5>Загрузить изображения
                        </span></h5>
                        <button class="btn btn-primary add-edit-field">Добавить изображение &nbsp;<span>+</span></button>

                    </div>
                </div>
            </div>

            <div class="wrapper-btn-save">
                <div class="pull-center pull-center-edit">
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </div>
            {!! Form::close() !!}

            <div class="title-upload-image">
                <span>
                    <h5>
                        Загруженные изображения:
                    </h5>
                </span>
            </div>

            <div class="wrapper-img">
                @foreach($note->image as $img)

                <div class="warpper-image-edit">
                    <div class="image-edit" id="image-edit">
                        <img src="{{ url('images/'.$img->image)}}" alt="{{ $img->image }}">
                    </div>
                    <div class="btn-edit-delete">
                        <button class="btn btn-danger edit-delete" data-id="{{ $img->id }}">Удалить</button>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
    @endsection
