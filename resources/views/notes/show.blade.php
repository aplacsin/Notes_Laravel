@extends('layout')

@section('content')

@include('errors')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Просмотр Заметки № - {{$note->id}}</h3><br>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('notes.index') }}">Назад</a>
            </div>
            <h3 class="title-show"><h4>Название:</h4> {{ $note->title }}</h3>
            <p class="content-show"><h4>Описание:</h4>
                <p>{!! $note->content !!}</p>
            </p>

            <h3 class="title-gallery">Галерея</h3>

            <div class="wrapper-img" id="thumbs">
                @isset($note->image)
                @foreach($note->image as $img)
                <div class="wrapper-image-show">
                    <div class="image-show">
                    <figure><a href="{{ url('images/'.$img->image) }}" alt="{{ $img->image }}" title="{{ $img->image }}">
                            <img src="{{ url('images/'.$img->image)}}" alt="{{ $img->image }}">
                        </a></figure>
                    </div>
                </div>
                @endforeach
                @endisset
            </div>

            <div class="wrapper-gallery">
                <p><img id="largeImg" src="" alt=""></p>
            </div>
        </div>
    </div>
</div>

@endsection
