<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryController extends Controller {
    public function index() { return view('category.index', ['categories' => Category::withCount('products')->orderBy('sort_order')->get()]); }
    public function create() { return view('category.form', ['category' => new Category]); }
    public function edit(Category $category) { return view('category.form', compact('category')); }
    public function store(Request $request) { Category::create($this->validated($request)); return redirect()->route('categories.index')->with('success', 'Категорію створено'); }
    public function update(Request $request, Category $category) { $category->update($this->validated($request)); return redirect()->route('categories.index')->with('success', 'Категорію оновлено'); }
    public function destroy(Category $category) { $category->delete(); return back()->with('success', 'Категорію видалено'); }
    private function validated(Request $r): array { $data=$r->validate(['name_uk'=>['required','max:255'],'name_es'=>['required','max:255'],'description_uk'=>['nullable'],'description_es'=>['nullable'],'icon'=>['required','max:50'],'sort_order'=>['nullable','integer','min:0']]); $data['slug']=Str::slug($r->input('slug') ?: $data['name_es']); return $data; }
}
