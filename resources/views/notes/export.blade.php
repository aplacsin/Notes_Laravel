@extends('layout')

@section('content')

<div class="container">
    <h3>Экспорт таблицы</h3>      
   
    <div class="pull-center">
    <a href="{{ route('notes.get_export') }}" class="btn btn-success">Экспортировать</a>
    <a href="{{ route('notes.index') }}" class="btn btn-primary">Назад</a>
    </div>
    

    @endsection
