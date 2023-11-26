@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1>{{ __('admin/producers.createProducer') }}</h1>
                <form action="{{ route('admin.producer.store') }}" method="POST">
                    @csrf

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="name"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('admin/producers.name') }}</label>
                            <div class="mt-2">
                                <input type="text" name="name" value="{{ old('name') }}" id="name" autocomplete="given-name" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('name')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="address"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('admin/producers.address') }}</label>
                            <div class="mt-2">
                                <input type="text" name="address" value="{{ old('address') }}" id="address" autocomplete="given-name" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('address')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="contacts"
                                class="block text-sm font-medium leading-6 text-gray-900">{{ __('admin/producers.contacts') }}</label>
                            <div class="mt-2">
                                <input type="text" name="contacts" value="{{ old('contacts') }}" id="contacts" autocomplete="given-name" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('contacts')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" name="createProducer" value="1"
                        class="rounded-md bg-indigo-600 my-3 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        {{ __('admin/producers.create') }}
                    </button>
                    <span class="inline-block my-3">
                        <a class="inline-block rounded-md bg-gray-600 m-3 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600"
                            href="{{ route('admin.producer') }}">{{ __('admin/producers.cancel') }}</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
