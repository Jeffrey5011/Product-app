{{-- filepath: resources/views/products/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Product') }}
        </h2>
        <a href="{{ route('products.index') }}" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
            {{ __('Back to List') }}
        </a>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">{{ __('Name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">{{ __('Price') }}</label>
                        <input type="number" name="price" value="{{ old('price') }}" step="0.01" required
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">{{ __('Description') }}</label>
                        <textarea name="description" rows="3"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">{{ __('Category') }}</label>
                        <select name="category_id" required
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                            <option value="">{{ __('Select a category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>