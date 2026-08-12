@extends('layouts.app')

@section('content')
<div class="admin-title row">
    <div>
        <span>PRODUCT</span>
        <h1>{{ $product->exists ? 'Редагування' : 'Новий продукт' }}</h1>
    </div>
    <a href="{{ route('products.index') }}">← Назад</a>
</div>

<form class="admin-form" method="POST" enctype="multipart/form-data" action="{{ $product->exists ? route('products.update', $product) : route('products.store') }}">
    @csrf
    @if($product->exists) @method('PUT') @endif

    <div class="form-card">
        <h2>Основне</h2>
        <div class="fields two">
            <label>Назва (UA)<input name="title_uk" value="{{ old('title_uk', $product->title_uk) }}" required></label>
            <label>Nombre (ES)<input name="title_es" value="{{ old('title_es', $product->title_es) }}" required></label>
            <label>Підзаголовок (UA)<input name="subtitle_uk" value="{{ old('subtitle_uk', $product->subtitle_uk) }}"></label>
            <label>Subtítulo (ES)<input name="subtitle_es" value="{{ old('subtitle_es', $product->subtitle_es) }}"></label>
            <label>Slug<input name="slug" value="{{ old('slug', $product->slug) }}" placeholder="генерується автоматично"></label>
            <label>Фасування<input name="volume" value="{{ old('volume', $product->volume ?: '5 L') }}"></label>
        </div>
        <label>Категорії
            <select name="category_ids[]" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(in_array($category->id, old('category_ids', $product->categories->pluck('id')->all())))>{{ $category->name_uk }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div class="form-card">
        <h2>Контент</h2>
        <div class="locale-tabs"><span>Українська</span><span>Español</span></div>
        <div class="fields two">
            <label>Опис (UA)<textarea name="description_uk" rows="6" required>{{ old('description_uk', $product->description_uk) }}</textarea></label>
            <label>Descripción (ES)<textarea name="description_es" rows="6" required>{{ old('description_es', $product->description_es) }}</textarea></label>
            <label>Переваги (по рядку)<textarea name="benefits_uk" rows="5">{{ old('benefits_uk', $product->benefits_uk) }}</textarea></label>
            <label>Beneficios (uno por línea)<textarea name="benefits_es" rows="5">{{ old('benefits_es', $product->benefits_es) }}</textarea></label>
            <label>Склад<textarea name="composition_uk" rows="4">{{ old('composition_uk', $product->composition_uk) }}</textarea></label>
            <label>Composición<textarea name="composition_es" rows="4">{{ old('composition_es', $product->composition_es) }}</textarea></label>
            <label>Застосування<textarea name="application_uk" rows="4">{{ old('application_uk', $product->application_uk) }}</textarea></label>
            <label>Aplicación<textarea name="application_es" rows="4">{{ old('application_es', $product->application_es) }}</textarea></label>
        </div>
    </div>

    <div class="form-card">
        <h2>Публікація</h2>
        <div class="fields two">
            <label>Зображення
                <input type="file" name="image" accept="image/*">
                @if($product->image_url)
                    <img class="admin-product-preview" src="{{ $product->image_url }}" alt="{{ $product->title_uk }}">
                @endif
            </label>
            <label>Порядок<input type="number" name="sort_order" value="{{ old('sort_order', $product->sort_order ?: 0) }}"></label>
        </div>
        <div class="checks">
            <label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->exists ? $product->is_active : true))> Опубліковано</label>
            <label><input type="checkbox" name="featured" value="1" @checked(old('featured', $product->featured))> Показувати на головній</label>
        </div>
    </div>

    <button class="admin-btn" type="submit">Зберегти продукт</button>
</form>
@endsection
