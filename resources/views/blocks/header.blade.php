<header class="site-header" id="siteHeader">
 <div class="nav-shell">
  <a href="{{ route('home') }}" class="brand" aria-label="Nexvano">
   <svg viewBox="0 0 42 42" aria-hidden="true"><path d="M21 37C9 31 5 19 8 7c8 1 14 6 16 13C26 12 32 7 39 6c2 13-5 23-18 31Z"/><path d="M21 36V18"/></svg>
   <span>NE<span>X</span>VANO<small>CROP SCIENCE</small></span>
  </a>
  <nav class="desktop-nav">
   <a href="{{ route('home') }}">{{ __('site.nav.home') }}</a><a href="{{ route('catalog') }}">{{ __('site.nav.catalog') }}</a><a href="{{ route('technology') }}">{{ __('site.nav.technology') }}</a><a href="{{ route('about') }}">{{ __('site.nav.about') }}</a><a href="{{ route('home') }}#partners">{{ __('site.nav.partners') }}</a><a href="#contact">{{ __('site.nav.contact') }}</a>
  </nav>
  <div class="nav-actions">
   <div class="language"><a class="{{ app()->getLocale()==='uk'?'active':'' }}" href="{{ route('locale','uk') }}">UA</a><span>/</span><a class="{{ app()->getLocale()==='es'?'active':'' }}" href="{{ route('locale','es') }}">ES</a></div>
   <button class="menu-toggle" aria-label="Menu" aria-expanded="false"><i></i><i></i></button>
  </div>
 </div>
 <nav class="mobile-nav"><a href="{{ route('home') }}">{{ __('site.nav.home') }}</a><a href="{{ route('catalog') }}">{{ __('site.nav.catalog') }}</a><a href="{{ route('technology') }}">{{ __('site.nav.technology') }}</a><a href="{{ route('about') }}">{{ __('site.nav.about') }}</a><a href="{{ route('home') }}#partners">{{ __('site.nav.partners') }}</a><a href="#contact">{{ __('site.nav.contact') }}</a></nav>
</header>
