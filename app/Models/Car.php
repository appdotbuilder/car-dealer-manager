<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Car
 *
 * @property int $id
 * @property string $vin
 * @property string $make
 * @property string $model
 * @property int $year
 * @property string $color
 * @property string $condition
 * @property float $mileage
 * @property string $fuel_type
 * @property string $transmission
 * @property int $doors
 * @property string|null $engine_size
 * @property float $purchase_price
 * @property float $selling_price
 * @property \Illuminate\Support\Carbon $purchase_date
 * @property \Illuminate\Support\Carbon|null $sale_date
 * @property string $status
 * @property string|null $description
 * @property string|null $features
 * @property array|null $images
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Sale|null $sale
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sale> $sales
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Car available()
 * @method static \Illuminate\Database\Eloquent\Builder|Car newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Car query()
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereDoors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereEngineSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereFuelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereMake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereMileage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car wherePurchasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereSaleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereTransmission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereVin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Car whereYear($value)
 * @method static \Database\Factories\CarFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'vin',
        'make',
        'model',
        'year',
        'color',
        'condition',
        'mileage',
        'fuel_type',
        'transmission',
        'doors',
        'engine_size',
        'purchase_price',
        'selling_price',
        'purchase_date',
        'sale_date',
        'status',
        'description',
        'features',
        'images',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'purchase_date' => 'date',
        'sale_date' => 'date',
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'mileage' => 'decimal:2',
        'images' => 'array',
        'year' => 'integer',
        'doors' => 'integer',
    ];

    /**
     * Get all sales for this car.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get the current sale for this car.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class)->where('status', 'completed');
    }

    /**
     * Scope a query to only include available cars.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}