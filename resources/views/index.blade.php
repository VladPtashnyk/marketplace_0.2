@extends('layouts.site')

@section('content')
<div class="p-6">
    <h1 class="text-center">{{ __('index.welcome') }}, <b>{{ $seller_name ?? $client_name ?? __('index.guest') }}</b></h1>
</div>
@endsection
