@section('title', 'Редагувати категорію')

<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Редагування категорії</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><div class="p-6 text-gray-900">
        @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
        <form action="{{ route('categories.update', $category) }}" method="POST">@csrf @method('PUT')
            <div class="mb-4"><label for="name" class="form-label">Назва категорії</label><input id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}" required maxlength="50"></div>
            <button class="btn btn-success">Зберегти</button> <a class="btn btn-outline-secondary" href="{{ route('categories.index') }}">Скасувати</a>
        </form>
    </div></div></div></div>
</x-app-layout>
