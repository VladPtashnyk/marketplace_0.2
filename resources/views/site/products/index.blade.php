@extends('layouts.site')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
        <div class="overflow-hidden">
            <div class="mt-6 px-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">{{ __('products.title') }}</h1>
                <form class="text-right" action="{{ route('product') }}" method="POST">
                    @csrf

                    <button type="submit" name="resetFilters" value="1"
                        class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                        {{ __('products.resetFilters') }}
                    </button>
                </form>
            </div>

            {{--         Filters--}}
            <div class="py-4 px-6 text-gray-900">
                <form
                    class="group/item grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8 items-end justify-self-end self-center"
                    action="{{ route('product') }}" method="POST">
                    @csrf

                    <div class="sm:col-span-1">
                        {{ $producersSelect }}
                    </div>
                    <div class="sm:col-span-1">
                        {{ $categoriesSelect }}
                    </div>
                    <div class="sm:col-span-1">
                        {{ $subcategoriesSelect }}
                    </div>
                    <div class="sm:col-span-1">
                        {{ $sellersSelect }}
                    </div>
                    <div class="sm:col-span-1">
                        <label for="name"
                            class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.name') }}</label>
                        <input type="text" id="name" name="name" value="{{ $filters['name'] }}"
                            class="block mt-1 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    <div class="sm:col-span-1">
                        <label for="priceMin"
                            class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.minPrice') }}</label>
                        <input type="number" id="priceMin" name="price[min]" value="{{ $filters['price']['min'] }}"
                            class="block mt-1 w-full rounded-md border-0 py-1.5 text-right text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    <div class="sm:col-span-1">
                        <label for="priceMax"
                            class="block text-sm font-medium leading-6 text-gray-900">{{ __('products.maxPrice') }}</label>
                        <input type="number" id="priceMax" name="price[max]" value="{{ $filters['price']['max'] }}"
                            class="block mt-1 w-full rounded-md border-0 py-1.5 text-right text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    <div class="sm:col-span-1 justify-self-end">
                        <button type="submit" name="filter" value="1"
                            class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            {{ __('products.show') }}
                        </button>
                    </div>
                </form>

                {{--              Products--}}
                <div class="">
                    <div class="mx-auto max-w-2xl py-4 sm:py-6 lg:max-w-7xl">
                        <div
                            class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                            @foreach ($products as $product)
                            <div class="p-4 bg-white border-2 border-gray-200 rounded hover:shadow-lg">
                                <a href="{{ route('product.show', $product->id_product) }}" class="group"
                                    title="{{ __('products.view') }}">
                                    <h2 class="text-center text-lg font-bold text-gray-700">{{ $product->name }}</h2>
                                    <div
                                        class="my-2 aspect-h-1 aspect-w-1 h-48 w-full overflow-hidden rounded-lg xl:aspect-h-8 xl:aspect-w-7">
                                        <img src="{{ $product->getFirstMediaUrl('products') }}"
                                            alt="{{ $product->name . '-pic' }}"
                                            class="h-full w-full object-contain object-center group-hover:opacity-90">
                                    </div>
                                    <div class="px-2">
                                        <p><b>{{ __('products.producer') }}:</b> {{ $product->producer->name }}</p>
                                        <p><b>{{ __('products.rating') }}:</b>
                                            {{ ($product->avgRating != 0.00) ? $product->avgRating : __('products.noReviews') }}
                                        </p>
                                        <p><b>{{ __('products.price') }}:</b> {{ $product->priceFormatted }}</p>
                                    </div>
                                </a>
                                <form class="mt-2 text-right" action="{{ route('cart_store') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                    <button type="submit" name="addToCart" value="1"
                                        class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                                        {{ __('products.addToCart') }}
                                    </button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    {{ $products->withQueryString()->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
