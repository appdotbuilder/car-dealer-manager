<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\SparePartSale
 *
 * @property int $id
 * @property int $spare_part_id
 * @property int $customer_id
 * @property int $sales_person_id
 * @property int|null $service_id
 * @property string $invoice_number
 * @property int $quantity
 * @property float $unit_price
 * @property float $total_amount
 * @property \Illuminate\Support\Carbon $sale_date
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SparePart $sparePart
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\User $salesPerson
 * @property-read \App\Models\Service|null $service
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale completed()
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale query()
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereSaleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereSalesPersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereSparePartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePartSale whereUpdatedAt($value)
 * @method static \Database\Factories\SparePartSaleFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class SparePartSale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'spare_part_id',
        'customer_id',
        'sales_person_id',
        'service_id',
        'invoice_number',
        'quantity',
        'unit_price',
        'total_amount',
        'sale_date',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sale_date' => 'date',
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * Get the spare part that was sold.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sparePart(): BelongsTo
    {
        return $this->belongsTo(SparePart::class);
    }

    /**
     * Get the customer who bought the spare part.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the sales person who made the sale.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salesPerson(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_person_id');
    }

    /**
     * Get the service associated with this sale (if any).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Scope a query to only include completed sales.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}