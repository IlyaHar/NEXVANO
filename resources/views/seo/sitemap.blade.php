{!! '<'.'?xml version="1.0" encoding="UTF-8"?'.'>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach($staticPages as $page)
    <url>
        <loc>{{ $page['url'] }}</loc>
        <lastmod>{{ $page['lastmod'] }}</lastmod>
        <changefreq>{{ $page['frequency'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
    </url>
@endforeach
@foreach($categories as $category)
    <url>
        <loc>{{ route('categories.show', $category) }}</loc>
        <lastmod>{{ \Carbon\Carbon::parse($category->products_max_updated_at ?? $category->updated_at)->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach
@foreach($products as $product)
    <url>
        <loc>{{ route('products.show', $product) }}</loc>
        <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        <image:image>
            <image:loc>{{ asset('storage/products/'.$product->thumbnail) }}</image:loc>
            <image:title>{{ $product->title }} — насіння SeedUP</image:title>
        </image:image>
    </url>
@endforeach
</urlset>
