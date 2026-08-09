@section('title') Створити продукт @endsection


<x-app-layout>
    <div class="py-12 pb-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="title" class="form-label">Назва продукту</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Опис</label>
                            <div id="editor-container" data-image-upload-url="{{ route('products.description-images.store') }}"></div>
                            <small class="form-text text-muted">Кнопка зображення в панелі редактора завантажує файл з комп’ютера.</small>
                            <input type="hidden" name="description" id="description">
                            <span id="old-description-value" style="display: none;">{{ old('description') }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Ціна</label>
                            <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}">
                        </div>
                        <div class="mb-3">
                            <label for="new_price" class="form-label text-danger">Акційна ціна</label>
                            <input type="number" name="new_price" class="form-control text-danger" id="new_price" value="{{ old('new_price') }}">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Кількість</label>
                            <input type="number" name="quantity" class="form-control" id="quantity" value="{{ old('quantity') }}">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Категорія</label>
                            <select name="category_id[]" class="form-select" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Зображення</label>
                            <input type="file" name="thumbnail" class="form-control" id="thumbnail">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Зберегти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
