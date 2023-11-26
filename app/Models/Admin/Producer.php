<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producer extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'producers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_producer';
    protected $fillable = [
        'name',
        'address',
        'contacts',
    ];

    /**
     * Read all entities from DB table Producers
     *
     * @return Collection
     */
    public function readAllProducers(): Collection
    {
        return Producer::withTrashed()->get();
    }

    /**
     * Read all entities' ids & names from DB table Producers
     *
     * @return Collection
     */
    public function readProducersNames(): Collection
    {
        return Producer::all([$this->primaryKey, 'name']);
    }

    /**
     * Read one entity from DB table Producers
     *
     * @param int $idProducer
     * @return object
     */
    public function readProducer(int $idProducer): object
    {
        return Producer::find($idProducer);
    }

    /**
     * Insert entity into DB table Producers
     *
     * @param array $data
     * @return object
     */
    public function storeProducer(array $data): object
    {
        return Producer::create($data);
    }

    /**
     * Insert entity into DB table Producers
     *
     * @param int $idProducer
     * @param array $data
     */
    public function updateProducer(int $idProducer, array $data): void
    {
        Producer::where($this->primaryKey, $idProducer)
                ->update($data);
    }

    /**
     * Soft-Delete entity in DB table Producers
     *
     * @param int $idProducer
     */
    public function deleteProducer(int $idProducer): void
    {
        Producer::findOrFail($idProducer)
                ->delete();
    }

    /**
     * Restore entity in DB table Producers
     *
     * @param int $idProducer
     */
    public function restoreMarketplace(int $idProducer): void
    {
        Producer::onlyTrashed()
                ->find($idProducer)
                ->restore();
    }
}
