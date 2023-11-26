@extends('layouts.site')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 py-4 ...">
                <h1 class="font-bold text-2xl">{{ __('site_profile.title') }}</h1>
                <div class="group/item grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8 mt-2">
                    <div class="sm:col-span-6">
                        <p><b>{{ __('site_profile.name') }}:</b> {{ $client->name }} {{ $client->surname }}</p>
                        <p><b>{{ __('site_profile.email') }}:</b> {{ $client->email }}</p>
                        <p><b>{{ __('site_profile.phone') }}:</b> {{ $client->phone }}</p>
                    </div>
                    <div class="sm:col-span-1 justify-self-end self-center">
                        <a class="inline-block rounded-md bg-yellow-400 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-400"
                            href="{{ route('client.edit', $client->id_client) }}">{{ __('site_profile.update') }}</a>
                    </div>
                    <form class="sm:col-span-1 justify-self-end self-center" action="{{ route('client.delete') }}"
                        method="POST">
                        @method('DELETE')
                        @csrf

                        <input type="hidden" name="id_client" value="{{ $client->id_client }}">
                        <button type="submit" name="deleteClient" value="1"
                            class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                            {{ __('site_profile.deleteAccount') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
