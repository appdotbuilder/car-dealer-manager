<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property int $customer_vehicle_id
 * @property int $technician_id
 * @property string $service_number
 * @property string $service_type
 * @property string $description
 * @property float $labor_cost
 * @property float $parts_cost
 * @property float $total_cost
 * @property \Illuminate\Support\Carbon $service_date
 * @property \Illuminate\Support\Carbon|null $completion_date
 * @property string $status
 * @property int $mileage_at_service
 * @property \Illuminate\Support\Carbon|null $next_service_date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CustomerVehicle $customerVehicle
 * @property-read \App\Models\User $technician
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Service completed()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCompletionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCustomerVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereLaborCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereMileageAtService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereNextServiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service wherePartsCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereServiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereServiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereServiceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereTechnicianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @method static \Database\Factories\ServiceFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'customer_vehicle_id',
        'technician_id',
        'service_number',
        'service_type',
        'description',
        'labor_cost',
        'parts_cost',
        'total_cost',
        'service_date',
        'completion_date',
        'status',
        'mileage_at_service',
        'next_service_date',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'service_date' => 'date',
        'completion_date' => 'date',
        'next_service_date' => 'date',
        'labor_cost' => 'decimal:2',
        'parts_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'mileage_at_service' => 'integer',
    ];

    /**
     * Get the customer vehicle being serviced.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customerVehicle(): BelongsTo
    {
        return $this->belongsTo(CustomerVehicle::class);
    }

    /**
     * Get the technician performing the service.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    /**
     * Scope a query to only include completed services.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}