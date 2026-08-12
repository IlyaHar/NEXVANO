<article class="product-card">
 <a href="{{ route('products.show',$product) }}" class="product-art">@if($product->image_url)<img class="product-image" src="{{ $product->image_url }}" alt="{{ $product->title }}" loading="lazy">@else<div class="bottle"><i></i><div class="bottle-label"><small>NEXVANO</small><b>{{ strtoupper(Str::after($product->title,'Nexvano ')) }}</b><em>CROP SCIENCE</em></div></div>@endif<span class="product-volume">{{ $product->volume }}</span></a>
 <div class="product-info"><div><span>{{ $product->categories->first()?->name }}</span><h3>{{ $product->title }}</h3><p>{{ $product->subtitle }}</p></div><a href="{{ route('products.show',$product) }}" aria-label="{{ __('site.common.view') }}">↗</a></div>
</article>
