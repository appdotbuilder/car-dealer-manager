<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\SparePart
 *
 * @property int $id
 * @property string $part_number
 * @property string $name
 * @property string|null $description
 * @property string $category
 * @property string $brand
 * @property float $cost_price
 * @property float $selling_price
 * @property int $quantity_in_stock
 * @property int $minimum_stock_level
 * @property string|null $supplier
 * @property string|null $location
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SparePartSale> $sales
 * @property-read bool $is_low_stock
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart active()
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart lowStock()
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart query()
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereCostPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereMinimumStockLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart wherePartNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereQuantityInStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereSupplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SparePart whereUpdatedAt($value)
 * @method static \Database\Factories\SparePartFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class SparePart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'part_number',
        'name',
        'description',
        'category',
        'brand',
        'cost_price',
        'selling_price',
        'quantity_in_stock',
        'minimum_stock_level',
        'supplier',
        'location',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'quantity_in_stock' => 'integer',
        'minimum_stock_level' => 'integer',
    ];

    /**
     * Get the sales for this spare part.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(SparePartSale::class);
    }

    /**
     * Check if the part is low in stock.
     *
     * @return bool
     */
    public function getIsLowStockAttribute(): bool
    {
        return $this->quantity_in_stock <= $this->minimum_stock_level;
    }

    /**
     * Scope a query to only include active spare parts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include low stock parts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('quantity_in_stock', '<=', 'minimum_stock_level');
    }
}