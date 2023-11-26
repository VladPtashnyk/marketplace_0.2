@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1>{{ __('admin/categories.updateCategory') }}</h1>
                <form action="{{ route('admin.category.update') }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('admin/categories.name') }}</label>
                            <div class="mt-2">
                                <input type="text" name="name" value="{{ old('name', $category->name) }}" required id="name"
                                    autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('name')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-4">
                            <label for="description"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('admin/categories.description') }}</label>
                            <div class="mt-2">
                                <input type="text" name="description" value="{{ old('description', $category->description) }}"
                                    id="description" required autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('description')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="id_category" value="{{ $category->id_category }}">
                    <button type="submit" name="updateCategory" value="1"
                        class="rounded-md bg-indigo-600 my-3 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        {{ __('admin/categories.update') }}
                    </button>
                    <span class="inline-block my-3">
                        <a class="inline-block rounded-md bg-gray-600 m-3 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                            href="{{ route('admin.category') }}">{{ __('admin/categories.cancel') }}</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
