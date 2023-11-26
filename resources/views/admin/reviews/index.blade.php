@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center px-8">
                    <h1 class="font-bold text-2xl">{{ __('admin/reviews.title') }}</h1>
                </div>
                <ul role="list">
                    @foreach ($reviews as $review)
                    <li class="group/item grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8 py-4 sm:px-4 lg:px-8 hover:bg-slate-100 @if($review->status_id == 1) bg-yellow-100 @endif">
                        <div class="sm:col-span-7">
                            <p><b>{{ __('admin/reviews.product') }}:</b>
                                <a class="text-indigo-500 hover:text-indigo-700"
                                    href="{{ $review->product_url }}">{{ $review->product_name }}</a>
                            </p>
                            <p><b>{{ __('admin/reviews.seller') }}:</b> {{ $review->seller_name}}
                                {{ $review->seller_surname }}</p>
                            <p><b>{{ __('admin/reviews.client') }}:</b> {{ $review->client_name}}
                                {{ $review->client_surname }}</p>
                            <p><b>{{ __('admin/reviews.comment') }}:</b> {{ $review->comment }}</p>
                            <p><b>{{ __('admin/reviews.rating') }}:</b> {{ $review->rating }}</p>
                            <p><b>{{ __('admin/reviews.status') }}:</b> {{ $review->status }}</p>
                        </div>
                        <form class="sm:col-span-1 justify-self-end self-center"
                            action="{{ route('admin.review.change') }}" method="POST">
                            @method('PATCH')
                            @csrf

                            <input type="hidden" name="id_review" value="{{ $review->id_review }}">
                            @if ($review->status_id == 1)
                            <button type="submit" name="approveReview" value="1"
                                class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                {{ __('admin/reviews.approve') }}
                            </button>
                            @elseif ($review->status_id == 2)
                            <button type="submit" name="disapproveReview" value="1"
                                class="rounded-md bg-yellow-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                {{ __('admin/reviews.disapprove') }}
                            </button>
                            @elseif(!isset($review->product))
                            <button type="submit" name="deleteReview" value="1"
                                class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                {{ __('admin/reviews.delete') }}
                            </button>
                            @endif
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
