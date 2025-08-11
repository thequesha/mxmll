@extends('layouts.app')

@section('title', $category->name . ' — ' . config('app.name', 'Shop'))
@section('meta_description', 'Категория: ' . $category->name)
@section('canonical', request()->url())
@section('og:title', $category->name)
@section('og:description', 'Категория: ' . $category->name)

@section('content')
    <h1 class="mb-4">{{ $category->name }}</h1>

    @if($products->count())
        <div class="row">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    @include('partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @else
        <p class="text-muted">В этой категории пока нет товаров.</p>
    @endif
@endsection
