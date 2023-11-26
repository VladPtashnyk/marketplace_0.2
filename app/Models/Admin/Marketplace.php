<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marketplace extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'marketplaces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_marketplace';
    protected $fillable = [
        'country_code',
        'country',
        'currency',
    ];

    /**
     * Read all entities from DB table Marketplaces
     *
     * @return Collection
     */
    public function readAllMarketplaces(): Collection
    {
        return Marketplace::withTrashed()->get();
    }

    /**
     * Read all active entities' names in DB table Marketplaces
     *
     * @return Collection
     */
    public function readMarketplacesNames(): Collection
    {
        return Marketplace::select('id_marketplace', 'country')
                            ->get();
    }

    /**
     * Read one entity from DB table Marketplaces
     *
     * @param int $idProducer
     * @return object
     */
    public function readMarketplace(int $idProducer): object
    {
        return Marketplace::findOrFail($idProducer);
    }

    /**
     * Insert entity into DB table Marketplaces
     *
     * @param array $data
     * @return object
     */
    public function storeMarketplace(array $data): object
    {
        return Marketplace::create($data);
    }

    /**
     * Insert entity into DB table Marketplaces
     *
     * @param int $idMarketplace
     * @param array $data
     */
    public function updateMarketplace(int $idMarketplace, array $data): void
    {
        Marketplace::where($this->primaryKey, $idMarketplace)
                    ->update($data);
    }

    /**
     * Soft-Delete entity in DB table Marketplaces
     *
     * @param int $idMarketplace
     */
    public function deleteMarketplace(int $idMarketplace): void
    {
        Marketplace::findOrFail($idMarketplace)
                    ->delete();
    }

    /**
     * Restore entity in DB table Marketplaces
     *
     * @param int $idMarketplace
     */
    public function restoreMarketplace(int $idMarketplace): void
    {
        Marketplace::onlyTrashed()
                    ->find($idMarketplace)
                    ->restore();
    }

    /**
     * Get currency symbol based on Marketplace (country)
     *
     * @param string $currency
     * @return string
     */
    public function getCurrency(string $currency): string
    {
        $currencies = [
            'UAH' => '₴',
            'USD' => '$',
            'GBP' => '£',
        ];

        return $currencies[$currency];
    }
}
