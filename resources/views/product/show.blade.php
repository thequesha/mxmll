@extends('layouts.app')

@section('title', $product->name . ' — ' . config('app.name', 'Shop'))
@section('meta_description', \Illuminate\Support\Str::limit((string) $product->description, 140))
@section('canonical', route('product.show', $product))
@section('og:title', $product->name)
@php
    $imagePath = $product->image ?: 'placeholder.png';
    $ogImage = asset($imagePath);
@endphp
@section('og:image', $ogImage)

@section('content')
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="ratio-box">
                <img src="{{ $ogImage }}" alt="{{ $product->name }}">
            </div>
        </div>
        <div class="col-md-6">
            <h1 class="h3">{{ $product->name }}</h1>
            <div class="h4 mb-3">{{ $product->price_formatted }}</div>
            @if ($product->description)
                <p class="text-muted">{!! nl2br(e($product->description)) !!}</p>
            @endif
            <button type="button" class="btn btn-primary btn-add-to-cart" aria-label="Добавить в корзину (не активно)">В
                корзину</button>
        </div>
    </div>
@endsection
