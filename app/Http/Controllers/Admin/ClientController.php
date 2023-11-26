<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the Clients.
     *
     * @return View
     */
    public function index(): View
    {
        $clientModel = new Client();

        $clients = $clientModel->readAllClients();

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Block specified Client in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function block(Request $request): RedirectResponse
    {
        if ($request->has('blockClient')) {
            $clientModel = new Client();

            $idClient = $request->post('id_client');
            $clientModel->deleteClient($idClient);
        }

        return back();
    }

    /**
     * Restore specified Client in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function unblock(Request $request): RedirectResponse
    {
        if ($request->has('unblockClient')) {
            $clientModel = new Client();

            $idClient = $request->post('id_client');
            $clientModel->restoreClient($idClient);
        }

        return back();
    }
}
