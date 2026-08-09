<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function page()
    {
        $categories = Category::query()
            ->with(['products' => fn ($query) => $query->orderBy('title')])
            ->orderBy('name')
            ->get();

        return view('seo.site-map', compact('categories'));
    }

    public function __invoke(): Response
    {
        $categories = Category::query()
            ->withMax('products', 'updated_at')
            ->orderBy('id')
            ->get();

        $products = Product::query()
            ->orderBy('id')
            ->get();

        $staticPages = [
            ['url' => route('home'), 'view' => 'home', 'priority' => '1.0', 'frequency' => 'weekly'],
            ['url' => route('about.about'), 'view' => 'about/about', 'priority' => '0.8', 'frequency' => 'monthly'],
            ['url' => route('about.production'), 'view' => 'about/production', 'priority' => '0.8', 'frequency' => 'monthly'],
            ['url' => route('about.science'), 'view' => 'about/science', 'priority' => '0.8', 'frequency' => 'monthly'],
            ['url' => route('site-map'), 'view' => 'seo/site-map', 'priority' => '0.5', 'frequency' => 'weekly'],
        ];

        foreach ($staticPages as &$page) {
            $path = resource_path('views/'.$page['view'].'.blade.php');
            $page['lastmod'] = date(DATE_ATOM, file_exists($path) ? filemtime($path) : time());
        }

        return response()
            ->view('seo.sitemap', compact('staticPages', 'categories', 'products'))
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
