<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function catalog(Request $request)
    {
        $query = Product::active()->with('categories');
        if ($request->filled('category')) $query->whereHas('categories', fn ($q) => $q->where('slug', $request->category));
        return view('catalog', ['products' => $query->get(), 'categories' => Category::orderBy('sort_order')->get()]);
    }
    public function show(Product $product) { abort_unless($product->is_active, 404); return view('product.show', ['product' => $product, 'related' => Product::active()->whereKeyNot($product->id)->take(3)->get()]); }
    public function index() { return view('product.index', ['products' => Product::with('categories')->orderBy('sort_order')->get()]); }
    public function create() { return view('product.form', ['product' => new Product, 'categories' => Category::orderBy('sort_order')->get()]); }
    public function edit(Product $product) { return view('product.form', ['product' => $product, 'categories' => Category::orderBy('sort_order')->get()]); }
    public function store(Request $request) { $data = $this->validated($request); $data['image'] = $this->upload($request); $product = Product::create($data); $product->categories()->sync($request->input('category_ids', [])); return redirect()->route('products.index')->with('success', 'Продукт створено'); }
    public function update(Request $request, Product $product) { $data = $this->validated($request, $product); if ($request->hasFile('image')) { if ($product->image && !str_starts_with($product->image, 'images/')) Storage::disk('public')->delete($product->image); $data['image'] = $this->upload($request); } $product->update($data); $product->categories()->sync($request->input('category_ids', [])); return redirect()->route('products.index')->with('success', 'Продукт оновлено'); }
    public function destroy(Product $product) { if ($product->image && !str_starts_with($product->image, 'images/')) Storage::disk('public')->delete($product->image); $product->delete(); return back()->with('success', 'Продукт видалено'); }
    private function validated(Request $request, ?Product $product = null): array { $data=$request->validate(['slug' => ['nullable','max:255'], 'title_uk' => ['required','max:255'], 'title_es' => ['required','max:255'], 'subtitle_uk' => ['nullable','max:255'], 'subtitle_es' => ['nullable','max:255'], 'description_uk' => ['required'], 'description_es' => ['required'], 'benefits_uk' => ['nullable'], 'benefits_es' => ['nullable'], 'composition_uk' => ['nullable'], 'composition_es' => ['nullable'], 'application_uk' => ['nullable'], 'application_es' => ['nullable'], 'image' => ['nullable','image','max:8192'], 'volume' => ['required','max:50'], 'sort_order' => ['nullable','integer','min:0'], 'featured' => ['nullable'], 'is_active' => ['nullable']]); return array_merge($data,['slug' => $this->uniqueSlug($request->input('slug') ?: $request->input('title_es'), $product), 'featured' => $request->boolean('featured'), 'is_active' => $request->boolean('is_active')]); }
    private function upload(Request $request): ?string { return $request->hasFile('image') ? $request->file('image')->store('products', 'public') : null; }

    private function uniqueSlug(?string $value, ?Product $product = null): string
    {
        $base = Str::slug($value ?: '') ?: 'product';
        $slug = Str::limit($base, 255, '');
        $suffix = 2;

        while (Product::query()
            ->when($product, fn ($query) => $query->whereKeyNot($product->getKey()))
            ->where('slug', $slug)
            ->exists()) {
            $ending = '-'.$suffix++;
            $slug = Str::limit($base, 255 - strlen($ending), '').$ending;
        }

        return $slug;
    }
}
