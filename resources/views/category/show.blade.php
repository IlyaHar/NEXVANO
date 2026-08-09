@extends('layouts.main')
@php
    $seoAliases = $category->seoAliasesFlat();
    $primarySeoAliases = $category->primarySeoAliases();
    $seoAliasText = implode(', ', $primarySeoAliases);
@endphp
@section('title') SeedUP — {{ $category->name }} @endsection
@section('description', 'Купити насіння '.$category->name.' SeedUP. '.($seoAliasText ? 'Також: '.$seoAliasText.'. ' : '').'Врожайні гібриди, адаптовані до умов України.')
@section('canonical', route('categories.show', $category))
@push('structured-data')
@php
    $categorySchema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Головна', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => $category->name, 'item' => route('categories.show', $category)],
                ],
            ],
            [
                '@type' => 'CollectionPage',
                '@id' => route('categories.show', $category).'#collection',
                'name' => $category->name,
                'alternateName' => $seoAliases,
                'url' => route('categories.show', $category),
                'inLanguage' => 'uk-UA',
            ],
            [
                '@type' => 'ItemList',
                'name' => 'Насіння: '.$category->name,
                'itemListElement' => $category->products->values()->map(fn ($product, $index) => [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $product->title,
                    'url' => route('products.show', $product),
                ])->all(),
            ],
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode($categorySchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
@endpush
@section('main-class', 'public-main')
@section('content-class', 'container-fluid p-0')
@section('content')
<section class="catalog-hero"><div class="site-shell"><nav class="breadcrumbs" aria-label="Breadcrumb"><a href="{{ url('/') }}">Головна</a><i class="fa-solid fa-chevron-right"></i><span>{{ $category->name }}</span></nav><span class="section-kicker">Каталог SeedUP</span><h1>{{ $category->name }}</h1><p>Оберіть гібрид за потенціалом, стійкістю та потребами вашої технології.</p></div></section>
<section class="content-section catalog-listing"><div class="site-shell"><div class="modern-product-grid">
@forelse($category->products as $product)
<article class="modern-product-card"><a class="modern-product-card__image" href="{{ route('products.show', $product) }}"><img src="{{ asset('storage/products/' . $product->thumbnail) }}" alt="{{ $product->title }}" loading="lazy"><span>Насіння SeedUP</span></a><div class="modern-product-card__body"><h2><a href="{{ route('products.show', $product) }}">{{ $product->title }}</a></h2><div class="modern-product-card__price">@if($product->new_price)<del>{{ number_format($product->price, 0, ',', ' ') }} грн</del><strong>{{ number_format($product->new_price, 0, ',', ' ') }} грн</strong>@else<strong>{{ number_format($product->price, 0, ',', ' ') }} грн</strong>@endif</div><a class="card-link" href="{{ route('products.show', $product) }}">Детальніше <i class="fa-solid fa-arrow-right"></i></a></div></article>
@empty
<div class="empty-state"><i class="fa-solid fa-seedling"></i><h2>Каталог оновлюється</h2><p>Зателефонуйте нам — ми розповімо про доступні гібриди.</p><a class="button button--primary" href="tel:+380638960419">Зателефонувати</a></div>
@endforelse
</div></div></section>
@include('blocks.contact-cta')
@endsection
