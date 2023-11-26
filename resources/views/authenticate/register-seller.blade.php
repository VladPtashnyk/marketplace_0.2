@extends('layouts.site')

@section('content')
<div class="flex min-h-full flex-col justify-center p-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h1 class="mt-4 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('site_profile.signUpSeller') }}</h1>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('registration_seller') }}" method="POST">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.email') }}</label>
                <div class="mt-2">
                    <input id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="email" required
                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('email')
                <div class="text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="tel" class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.phone') }}</label>
                <div class="mt-2">
                    <input id="tel" type="text" name="phone" value="{{ old('phone') }}" autocomplete="given-name" required
                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('phone')
                <div class="text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.password') }}</label>
                <div class="mt-2">
                    <input id="password" type="password" name="password" required
                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('password')
                <div class="text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.name') }}</label>
                <div class="mt-2">
                    <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="given-name"
                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('name')
                <div class="text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="surname" class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.surname') }}</label>
                <div class="mt-2">
                    <input id="surname" type="text" name="surname" value="{{ old('surname') }}" autocomplete="given-name"
                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('surname')
                <div class="text-red-400">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="marketplace" class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.marketplace') }}</label>
                <div class="mt-2">
                    <select name="id_marketplace" id="marketplace"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @foreach ($marketplaces as $marketplace)
                            <option value="{{ $marketplace->id_marketplace }}">{{ $marketplace->country }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" name="createSeller" value="1"
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                {{ __('site_profile.register') }}
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500">
            {{ __('site_profile.already') }}
            <a href="{{ route('auth') }}" class="ms-2 font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                {{ __('site_profile.signIn') }}</a>
        </p>
    </div>
</div>
@endsection
