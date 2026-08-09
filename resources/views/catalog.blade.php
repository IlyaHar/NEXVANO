@extends('layouts.main')
@section('title', __('site.nav.catalog').' — Nexvano')
@section('content')
<section class="page-hero"><div class="shell"><span class="kicker">NEXVANO / 01</span><h1>{{ __('site.nav.catalog') }}</h1><p>{{ app()->getLocale()==='uk'?'Точні рішення для живлення культур, корекції дефіцитів та реалізації потенціалу врожаю.':'Soluciones precisas para nutrir cultivos, corregir carencias y maximizar el potencial productivo.' }}</p></div></section>
<section class="catalog-section shell"><div class="filter-row"><span>{{ __('site.common.filter') }}</span><div><a class="{{ !request('category')?'active':'' }}" href="{{ route('catalog') }}">{{ __('site.common.all') }}</a>@foreach($categories as $category)<a class="{{ request('category')===$category->slug?'active':'' }}" href="{{ route('catalog',['category'=>$category->slug]) }}">{{ $category->name }}</a>@endforeach</div></div><div class="product-grid catalog-grid">@forelse($products as $product)@include('product.card')@empty<p>Наразі продуктів у цій категорії немає.</p>@endforelse</div></section>
@endsection
