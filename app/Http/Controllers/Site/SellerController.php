<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRequest;
use App\Models\Admin\Marketplace;
use App\Models\Site\Product;
use App\Models\Site\Seller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    /**
     * Show one Seller's personal page.
     *
     * @param Request $request
     * @return View
     */
    public function show(Request $request): View
    {
        $sellerModel = new Seller();

        $idSeller = $request->session()->get('id_seller');
        $seller = $sellerModel->readSellerWithCountry($idSeller);

        return view('profile.seller-show', compact('seller'));
    }

    /**
     * Show the form for editing the specified Seller.
     *
     * @param int $idSeller
     * @return View
     */
    public function edit(int $idSeller): View
    {
        $sellerModel = new Seller();
        $marketplaceModel = new Marketplace();

        $seller = $sellerModel->readSeller($idSeller);
        $marketplaces = $marketplaceModel->readMarketplacesNames();

        return view('profile.seller-update', compact('marketplaces', 'seller'));
    }

    /**
     * Update the specified Seller in storage.
     *
     * @param SellerRequest $request
     * @return RedirectResponse
     */
    public function update(SellerRequest $request): RedirectResponse
    {
        if ($request->has('updateSeller')) {
            $sellerModel = new Seller();

            $idSeller = $request->post('id_seller');
            $sellerModel->updateSeller($idSeller, $request->safe()->except('password'));

            $setSellerPasswordData = [
                'password' => Hash::make($request->safe()->only('password')['password']),
                'updated_at' => now(),
            ];
            $sellerModel->updateSellerPassword($idSeller, $setSellerPasswordData);
        }

        return redirect()->route('seller.personal');
    }

    /**
     * Soft-Delete specified Seller in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        if ($request->has('deleteSeller')) {
            $sellerModel = new Seller();
            $productModel = new Product();

            $idSeller = $request->post('id_seller');
            $productModel->deleteSellersProducts([$idSeller]);
            $sellerModel->deleteSeller($idSeller);
            $request->session()->forget('id_seller');
        }

        return redirect()->route('index');
    }
}
