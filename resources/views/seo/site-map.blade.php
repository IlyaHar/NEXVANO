@extends('layouts.main')
@section('title', 'SeedUP — карта сайту')
@section('description', 'Карта сайту SeedUP: головні розділи, категорії насіння та всі гібриди соняшнику і кукурудзи.')
@section('canonical', route('site-map'))
@section('main-class', 'public-main')
@section('content-class', 'container-fluid p-0')

@section('content')
<section class="catalog-hero"><div class="site-shell"><nav class="breadcrumbs"><a href="{{ route('home') }}">Головна</a><i class="fa-solid fa-chevron-right"></i><span>Карта сайту</span></nav><span class="section-kicker">Навігація SeedUP</span><h1>Карта сайту</h1><p>Усі розділи, категорії та гібриди SeedUP в одному місці.</p></div></section>
<section class="content-section"><div class="site-shell site-map-grid">
    <article class="site-map-card site-map-card--primary"><div class="site-map-card__icon"><i class="fa-solid fa-compass"></i></div><h2>Головні розділи</h2><ul><li><a href="{{ route('home') }}">Головна <i class="fa-solid fa-arrow-right"></i></a></li><li><a href="{{ route('about.about') }}">Про компанію <i class="fa-solid fa-arrow-right"></i></a></li><li><a href="{{ route('about.production') }}">Виробництво <i class="fa-solid fa-arrow-right"></i></a></li><li><a href="{{ route('about.science') }}">Наука та агрономія <i class="fa-solid fa-arrow-right"></i></a></li><li><a href="{{ route('home') }}#contacts">Контакти <i class="fa-solid fa-arrow-right"></i></a></li></ul></article>
    @foreach($categories as $category)
        <article class="site-map-card"><div class="site-map-card__icon"><i class="fa-solid {{ $loop->odd ? 'fa-sun' : 'fa-seedling' }}"></i></div><h2><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></h2><ul>@forelse($category->products as $product)<li><a href="{{ route('products.show', $product) }}">{{ $product->title }} <i class="fa-solid fa-arrow-right"></i></a></li>@empty<li><span>Каталог оновлюється</span></li>@endforelse</ul></article>
    @endforeach
</div></section>
@endsection
