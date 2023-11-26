<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\SellerRequest;
use App\Models\Admin\Marketplace;
use App\Models\Site\Client;
use App\Models\Site\Seller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GeneralController extends Controller
{
    /**
     * Switch Language.
     *
     * @return RedirectResponse
     */
    public function switchLanguage(): RedirectResponse
    {
        return redirect()->back();
    }

    /**
     * Display site's Home page.
     *
     * @return View
     */
    public function index(): View
    {
        return view('index');
    }

    /**
     * Show the form for Registering a new Seller.
     *
     * @return View
     */
    public function registerSeller(): View
    {
        $marketplaceModel = new Marketplace();

        $marketplaces = $marketplaceModel->readMarketplacesNames();

        return view('authenticate.register-seller', compact('marketplaces'));
    }

    /**
     * Show the form for Registering a new Client.
     *
     * @return View
     */
    public function registerClient(): View
    {
        return view('authenticate.register-client');
    }

    /**
     * Store a newly created Seller in storage.
     *
     * @param SellerRequest $request
     * @return RedirectResponse
     */
    public function storeSeller(SellerRequest $request): RedirectResponse
    {
        if ($request->has('createSeller')) {
            $sellerModel = new Seller();

            $idNewSeller = $sellerModel->storeSeller($request->safe()->except('password'))->id_seller;

            $setSellerPasswordData = [
                'id_seller' => $idNewSeller,
                'password' => Hash::make($request->safe()->only('password')['password']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $sellerModel->storeSellerPassword($setSellerPasswordData);

            $request->session()->put('id_seller', $idNewSeller);
        }

        return redirect()->route('auth');
    }

    /**
     * Store a newly created Client in storage.
     *
     * @param ClientRequest $request
     * @return RedirectResponse
     */
    public function storeClient(ClientRequest $request): RedirectResponse
    {
        if ($request->has('createClient')) {
            $clientModel = new Client();

            $idNewClient = $clientModel->storeClient($request->safe()->except('password'))->id_client;

            $setClientPasswordData = [
                'id_client' => $idNewClient,
                'password' => Hash::make($request->safe()->only('password')['password']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $clientModel->storeClientPassword($setClientPasswordData);

            $request->session()->put('id_client', $idNewClient);
        }

        return redirect()->route('auth');
    }

    /**
     * Login Seller / Client or lead logged one to Personal Page.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function auth(Request $request): View|RedirectResponse
    {
        if ($request->session()->has('id_seller')) {
            return redirect()->route('seller.personal');
        } elseif ($request->session()->has('id_client')) {
            return redirect()->route('client.personal');
        }

        $sellerModel = new Seller();
        $clientModel = new Client();

        $route = view('authenticate.login');

        if (!empty($request->post())) {
            $validated = $request->validate([
                'login' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'max:255'],
            ]);

            // Auth Seller
            $idAuthUser = $sellerModel->authSeller($validated);
            if (!empty($idAuthUser)) {
                $request->session()->put('id_seller', $idAuthUser);
                $route = redirect()->route('seller.personal');
            }

            // Auth Client
            $idAuthUser = $clientModel->authClient($validated);
            if (!empty($idAuthUser)) {
                $request->session()->put('id_client', $idAuthUser);
                $route = redirect()->route('client.personal');
            }
        }

        return $route;
    }

    /**
     * Logout Seller and Client from Site.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['id_seller', 'id_client']);

        return redirect()->route('index');
    }
}
