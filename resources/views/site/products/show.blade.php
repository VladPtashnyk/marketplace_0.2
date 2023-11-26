@extends('layouts.site')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center px-8">
                    <h1 class="font-bold text-2xl">{{ $product->name }}</h1>
                    <div class="sm:col-span-1 justify-self-end self-center">
                        <a class="inline-block my-2 rounded-md bg-gray-400 px-3 py-2 text-lg font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-400"
                            href="{{ route('product') }}">{{ __('products.back') }}</a>
                    </div>
                </div>
                <div class="group/item grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8 py-4 sm:px-4 lg:px-8 ...">
                    <div class="sm:col-span-2">
                        @foreach($product->getMedia('products') as $item)
                        <img class="h-48 w-48 object-contain" src="{{ $item->getUrl() }}"
                            alt="{{ $product->name . '-pic' }}">
                        @endforeach
                    </div>
                    <div class="sm:col-span-5 py-2">
                        <p><b>{{ __('products.producer') }}:</b> {{ $product->producer->name }}</p>
                        <p><b>{{ __('products.category') }}: </b>{{ ucfirst($product->category->name) }}</p>
                        <p><b>{{ __('products.seller') }}:</b> {{ $product->seller->name }}
                            {{ $product->seller->surname }}</p>
                        <p><b>{{ __('products.description') }}:</b> {{ $product->description }}</p>
                        <p><b>{{ __('products.rating') }}:</b>
                            {{ ($product->avgRating != 0.00) ? $product->avgRating : __('products.noReviews') }}</p>
                        <p><b>{{ __('products.price') }}:</b> {{ $product->priceFormatted }}</p>
                    </div>
                    <form class="sm:col-span-1 justify-self-end self-center" action="{{ route('cart_store') }}"
                        method="POST">
                        @csrf

                        <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <button type="submit" name="addToCart" value="1"
                            class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                            {{ __('products.addToCart') }}
                        </button>
                    </form>
                </div>

                {{--                    Reviews--}}
                <div class="mt-4">
                    <h2 class="text-xl font-bold leading-6 text-gray-900">{{ __('products.reviews') }}</h2>
                    <ul role="list" class="divide-y divide-gray-100">
                        @foreach($product->reviews as $review)
                        <li class="flex justify-between gap-x-6 py-3 shadow-sm">
                            @if(!isset($editReviewId) || ($editReviewId != $review->id_review))
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class="text-base leading-5 text-gray-500">{{ $review->client->name }}
                                        {{ $review->client->surname }}
                                        <span
                                            class="inline-block ms-8 text-xs font-normal text-gray-500">{{ $review->updated_at ?? '' }}</span>
                                    </p>
                                    <p class="mt-1 truncate text-lg font-base leading-6 text-gray-900">
                                        {{ $review->comment }}</p>
                                    @if(isset($client_id) && $client_id == $review->client->id_client)
                                    <form action="{{ route('review.update') }}" method="POST" class="inline-block">
                                        @method('PATCH')
                                        @csrf

                                        <input type="hidden" name="id_review" value="{{ $review->id_review }}">
                                        <button type="submit" name="editReview" value="1"
                                            class="rounded-md mt-2 px-3 py-1 text-sm font-semibold text-white bg-yellow-500 shadow-sm hover:bg-yellow-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600">
                                            {{ __('products.edit') }}</button>
                                    </form>
                                    <form action="{{ route('review.destroy') }}" method="POST" class="inline-block">
                                        @method('DELETE')
                                        @csrf

                                        <input type="hidden" name="id_review" value="{{ $review->id_review }}">
                                        <button type="submit" name="deleteReview" value="1"
                                            class="rounded-md mt-2 ms-2 px-3 py-1 text-sm font-semibold text-white bg-red-500 shadow-sm hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                            {{ __('products.delete') }}</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            <div class="shrink-0 sm:flex sm:flex-col sm:items-center">
                                <p class="mt-1 text-sm leading-5 text-gray-500">{{ __('products.rating') }}</p>
                                <p class="text-xl font-bold">{{ $review->rating }}</p>
                            </div>
                            @else
                            <form action="{{ route('review.update') }}" method="POST" class="w-full">
                                @method('PATCH')
                                @csrf

                                <input type="hidden" name="id_review" value="{{ $review->id_review }}">
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                    <div class="me-2">
                                        <label for="rating_{{ $i }}" class="block w-5 h-5 font-semibold text-center">{{ $i }}</label>
                                        <input id="rating_{{ $i }}" type="radio" name="rating"
                                               value="{{ $i }}" {{ (old('rating', $review->rating) == $i) ? 'checked' : '' }} class="inline-block w-5 h-5">
                                    </div>
                                    @endfor
                                </div>
                                @error('rating')
                                <div class="text-red-400">{{ $message }}</div>
                                @enderror
                                <label for="review"
                                    class="block mt-2 text-sm font-medium leading-6 text-gray-900">{{ __('products.writeReview') }}</label>
                                <textarea id="review" name="comment" cols="30" rows="3" required style="max-height: 200px;"
                                    class="block w-full rounded-md border-0 py-1.5 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        {{ old('comment', $review->comment) }}
                                </textarea>
                                @error('comment')
                                <div class="text-red-400">{{ $message }}</div>
                                @enderror
                                <button type="submit" name="updateReview" value="1"
                                    class="rounded-md mt-2 px-3 py-1 text-sm font-semibold text-white bg-blue-500 shadow-sm hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                    {{ __('products.update') }}</button>
                                <button type="submit" name="cancelReview" value="1"
                                    class="rounded-md mt-2 ms-2 px-3 py-1 text-sm font-semibold text-white bg-gray-400 shadow-sm hover:bg-gray-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">
                                    {{ __('products.cancel') }}</button>
                            </form>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @if(isset($client_id) && (!isset($editReviewId) || ($editReviewId != $review->id_review)))
                    <form action="{{ route('review.add') }}" method="POST">
                        @csrf

                        <div class="mt-3">
                            <p>{{ __('products.rateProduct') }}</p>
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="me-2">
                                        <label for="rating_{{ $i }}" class="block w-5 h-5 font-semibold text-center">{{ $i }}</label>
                                        <input id="rating_{{ $i }}" type="radio" name="rating" value="{{ $i }}"
                                        {{ ($i == old('rating')) ? 'checked' : '' }} class="inline-block w-5 h-5">
                                    </div>
                                @endfor
                            </div>
                            @error('rating')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-span-full">
                            <label for="review"
                                class="mt-2 block text-sm font-medium leading-6 text-gray-900">{{ __('products.writeReview') }}</label>
                            <textarea id="review" name="comment" cols="30" rows="3" required style="max-height: 200px;"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('comment') }}</textarea>
                            @error('comment')
                            <div class="text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                        <button type="submit" name="addReview" value="1"
                            class="rounded-md mt-2 px-3 py-2 text-sm font-semibold text-white bg-blue-600 shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            {{ __('products.addReview') }}
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
