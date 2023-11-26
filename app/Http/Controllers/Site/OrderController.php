<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resource\Traits\Cart;
use App\Models\Site\Client;
use App\Models\Site\Order;
use App\Models\Site\OrderDetails;
use App\Models\Site\Seller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use Cart;

    /**
     * Display a listing of the Orders to given Seller.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $sellerModel = new Seller();
        $orderModel = new Order();

        $idSeller = $request->session()->get('id_seller');
        $seller = $sellerModel->readSeller($idSeller);
        $orders = $orderModel->readSellerOrdersWithDetails($idSeller);

        return view('site.seller.orders', compact('seller', 'orders'));
    }

    /**
     * Show the form for creating a new Order.
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        $clientModel = new Client();

        $idClient = $request->session()->get('id_client');
        if ($idClient) {
            $client = $clientModel->readClient($idClient);
        } else {
            $client = null;
        }

        extract($this->getCartData($request));

        return view('site.order.index', compact('client', 'products', 'cartProductsData', 'cartMarketsData', 'totalQuantity'));
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param Request $request
     * @return View
     */
    public function store(Request $request): View
    {
        $orderModel = new Order();
        $orderDetailsModel = new OrderDetails();

        /** Register new client or use existing:
         * If a customer with the given email doesn't exist, create a new one;
         * otherwise, only retrieve the ID of the existing customer.
         */
        $client = Client::firstOrCreate([
            'email' => $request->validate(['email' => ['string', 'email']])['email'],
        ],
        [
            'phone' => $request->validate(['phone' => ['int', 'regex:/^[0-9]{10,14}$/']])['phone'],
            'name' => $request->validate(['name' => ['string', 'max:255']])['name'],
            'surname' => $request->validate(['surname' => ['string', 'max:255']])['surname'],
        ]);
        // Additionally, if the existing customer's data from the form is different, update it in the DB.
        $client->email = $request->validate(['email' => ['string', 'email']])['email'];
        $client->phone = $request->validate(['phone' => ['int', 'regex:/^[0-9]{10,14}$/']])['phone'];
        $client->name = $request->validate(['name' => ['string', 'max:255']])['name'];
        $client->surname = $request->validate(['surname' => ['string', 'max:255']])['surname'];
        if ($client->isDirty()) {
            $client->save();
        }
        $idClient = $client->id_client;

        // Forming Order's data
        $cartData = $request->session()->get('cart');
        if (!empty($cartData) && $request->has('makeOrder')) {
            foreach ($cartData['products'] as $product) {
                $orderData = [
                    'id_client' => $idClient,
                    'id_seller' => $product['id_seller'],
                    'status' => 'new',
                    'date' => now(),
                ];
                $idNewOrder = $orderModel->storeOrder($orderData)->id_order;

                $orderDetailsData = [
                    'id_order' => $idNewOrder,
                    'id_product' => $product['id_product'],
                    'count' => $product['quantity'],
                    'total' => $product['total'],
                ];
                $orderDetailsModel->storeOrderDetails($orderDetailsData);
            }
            $request->session()->forget('cart');
        }

        return view('site.templates.order-done');
    }

    /**
     * Update active Orders by given Seller.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $orderModel = new Order();

        $idOrder = $request->validate(['id_order' => ['int']])['id_order'];
        if ($request->has('order_accept')) {
            $orderModel->updateSellerOrders($idOrder, ['status' => 'processed']);
        } elseif ($request->has('order_decline')) {
            $orderModel->updateSellerOrders($idOrder, ['status' => 'declined']);
        }

        return redirect()->route('order.my_orders');
    }
}
