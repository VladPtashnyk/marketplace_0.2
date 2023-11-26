<?php

namespace App\Http\Resource\Traits;

use Illuminate\Http\Request;

trait Products
{
    /**
     * Forming the filters for Products.
     *
     * @param Request $request
     * @return mixed
     */
    public function getFilters(Request $request): mixed
    {
        $filters = [
            'id_producer' => 0,
            'id_category' => 0,
            'id_subcategory' => 0,
            'id_seller' => 0,
            'name' => '',
            'price' => [
                'min' => '',
                'max' => '',
            ],
        ];

        if ($request->has('id_producer')) {
            $request->session()->put('filters.id_producer', $request->input('id_producer'));
        }
        if ($request->has('id_category')) {
            $request->session()->put('filters.id_category', $request->input('id_category'));
        }
        if ($request->has('id_subcategory')) {
            $request->session()->put('filters.id_subcategory', $request->input('id_subcategory'));
        }
        if ($request->has('id_seller')) {
            $request->session()->put('filters.id_seller', $request->input('id_seller'));
        }
        if ($request->has('name')) {
            $request->session()->put('filters.name', $request->input('name'));
        }
        if ($request->has('price')) {
            $request->session()->put('filters.price.min', $request->input('price.min'));
            $request->session()->put('filters.price.max', $request->input('price.max'));
        }

        if ($request->input('resetFilters')) {
            $request->session()->forget('filters');
        }

        if (!empty($request->session()->get('filters'))) {
            $filters = $request->session()->get('filters');
        }

        return $filters;
    }

    /**
     * Prepare Product for view.
     *
     * @param object $product
     * @return object
     */
    public function formatProduct(object $product): object
    {
        // Show only approved reviews
        $product->reviews = $product->reviews->where('status', 2);

        // Calculating Product's Rating
        $ratingSum = 0;
        $ratingCount = count($product->reviews);
        foreach ($product->reviews as $review) {
            $ratingSum += $review->rating;
        }
        $avgRating = !empty($ratingCount) ? $ratingSum / $ratingCount : 0;
        $product->avgRating = number_format($avgRating, 2);

        // Formatting price
        $marketplace = $product->seller->marketplace;
        $product->priceFormatted = number_format($product->price, 0, '.', ' ')
            . ' '. $marketplace->getCurrency($marketplace->currency);

        return $product;
    }
}
