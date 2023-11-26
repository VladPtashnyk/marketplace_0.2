@extends('layouts.site')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1>{{ __('products.addProduct') }}</h1>
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id_seller" value="{{ $idSeller }}">
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.name') }}</label>
                            <div class="mt-2">
                                <input type="text" name="name" value="{{ old('name') }}" id="name" autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('name')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="description"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.description') }}</label>
                            <div class="mt-2">
                                <input type="text" name="description" value="{{ old('description') }}" id="description" autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('description')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-1">
                            <label for="price"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.price') }}</label>
                            <div class="mt-2">
                                <input type="number" name="price" value="{{ old('price') }}" id="price" autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('price')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-1">
                            <label for="amount"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.amount') }}</label>
                            <div class="mt-2">
                                <input type="number" name="amount" value="{{ old('amount') }}" id="amount" autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('amount')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="producer"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.producer') }}</label>
                            <div class="mt-2">
                                <select name="id_producer" id="producer"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    @foreach ($producers as $producer)
                                    <option value="{{ $producer->id_producer }}">{{ $producer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="category"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.category') }}</label>
                            <div class="mt-2">
                                <select name="id_category" id="category"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id_category }}">{{ ucfirst($category->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="subcategory"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.subcategory') }}</label>
                            <div class="mt-2">
                                <select name="id_subcategory" id="subcategory"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id_subcategory }}">{{ ucfirst($subcategory->name) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="image"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.image') }}</label>
                            <div class="mt-2">
                                <input type="file" name="images[]" multiple>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="createProduct" value="1"
                        class="rounded-md bg-indigo-600 my-3 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        {{ __('products.add') }}
                    </button>
                    <span class="inline-block my-3">
                        <a class="inline-block rounded-md bg-gray-600 m-3 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                            href="{{ route('product.my_products') }}">{{ __('products.cancel') }}</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
