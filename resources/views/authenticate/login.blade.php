@extends('layouts.site')

@section('content')
<div class="flex min-h-full flex-col justify-center p-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h1 class="mt-4 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('site_profile.signIn') }}</h1>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('auth') }}" method="POST">
            @csrf

            <div>
                <label for="login" class="block text-sm font-medium leading-6 text-gray-900">{{ __('site_profile.emailOrPhone') }}</label>
                <div class="mt-2">
                    <input id="login" type="text" name="login" value="{{ old('login') }}" autocomplete="given-name" required
                       class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('login')
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

            <button type="submit" name="createSeller" value="1"
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                {{ __('site_profile.login') }}
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500">
            {{ __('site_profile.notYet') }}
            <a href="{{ route('registration_client') }}" class="ms-2 font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                {{ __('site_profile.signUp') }}</a>
        </p>
    </div>
</div>
@endsection
