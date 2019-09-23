@extends('layout')

@section('content')

<div class="container">
    <h3>Создание заметки</h3>

    @include('errors')

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('notes.index') }}">Назад</a>
            </div>
            {!! Form::open(['route' => 'notes.store', 'enctype' => 'multipart/form-data']) !!}
            @csrf

            <div class="form-group">
                <input type="text" class="form-control" name="title" value="{{old('title')}}"
                    placeholder="Введите название"><br>
                <textarea name="content" id="editor" cols="30" rows="10" class="form-control"
                    placeholder="Введите описание" maxlength="200">{{old('content')}}</textarea><br>
                <br>
                <div class="form-group">
                    <div class="wrapper-image">
                        <span>
                            <h5>Загрузить изображения
                        </span></h5>
                        <button class="btn btn-primary add-create-field">Добавить изображение &nbsp;<span>+</span></button>
                        <div><input class="add-file" type="file" name="image[]"></div>
                    </div>
                </div>
                <div class="pull-center">
                    <button class="btn btn-success">Создать</button>
                </div>
            </div>


            {!! Form::close() !!}
        </div>
    </div>
    @endsection
