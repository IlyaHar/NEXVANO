@extends('layouts.main')
@section('content')
<section class="hero">
 <img src="{{ asset('images/brand/nexvano-hero.png') }}" alt="Spanish fields" class="hero-bg">
 <div class="hero-shade"></div><div class="hero-orbit orbit-one"></div><div class="hero-orbit orbit-two"></div>
 <div class="shell hero-content"><div class="hero-copy"><span class="eyebrow"><i></i>{{ __('site.hero.eyebrow') }}</span><h1>{{ __('site.hero.title') }}</h1><p>{{ __('site.hero.text') }}</p><div class="hero-buttons"><a class="button button-gold" href="{{ route('catalog') }}">{{ __('site.hero.products') }} <span>↗</span></a><a class="button button-ghost" href="#contact">{{ __('site.hero.expert') }}</a></div></div></div>
 <div class="scroll-mark"><span></span>SCROLL</div>
</section>
<section class="metrics shell">
 <div><strong>24</strong><span>{{ __('site.metrics.years') }}</span></div><div><strong>1M+</strong><span>{{ __('site.metrics.clients') }}</span></div><div><strong>30+</strong><span>{{ __('site.metrics.countries') }}</span></div><div><strong>100%</strong><span>{{ __('site.metrics.quality') }}</span></div>
</section>
<section class="section solutions shell">
 <div class="section-head"><div><span class="kicker">01 / CULTURES</span><h2>{{ __('site.sections.solutions') }}</h2></div><p>{{ __('site.sections.solutions_text') }}</p></div>
 <div class="culture-grid">@foreach($categories as $i=>$category)<a href="{{ route('catalog',['category'=>$category->slug]) }}" class="culture-card"><span class="card-num">0{{ $i+1 }}</span><div class="crop-icon">@include('icons.'.$category->icon)</div><h3>{{ $category->name }}</h3><p>{{ $category->description }}</p><span class="circle-arrow">↗</span></a>@endforeach</div>
</section>
<section class="section products-section"><div class="shell"><div class="section-head light"><div><span class="kicker">02 / PRODUCTS</span><h2>{{ __('site.sections.featured') }}</h2></div><p>{{ __('site.sections.featured_text') }}</p></div><div class="product-grid">@foreach($products as $product)@include('product.card')@endforeach</div><div class="center"><a class="text-link" href="{{ route('catalog') }}">{{ __('site.common.all_products') }} <span>↗</span></a></div></div></section>
<section class="section science shell"><div class="science-visual"><img src="{{ asset('images/brand/micro-complex-info.png') }}" alt="Nexvano laboratory formula"><span class="made">NEXVANO<br><b>LAB 02</b></span></div><div class="science-copy"><span class="kicker">03 / SCIENCE</span><h2>{{ __('site.sections.why') }}</h2><p>{{ app()->getLocale()==='uk'?'Ми поєднали агрономічну експертизу з технологіями хелатування, щоб кожен елемент швидше досягав своєї цілі. Формули розробляються та виробляються на нашому майданчику в Аліканте.':'Combinamos experiencia agronómica y tecnologías de quelatación para que cada elemento llegue antes a su objetivo. Nuestras fórmulas se desarrollan y fabrican en Alicante.' }}</p><ul><li><b>01</b>{{ app()->getLocale()==='uk'?'Контроль якості кожної партії':'Control de cada lote' }}</li><li><b>02</b>{{ app()->getLocale()==='uk'?'Висока біодоступність елементів':'Alta biodisponibilidad' }}</li><li><b>03</b>{{ app()->getLocale()==='uk'?'Сумісність із системами захисту':'Compatibilidad en tanque' }}</li></ul><a href="{{ route('technology') }}" class="button button-dark">{{ __('site.common.learn') }} <span>↗</span></a></div></section>
@if($partners->isNotEmpty())
<section class="section partners-section" id="partners">
 <div class="shell">
  <div class="section-head partners-head"><div><span class="kicker">04 / PARTNERS</span><h2>{{ __('site.sections.partners') }}</h2></div><p>{{ __('site.sections.partners_text') }}</p></div>
  <div class="partners-grid">
   @foreach($partners as $partner)
    <a class="partner-card" @if($partner->website_url) href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" @endif>
     <span class="partner-logo"><img src="{{ asset('storage/partners/'.$partner->logo) }}" alt="{{ $partner->name }}" loading="lazy"></span>
     <span class="partner-meta"><strong>{{ $partner->name }}</strong><small>{{ __('site.sections.partner_label') }}</small></span>
     @if($partner->website_url)<span class="partner-arrow">↗</span>@endif
    </a>
   @endforeach
  </div>
 </div>
</section>
@endif
<section class="cta-band"><div class="shell"><span class="kicker">AGRONOMIC SUPPORT</span><h2>{{ __('site.sections.cta') }}</h2><a class="button button-gold" href="mailto:info@nexvano.com">info@nexvano.com <span>↗</span></a></div></section>
@endsection
