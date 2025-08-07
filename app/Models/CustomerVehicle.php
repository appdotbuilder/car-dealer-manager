<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\CustomerVehicle
 *
 * @property int $id
 * @property int $customer_id
 * @property string $vin
 * @property string $make
 * @property string $model
 * @property int $year
 * @property string $color
 * @property float $mileage
 * @property string|null $license_plate
 * @property \Illuminate\Support\Carbon|null $purchase_date
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle active()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereLicensePlate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereMake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereMileage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereVin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerVehicle whereYear($value)
 * @method static \Database\Factories\CustomerVehicleFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class CustomerVehicle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'customer_id',
        'vin',
        'make',
        'model',
        'year',
        'color',
        'mileage',
        'license_plate',
        'purchase_date',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'purchase_date' => 'date',
        'mileage' => 'decimal:2',
        'year' => 'integer',
    ];

    /**
     * Get the customer that owns the vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the services for this vehicle.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Scope a query to only include active vehicles.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}