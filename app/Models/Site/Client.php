<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Client extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_client';
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
    ];

    /**
     * Setting relationship with DB table Orders.
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'id_client', 'id_client');
    }

    /**
     * Setting relationship with DB table Orders.
     *
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'id_client', 'id_client');
    }

    /**
     * Check if loggining user exists& not soft-deleted in DB table Clients
     *
     * @param array $data
     * @return int|void
     */
    public function authClient(array $data)
    {
        $checkData = [
            'phone',
            'email',
        ];
        $client = [];
        foreach ($checkData as $field) {
            $builder = Client::select('id_client', 'name', 'surname', 'email', 'phone')
                            ->where($field, $data['login'])
                            ->get();
            foreach ($builder as $row) {
                $client = $row;
            }
        }

        if (!empty($client)) {
            $builder = DB::table('clients_passwords')
                        ->select()
                        ->where('id_client', $client->id_client)
                        ->get();
            foreach ($builder as $row) {
                if (Hash::check($data['password'], $row->password)) {
                    return $client->id_client;
                }
            }
        }
    }

    /**
     * Read all entities from DB table Clients
     *
     * @return Collection
     */
    public function readAllClients(): Collection
    {
        return Client::select(
                        Client::raw('SUM(od.count) as total_count'),
                        Client::raw('SUM(od.total) as total_amount'),
                        $this->table.'.*'
                    )
                    ->join('orders as o', $this->table.'.id_client', '=', 'o.id_client')
                    ->join('order_details as od', 'o.id_order', '=', 'od.id_order')
                    ->withTrashed()
                    ->groupBy($this->table.'.'.$this->primaryKey)
                    ->get();
    }

    /**
     * Read one entity from DB table Clients
     *
     * @param int $idClient
     * @return object
     */
    public function readClient(int $idClient): object
    {
        return Client::findOrFail($idClient);
    }

    /**
     * Insert entity into DB table Clients
     *
     * @param array $data
     * @return object
     */
    public function storeClient(array $data): object
    {
        return Client::create($data);
    }

    /**
     * Insert Client's password into DB table 'clients_passwords'
     *
     * @param array $data
     */
    public function storeClientPassword(array $data): void
    {
        DB::table('clients_passwords')
            ->insert($data);
    }

    /**
     * Update entity into DB table Clients
     *
     * @param int $idClient
     * @param array $data
     */
    public function updateClient(int $idClient, array $data): void
    {
        Client::where($this->primaryKey, $idClient)
                ->update($data);
    }

    /**
     * Update Client's password into DB table 'clients_passwords'
     *
     * @param int $idClient
     * @param array $data
     */
    public function updateClientPassword(int $idClient, array $data): void
    {
        DB::table('clients_passwords')
            ->where($this->primaryKey, $idClient)
            ->update($data);
    }

    /**
     * Soft-Delete entity in DB table Clients
     *
     * @param int $idClient
     */
    public function deleteClient(int $idClient): void
    {
        DB::table('clients_passwords')
            ->where($this->primaryKey, $idClient)
            ->update(['deleted_at' => now()]);

        Client::findOrFail($idClient)
                ->delete();
    }

    /**
     * restore entity in DB table Clients
     *
     * @param int $idClient
     */
    public function restoreClient(int $idClient): void
    {
        DB::table('clients_passwords')
            ->where($this->primaryKey, $idClient)
            ->update(['deleted_at' => null]);

        Client::onlyTrashed()
                ->findOrFail($idClient)
                ->restore();
    }
}
