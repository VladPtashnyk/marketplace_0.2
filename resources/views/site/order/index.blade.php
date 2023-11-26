@extends('layouts.site')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="m-3 text-2xl">{{ __('order.title') }}</h1>
                <ul role="list">
                    @foreach ($products as $product)
                    <li
                        class="group/item grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8 py-4 sm:px-4 lg:px-8 hover:bg-slate-100 ...">
                        <div class="sm:col-span-1">
                            <img class="h-24 w-24 object-contain" src="{{ $product->getFirstMediaUrl('products') }}"
                                alt="{{ $product->name . '-pic' }}">
                        </div>
                        <div class="sm:col-span-6">
                            <b class="text-xl">{{ $product->name }}</b>
                            <p><b>{{ __('order.price') }}</b> {{ $product->price }}</p>
                            <p><b>{{ __('order.total') }}</b> {{ $cartProductsData[$product->id_product]['total'] }}</p>
                        </div>
                        <form class="sm:col-span-1 justify-self-end self-center" action="{{ route('cart') }}"
                            method="POST">
                            @csrf

                            <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                            <button type="submit" name="remove" value="1"
                                class="rounded-md bg-orange-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600">
                                {{ __('order.remove') }}
                            </button>
                        </form>
                    </li>
                    @endforeach
                </ul>
                <form action="{{ route('order.make') }}" method="POST">
                    @csrf

                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('order.name') }}</label>
                            <div class="mt-2">
                                <input id="name" type="text" name="name" value="{{ $client->name ?? '' }}"
                                    autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('name')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-3">
                            <label for="surname"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('order.surname') }}</label>
                            <div class="mt-2">
                                <input id="surname" type="text" name="surname" value="{{ $client->surname ?? '' }}"
                                    autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('surname')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-3">
                            <label for="email"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('order.email') }}</label>
                            <div class="mt-2">
                                <input id="email" type="text" name="email" value="{{ $client->email ?? '' }}"
                                    autocomplete="given-name" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('email')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-3">
                            <label for="tel"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('order.phone') }}</label>
                            <div class="mt-2">
                                <input id="tel" type="text" name="phone" value="{{ $client->phone ?? '' }}"
                                    autocomplete="given-name" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('phone')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" name="makeOrder" value="1"
                        class="rounded-md bg-indigo-600 my-3 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        {{ __('order.confirm') }}
                    </button>
                    <span class="inline-block my-3">
                        <a class="inline-block rounded-md bg-gray-600 m-3 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                            href="{{ route('cart') }}">{{ __('order.cancel') }}</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
