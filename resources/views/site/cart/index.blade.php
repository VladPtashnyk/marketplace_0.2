{{--@extends('layouts.site')--}}
<x-site-layout>
    <x-slot name="slot">

{{--@section('content')--}}
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="m-3 text-center text-2xl">{{ __('cart.title') }}</h1>
                @if (empty($cartProductsData))
                <p class="text-center">{{ __('cart.empty') }}</p>
                @else
                <ul role="list">
                    @foreach ($products as $product)
                    <li
                        class="group/item grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8 items-center py-4 sm:px-4 lg:px-8 hover:bg-slate-100 ...">
                        <div class="sm:col-span-1">
                            <img class="h-24 w-24 object-contain" src="{{ $product->getFirstMediaUrl('products') }}"
                                alt="{{ $product->name . '-pic' }}">
                        </div>
                        <div class="sm:col-span-4 justify-self-start">
                            <h2 class="text-xl text-blue-800"><a class="hover:text-blue-600"
                                    href="{{ $product->url }}">{{ $product->name }}</a></h2>
                            <p><b>{{ __('cart.price') }}</b> {{ $product->price }}</p>
                            <p><b>{{ __('cart.total') }}</b> {{ $cartProductsData[$product->id_product]['total'] }}</p>
                        </div>
                        <div class="sm:col-span-2 justify-self-end self-center">
                            <form class="inline-block" action="{{ route('cart') }}" method="POST">
                                @csrf

                                <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                                <button type="submit" name="plus" value="1"
                                    class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                                    +
                                </button>
                            </form>
                            <form class="inline-block" action="{{ route('cart') }}" method="POST">
                                @csrf

                                <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                                <label for="quantity"
                                    class="block mb-1 text-center font-semibold">{{ __('cart.quantity') }}</label>
                                <input type="number" name="quantity"
                                    value="{{ $cartProductsData[$product->id_product]['quantity'] }}" id="quantity"
                                    required
                                    class="inline-block text-right w-20 rounded-md font-bold border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </form>
                            <form class="inline-block" action="{{ route('cart') }}" method="POST">
                                @csrf

                                <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                                <button type="submit" name="minus" value="1"
                                    class="rounded-md bg-yellow-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-400">
                                    -
                                </button>
                            </form>
                        </div>
                        <form class="sm:col-span-1 pt-7 justify-self-end self-center" action="{{ route('cart') }}"
                            method="POST">
                            @csrf

                            <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                            <button type="submit" name="remove" value="1"
                                class="rounded-md bg-orange-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">
                                {{ __('cart.remove') }}
                            </button>
                        </form>
                    </li>
                    @endforeach
                </ul>
                <div class="flex items-center justify-between py-3 px-7">
                    <div>
                        <p class="text-lg"><b>{{ __('cart.totalQuantity') }}</b> {{ $totalQuantity }}</p>
                        @foreach($cartMarketsData as $market)
                        <p class="text-lg"><b>{{ __('cart.totalPrice') }}</b> {{ $market['totalFormatted'] }}</p>
                        @endforeach
                    </div>
                    <a class="inline-block px-5 py-3 rounded-md text-xl font-semibold text-white bg-blue-600 shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                        href="{{ route('order.create') }}">{{ __('cart.order') }}</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
{{--@endsection--}}
    </x-slot>
</x-site-layout>
