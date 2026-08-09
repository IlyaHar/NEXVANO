<footer id="contact" class="footer">
 <div class="footer-top shell">
  <div><a href="{{ route('home') }}" class="brand brand-light"><svg viewBox="0 0 42 42"><path d="M21 37C9 31 5 19 8 7c8 1 14 6 16 13C26 12 32 7 39 6c2 13-5 23-18 31Z"/><path d="M21 36V18"/></svg><span>NE<span>X</span>VANO<small>CROP SCIENCE</small></span></a><p>{{ __('site.footer.text') }}</p></div>
  <div><h4>{{ __('site.nav.catalog') }}</h4><a href="{{ route('catalog') }}">Micro Complex</a><a href="{{ route('catalog') }}">Nexvano Bor</a><a href="{{ route('catalog') }}">Nexvano Zn</a></div>
  <div><h4>{{ __('site.footer.office') }}</h4><p>Pol. Ind. La Estación<br>C/ Principal, 12<br>03660 Aspe, Alicante, España</p></div>
  <div><h4>{{ __('site.nav.contact') }}</h4><a href="tel:+34965492250">+34 965 492 250</a><a href="mailto:info@nexvano.com">info@nexvano.com</a><a href="https://nexvano.com">nexvano.com</a></div>
 </div>
 <div class="footer-bottom shell"><span>© {{ date('Y') }} Nexvano Crop Science S.L. {{ __('site.footer.rights') }}</span><span>Made in Spain <b>🇪🇸</b></span></div>
</footer>
