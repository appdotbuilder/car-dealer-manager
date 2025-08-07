<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Sale
 *
 * @property int $id
 * @property int $car_id
 * @property int $customer_id
 * @property int $sales_person_id
 * @property string $sale_number
 * @property float $sale_price
 * @property float $down_payment
 * @property float $trade_in_value
 * @property float $financing_amount
 * @property float $tax_amount
 * @property float $total_amount
 * @property string $payment_method
 * @property string $status
 * @property \Illuminate\Support\Carbon $sale_date
 * @property \Illuminate\Support\Carbon|null $delivery_date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Car $car
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\User $salesPerson
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Sale completed()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereDownPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereFinancingAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereSaleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereSaleNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereSalesPersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTradeInValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUpdatedAt($value)
 * @method static \Database\Factories\SaleFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'car_id',
        'customer_id',
        'sales_person_id',
        'sale_number',
        'sale_price',
        'down_payment',
        'trade_in_value',
        'financing_amount',
        'tax_amount',
        'total_amount',
        'payment_method',
        'status',
        'sale_date',
        'delivery_date',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sale_date' => 'date',
        'delivery_date' => 'date',
        'sale_price' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'trade_in_value' => 'decimal:2',
        'financing_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the car that was sold.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Get the customer who bought the car.
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