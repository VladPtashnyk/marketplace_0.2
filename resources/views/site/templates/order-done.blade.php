@extends('layouts.site')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-center">{{ __('order.done') }}</h1>
                <div class="mt-3 text-center">
                    <a class="inline-block rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                       href="{{ route('index') }}">{{ __('order.return') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
