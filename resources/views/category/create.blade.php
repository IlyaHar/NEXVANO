@section('title') Створити категорію @endsection

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Назва категорії</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Зберегти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
