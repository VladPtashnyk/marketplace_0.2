@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center px-8">
                    <h1 class="font-bold text-2xl">{{ __('admin/sellers.title') }}</h1>
                </div>
                <ul role="list">
                    @foreach ($sellers as $seller)
                    <li
                        class="group/item grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8 py-4 sm:px-4 lg:px-8 hover:bg-slate-100 @if(!is_null($seller->deleted_at)) bg-red-100 @endif ...">
                        <div class="sm:col-span-7">
                            <b class="text-xl">{{ $seller->name }} {{ $seller->surname }}</b>
                            <p><b>{{ __('admin/sellers.marketplace') }}:</b> {{ $seller->country }}</p>
                            <p><b>{{ __('admin/sellers.email') }}:</b> {{ $seller->email }}</p>
                            <p><b>{{ __('admin/sellers.phone') }}:</b> {{ $seller->phone }}</p>
                        </div>
                        @if (!is_null($seller->deleted_at))
                        <form class="sm:col-span-1 justify-self-end self-center"
                            action="{{ route('admin.seller.unblock') }}" method="POST">
                            @method('PATCH')
                            @csrf

                            <input type="hidden" name="id_seller" value="{{ $seller->id_seller }}">
                            <button type="submit" name="unblockSeller" value="1"
                                class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                {{ __('admin/sellers.unblock') }}
                            </button>
                        </form>
                        @else
                        <form class="sm:col-span-1 justify-self-end self-center"
                            action="{{ route('admin.seller.block') }}" method="POST">
                            @method('DELETE')
                            @csrf

                            <input type="hidden" name="id_seller" value="{{ $seller->id_seller }}">
                            <button type="submit" name="blockSeller" value="1"
                                class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                {{ __('admin/sellers.block') }}
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
