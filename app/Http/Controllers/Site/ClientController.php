<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Site\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Show one Client's personal page.
     *
     * @param Request $request
     * @return View
     */
    public function show(Request $request): View
    {
        $clientModel = new Client();

        $idClient = $request->session()->get('id_client');
        $client = $clientModel->readClient($idClient);

        return view('profile.client-show', compact('client'));
    }

    /**
     * Show the form for editing the specified Client.
     *
     * @param int $idClient
     * @return View
     */
    public function edit(int $idClient): View
    {
        $clientModel = new Client();

        $client = $clientModel->readClient($idClient);

        return view('profile.client-update', compact('client'));
    }

    /**
     * Update the specified Client in storage.
     *
     * @param ClientRequest $request
     * @return RedirectResponse
     */
    public function update(ClientRequest $request): RedirectResponse
    {
        if ($request->has('updateClient')) {
            $clientModel = new Client();

            $idClient = $request->post('id_client');
            $clientModel->updateClient($idClient, $request->safe()->except('password'));

            $setClientPasswordData = [
                'password' => Hash::make($request->safe()->only('password')['password']),
                'updated_at' => now(),
            ];
            $clientModel->updateClientPassword($idClient, $setClientPasswordData);
        }

        return redirect()->route('client.personal');
    }

    /**
     * Soft-Delete specified Client in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        if ($request->has('deleteClient')) {
            $clientModel = new Client();

            $idClient = $request->post('id_client');
            $clientModel->deleteClient($idClient);
            $request->session()->forget('id_client');
        }

        return redirect()->route('index');
    }
}
