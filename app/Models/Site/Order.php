<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'id_client',
        'id_seller',
        'status',
        'date',
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
     * Setting relationship with DB table OrderDetails.
     *
     * @return HasOne
     */
    public function orderDetails(): HasOne
    {
        return $this->hasOne(OrderDetails::class, 'id_order', 'id_order');
    }

    /**
     * Read all entities in DB table Orders by given Seller
     *
     * @param int $idSeller
     * @return Collection
     */
    public function readSellerOrdersWithDetails(int $idSeller): Collection
    {
        return Order::select(
                    'o.*',
                    'od.id_product',
                    'od.count',
                    'od.total',
                    'c.name as client_name',
                    'c.surname as client_surname',
                    'c.email as client_email',
                    'c.phone as client_phone')
                ->distinct()
                ->join('orders as o', 'o.id_seller', '=', $this->table . '.id_seller')
                ->join('order_details as od', 'o.id_order', '=', 'od.id_order')
                ->join('clients as c', 'o.id_client', '=', 'c.id_client')
                ->where($this->table . '.id_seller', $idSeller)
                ->orderBy('o.created_at', 'desc')
                ->get();
    }

    /**
     * Storing data into DB table Order.
     *
     * @param array $data
     * @return object
     */
    public function storeOrder(array $data): object
    {
        return Order::create($data);
    }

    /**
     * Update entity in DB table Orders
     *
     * @param int $idOrder
     * @param array $data
     */
    public function updateSellerOrders(int $idOrder, array $data): void
    {
        Order::where($this->primaryKey, $idOrder)
            ->update($data);
    }
}
