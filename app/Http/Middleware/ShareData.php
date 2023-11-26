<?php

namespace App\Http\Middleware;

use App\Models\Site\Client;
use App\Models\Site\Seller;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareData
{
    /**
     * Always show User's data in all view pages
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Active User's data
        if ($request->session()->has('id_seller')) {
            $idSeller = $request->session()->get('id_seller');
            $sellerName = Seller::find($idSeller)->name;
            View::share('seller_id', $idSeller);
            View::share('seller_name', $sellerName);
        } elseif ($request->session()->has('id_client')) {
            $idClient = $request->session()->get('id_client');
            $clientName = Client::find($idClient)->name;
            View::share('client_id', $idClient);
            View::share('client_name', $clientName);
        }

        // Total number of products in Cart
        View::share('cartNum', $request->session()->get('cart.total_quantity'));

        // Key for Edit Review
        View::share('editReviewId', $request->session()->get('editReviewId'));

        return $next($request);
    }
}
