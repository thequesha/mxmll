@extends('layouts.app')

@section('title', config('app.name', 'Shop'))
@section('meta_description', 'Добро пожаловать в наш каталог товаров')
@section('canonical', url('/'))

@section('content')
<div class="jumbotron text-center">
    <h1 class="display-4 mb-3">{{ config('app.name', 'Shop') }}</h1>
    <p class="lead">Выберите категорию в меню «Каталог», чтобы посмотреть товары.</p>
</div>
@endsection
