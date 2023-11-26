<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_review';
    protected $fillable = [
        'id_client',
        'id_product',
        'comment',
        'rating',
        'status',
    ];

    /**
     * Setting relationship with DB table Seller.
     *
     * @return BelongsTo
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'id_seller', 'id_seller');
    }

    /**
     * Setting relationship with DB table Client.
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'id_client', 'id_client');
    }

    /**
     * Setting relationship with DB table Product.
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }

    /**
     * Read chosen entity from DB table Reviews
     *
     * @param int $idReview
     * @return object
     */
    public function readReview(int $idReview): object
    {
        return Review::findOrFail($idReview);
    }

    /**
     * Read all entities from DB table Reviews
     *
     * @return Collection
     */
    public function readAllReview(): Collection
    {
        return Review::all();
    }

    /**
     * Insert entity into DB table Reviews
     *
     * @param array $data
     */
    public function storeReview(array $data): void
    {
        Review::create($data);
    }

    /**
     * Insert entity into DB table Reviews
     *
     * @param int $idReview
     * @param array $data
     */
    public function updateReview(int $idReview, array $data): void
    {
        Review::where($this->primaryKey, $idReview)
                ->update($data);
    }

    /**
     * Delete entity from DB table Reviews
     *
     * @param int $idReview
     */
    public function destroyReview(int $idReview): void
    {
        Review::where($this->primaryKey, $idReview)
                ->delete();
    }
}
