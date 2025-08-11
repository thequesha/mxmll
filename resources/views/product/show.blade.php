@extends('layouts.app')

@section('title', $product->name . ' — ' . config('app.name', 'Shop'))
@section('meta_description', \Illuminate\Support\Str::limit((string)$product->description, 140))
@section('canonical', route('product.show', $product))
@section('og:title', $product->name)
@php
    $imagePath = $product->image ?: null;
    if ($imagePath && strpos($imagePath, 'products/') !== 0) {
        $imagePath = 'products/' . ltrim($imagePath, '/');
    }
    $ogImage = $imagePath ? \Illuminate\Support\Facades\Storage::url($imagePath) : 'https://via.placeholder.com/800x1066?text=No+Image';
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
        @if($product->description)
            <p class="text-muted">{!! nl2br(e($product->description)) !!}</p>
        @endif
        <button type="button" class="btn btn-primary" aria-label="Добавить в корзину (не активно)" onclick="return false;">В корзину</button>
    </div>
</div>
@endsection
