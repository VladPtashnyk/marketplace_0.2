<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarketplaceRequest;
use App\Models\Admin\Marketplace;
use App\Models\Site\Product;
use App\Models\Site\Seller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    /**
     * Display all Marketplaces
     *
     * @return View
     */
    public function index(): View
    {
        $marketplaceModel = new Marketplace();

        $marketplaces = $marketplaceModel->readAllMarketplaces();

        return view('admin.marketplaces.index', compact('marketplaces'));
    }

    /**
     * Display Marketplace creation form
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.marketplaces.create');
    }

    /**
     * Create Marketplace
     *
     * @param MarketplaceRequest $request
     * @return RedirectResponse
     */
    public function store(MarketplaceRequest $request): RedirectResponse
    {
        if ($request->has('createMarketplace')) {
            $marketplaceModel = new Marketplace();

            $marketplaceModel->storeMarketplace($request->validated());
        }

        return redirect()->route('admin.marketplace');
    }

    /**
     * Display Marketplace update form
     *
     * @param int $idMarketplace
     * @return View
     */
    public function edit(int $idMarketplace): View
    {
        $marketplaceModel = new Marketplace();

        $marketplace = $marketplaceModel->readMarketplace($idMarketplace);

        return view('admin.marketplaces.update', compact('marketplace'));
    }

    /**
     * Update Marketplace
     *
     * @param MarketplaceRequest $request
     * @return RedirectResponse
     */
    public function update(MarketplaceRequest $request): RedirectResponse
    {
        if ($request->has('updateMarketplace')) {
            $marketplaceModel = new Marketplace();

            $marketplaceModel->updateMarketplace($request->post('id_marketplace'), $request->validated());
        }

        return redirect()->route('admin.marketplace');
    }

    /**
     * Delete Marketplace, all its Sellers & Products
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        if ($request->has('deleteMarketplace')) {
            $marketplaceModel = new Marketplace();
            $sellerModel = new Seller();
            $productModel = new Product();

            $idMarketplace = $request->post('id_marketplace');
            $idsSeller = $sellerModel->deleteMarketplaceSellers($idMarketplace);
            foreach ($idsSeller as $idSeller) {
                if ($idSeller == $request->session()->get('id_seller')) {
                    $request->session()->forget('id_seller');
                }
            }
            $productModel->deleteSellersProducts($idsSeller);
            $marketplaceModel->deleteMarketplace($idMarketplace);
        }

        return back();
    }

    /**
     * Restore Marketplace, all its Sellers & Products
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function restore(Request $request): RedirectResponse
    {
        if ($request->has('restoreMarketplace')) {
            $marketplaceModel = new Marketplace();
            $sellerModel = new Seller();
            $productModel = new Product();

            $idMarketplace = $request->post('id_marketplace');
            $marketplaceModel->restoreMarketplace($idMarketplace);
            $idsSeller = $sellerModel->restoreMarketplaceSellers($idMarketplace);
            $productModel->restoreSellerProducts($idsSeller);
        }

        return back();
    }
}
