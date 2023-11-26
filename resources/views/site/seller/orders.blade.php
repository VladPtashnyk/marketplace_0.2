@extends('layouts.site')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center px-8">
                    <h1 class="font-bold text-2xl">{{ __('seller_orders.title') }}</h1>
                </div>

                <ul role="list">
                    @foreach ($orders as $order)
                    <li class="group/item grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8 py-4 sm:px-4 lg:px-8 hover:bg-slate-100 @if($order->status == 'new') bg-green-100 @endif ...">
                        <div class="sm:col-span-7">
                            <p><b>{{ __('seller_orders.client') }}</b>
                                {{ $order->client_surname . ' ' . $order->client_name }}</p>
                            <p><b>{{ __('seller_orders.idProduct') }}</b> {{ $order->id_product }}</p>
                            <p><b>{{ __('seller_orders.count') }}</b> {{ $order->count }}</p>
                            <p><b>{{ __('seller_orders.total') }}</b> {{ $order->total }}</p>
                            <p><b>{{ __('seller_orders.status') }}</b> {{ $order->status }}</p>
                            <p><b>{{ __('seller_orders.date') }}</b> {{ $order->date }}</p>
                        </div>
                        @if($order->status != 'processed')
                        <form class="sm:col-span-1 justify-self-end self-center" action="{{ route('order.my_orders') }}"
                            method="POST">
                            @method('PATCH')
                            @csrf

                            <input type="hidden" name="id_order" value="{{ $order->id_order }}">
                            <button type="submit" name="order_accept" value="1"
                                class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                                {{ __('seller_orders.accept') }}
                            </button>
                        </form>
                        @else
                        <form class="sm:col-span-1 justify-self-end self-center" action="{{ route('order.my_orders') }}"
                            method="POST">
                            @method('PATCH')
                            @csrf

                            <input type="hidden" name="id_order" value="{{ $order->id_order }}">
                            <button type="submit" name="order_decline" value="1"
                                class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                {{ __('seller_orders.decline') }}
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
