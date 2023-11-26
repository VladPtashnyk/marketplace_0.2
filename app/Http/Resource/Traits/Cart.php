<?php

namespace App\Http\Resource\Traits;

use App\Models\Admin\Marketplace;
use App\Models\Site\Product;
use Illuminate\Http\Request;

trait Cart
{
    /**
     * Setting the Cart data for view.
     *
     * @param Request $request
     * @return array
     */
    public function getCartData(Request $request): array
    {
        $cartProducts = $request->session()->get('cart.products', []);
        $cartMarkets = $request->session()->get('cart.markets', []);
        $totalQuantity = $request->session()->get('cart.total_quantity', 0);

        // Setting cart's products data
        $idsProduct = $idsMarket = $cartProductsData = $cartMarketsData = [];
        foreach ($cartProducts as $product) {
            $idsProduct[$product['id_product']] = $product['id_product'];
            $idsMarket[$product['id_marketplace']] = $product['id_marketplace'];
            $cartProductsData[$product['id_product']]['quantity'] = $product['quantity'];
            $cartProductsData[$product['id_product']]['total'] = $product['total'];
        }

        // Setting products data
        $products = Product::whereIn('id_product', $idsProduct)->get();
        foreach ($products as $product) {
            $product->url = route('product.show', $product->id_product);
        }

        // Setting cart's markets data
        $markets = Marketplace::whereIn('id_marketplace', $idsMarket)->get();
        foreach ($cartMarkets as $idM => $cartM) {
            $cartMarketsData[$idM] = [
                'totalFormatted' => number_format($cartM['total'], 0, '.', ' '),
            ];
            $market = $markets->where('id_marketplace', $idM)->first();
            if ($market) {
                $cartMarketsData[$idM]['totalFormatted'] .= ' ' . $market->getCurrency($market->currency);
            }
        }

        return [
            'products' => $products,
            'cartProductsData' => $cartProductsData,
            'cartMarketsData' => $cartMarketsData,
            'totalQuantity' => $totalQuantity,
        ];
    }
}
