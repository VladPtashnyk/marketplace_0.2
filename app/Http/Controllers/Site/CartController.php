<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Resource\Traits\Cart;

class CartController extends Controller
{
    use Cart;

    /**
     * Adding Products to Cart.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->has('addToCart')) {
            $productModel = new Product();

            $idProduct = $request->validate(['id_product' => ['int']])['id_product'];
            $price = $request->validate(['price' => ['int']])['price'];
            $product = $productModel->readProduct($idProduct);
            $idMarketplace = $productModel->readSellerProductMarket($idProduct)->id_marketplace;
            $cartProduct = $request->session()->get('cart.products.' . $idProduct);

            // Saving cart's Products data
            $quantity = 1;
            $productTotal = $price;
            if (isset($cartProduct['id_product']) && $cartProduct['id_product'] == $idProduct) {
                $quantity = $cartProduct['quantity'] + 1;
                $productTotal = $quantity * $price;
            }
            $request->session()->put('cart.products.' . $idProduct, [
                'id_marketplace' => $idMarketplace,
                'id_seller' => $product->id_seller,
                'id_product' => $idProduct,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $productTotal,
            ]);

            // Saving cart's Markets data
            $cart = $request->session()->get('cart.products', []);
            if (!isset($totalQuantity)) {
                $totalQuantity = 0;
            }
            $marketsTotal = [];
            foreach ($cart as $cartProd) {
                $idMarket = $cartProd['id_marketplace'];
                if (!isset($marketsTotal[$idMarket])) {
                    $marketsTotal[$idMarket] = [
                        'quantity' => 0,
                        'total' => 0,
                    ];
                }
                $marketsTotal[$idMarket]['quantity'] += $cartProd['quantity'];
                $marketsTotal[$idMarket]['total'] += $cartProd['total'];
                $totalQuantity += $cartProd['quantity'];
            }
            $request->session()->put('cart.markets', $marketsTotal);
            $request->session()->put('cart.total_quantity', $totalQuantity);
        }

        return back();
    }

    /**
     * Displaying & Updating a listing of the Cart
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        if ($request->session()->missing('cart')) {
            return view('site.cart.index');
        }

        if ($request->has('id_product')) {
            $idProduct = $request->validate(['id_product' => ['int']])['id_product'];
            $product = $request->session()->get('cart.products.' . $idProduct);

            if (!is_null($product)) {
                $idMarketplace = $product['id_marketplace'];
                $newProduct = [
                    'id_marketplace' => $idMarketplace,
                    'id_seller' => $product['id_seller'],
                    'id_product' => $idProduct,
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'total' => $product['total'],
                ];

                // Setting cart product's data
                $newQuantity = $product['quantity'];
                if ($request->has('quantity')) {
                    $newQuantity = $request->validate(['quantity' => ['int']])['quantity'];
                } elseif ($request->has('plus')) {
                    $newQuantity += 1;
                } elseif ($request->has('minus') && $product['quantity'] > 1) {
                    $newQuantity -= 1;
                } elseif (($request->has('minus') && $product['quantity'] <= 1) || $request->has('remove')) {
                    // Removing cart's product & Updating cart's market
                    $request->session()->forget('cart.products.' . $idProduct);
                    unset($idProduct);
                    $marketProducts = collect($request->session()->get('cart.products', []))
                                    ->where('id_marketplace', $idMarketplace);
                    if ($marketProducts->isNotEmpty()) {
                        $marketTotal = $request->session()->get('cart.markets.' . $idMarketplace, []);
                        $marketTotal['quantity'] -= $product['quantity'];
                        $marketTotal['total'] -= $product['total'];
                        $request->session()->put('cart.markets.' . $idMarketplace, $marketTotal);
                    } else {
                        $request->session()->forget('cart.markets.' . $idMarketplace);
                    }
                }

                // Updating cart's product
                if (isset($idProduct)) {
                    $newProduct['quantity'] = $newQuantity;
                    $newProduct['total'] = $newQuantity * $product['price'];
                    $request->session()->put('cart.products.' . $idProduct, $newProduct);

                    // Updating cart's market if product is NOT removed
                    $cartMarkets = $request->session()->get('cart.markets', []);
                    if (!empty($cartMarkets)) {
                        $marketTotal = $cartMarkets[$idMarketplace];
                        $marketTotal['quantity'] = $marketTotal['quantity'] - $product['quantity'] + $newQuantity;
                        $marketTotal['total'] = $marketTotal['total'] - $product['total'] + ($newQuantity * $product['price']);
                        $request->session()->put('cart.markets.' . $idMarketplace, $marketTotal);
                    }
                }
            }

            // Updating & setting cart's total quantity
            $totalQuantity = array_sum(array_column($request->session()->get('cart.products', []), 'quantity'));
            $request->session()->put('cart.total_quantity', $totalQuantity);
        }

        // Setting data for view
        extract($this->getCartData($request));

        return view('site.cart.index', compact('products', 'cartProductsData', 'cartMarketsData', 'totalQuantity'));
    }
}
