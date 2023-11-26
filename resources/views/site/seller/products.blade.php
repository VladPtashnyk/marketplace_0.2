@extends('layouts.site')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center px-8">
                    <h1 class="font-bold text-2xl">{{ __('products.myProducts') }}</h1>
                    <div class="my-2">
                        <a class="inline-block rounded-md bg-green-600 px-6 py-2 text-m font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            href="{{ route('product.create') }}">{{ __('products.addProduct') }}</a>
                    </div>
                </div>

                <ul role="list">
                    @foreach ($products as $product)
                    <li
                        class="group/item grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8 py-4 sm:px-4 lg:px-8 hover:bg-slate-100 @if(!is_null($product->deleted_at)) bg-red-100 @endif ...">
                        <div class="sm:col-span-1">
                            <img class="h-24 w-24 object-contain" src="{{ $product->getFirstMediaUrl('products') }}"
                                alt="{{ $product->name . '-pic' }}">
                        </div>
                        <div class="sm:col-span-5">
                            <b class="text-xl">{{ $product->name }}</b>
                            <p><b>{{ __('products.description') }}:</b> {{ $product->description }}</p>
                            <p><b>{{ __('products.price') }}:</b> {{ $product->price }}</p>
                            <p><b>{{ __('products.amount') }}:</b> {{ $product->amount }}</p>
                        </div>
                        <div class="sm:col-span-1 justify-self-end self-center">
                            <a class="inline-block rounded-md bg-yellow-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-400"
                                href="{{ route('product.edit', $product->id_product) }}">{{ __('products.update') }}</a>
                        </div>
                        @if (is_null($product->deleted_at))
                        <form class="sm:col-span-1 justify-self-end self-center" action="{{ route('product.delete') }}"
                            method="POST">
                            @method('DELETE')
                            @csrf

                            <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                            <button type="submit" name="deleteProduct" value="1"
                                class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                {{ __('products.delete') }}
                            </button>
                        </form>
                        @else
                        <form class="sm:col-span-1 justify-self-end self-center" action="{{ route('product.restore') }}"
                            method="POST">
                            @method('PATCH')
                            @csrf

                            <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                            <button type="submit" name="restoreProduct" value="1"
                                class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                {{ __('products.restore') }}
                            </button>
                        </form>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
