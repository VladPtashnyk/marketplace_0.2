<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site\Product;
use App\Models\Site\Seller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display a listing of the Sellers.
     *
     * @return View
     */
    public function index(): View
    {
        $sellerModel = new Seller();

        $sellers = $sellerModel->readAllSellers();

        return view('admin.sellers.index', compact('sellers'));
    }

    /**
     * Block the specified Seller in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function block(Request $request): RedirectResponse
    {
        if ($request->has('blockSeller')) {
            $sellerModel = new Seller();
            $productModel = new Product();

            $idSeller = $request->post('id_seller');
            $productModel->deleteSellersProducts([$idSeller]);
            $sellerModel->deleteSeller($idSeller);
        }

        return back();
    }

    /**
     * Restore the specified Seller in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function unblock(Request $request): RedirectResponse
    {
        if ($request->has('unblockSeller')) {
            $sellerModel = new Seller();
            $productModel = new Product();

            $idSeller = $request->post('id_seller');
            $sellerModel->restoreSeller($idSeller);
            $productModel->restoreSellerProducts([$idSeller]);
        }

        return back();
    }
}
