@extends('layouts.site')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-xl">{{ __('site_profile.editProfile') }}</h1>
                <form action="{{ route('client.update') }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.name') }}</label>
                            <div class="mt-2">
                                <input type="text" id="name" name="name" value="{{ old('name', $client->name) }}"
                                    autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('name')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-3">
                            <label for="surname"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.surname') }}</label>
                            <div class="mt-2">
                                <input type="text" id="surname" name="surname" value="{{ old('surname', $client->surname) }}"
                                    autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('surname')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="email"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.email') }}</label>
                            <div class="mt-2">
                                <input type="text" id="email" name="email" value="{{ old('email', $client->email) }}" required
                                    autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('email')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="tel"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.phone') }}</label>
                            <div class="mt-2">
                                <input type="text" id="tel" name="phone" value="{{ old('phone', $client->phone) }}" required
                                    autocomplete="given-name"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('phone')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="password"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.password') }}</label>
                            <div class="mt-2">
                                <input type="password" id="password" name="password" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('password')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="id_client" value="{{ $client->id_client }}">
                    <button type="submit" name="updateClient" value="1"
                        class="rounded-md bg-indigo-600 my-3 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        {{ __('site_profile.update') }}
                    </button>
                    <span class="inline-block my-3">
                        <a class="inline-block rounded-md bg-gray-600 m-3 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                            href="{{ route('client.personal') }}">{{ __('site_profile.cancel') }}</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
