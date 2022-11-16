<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EvacuationCenter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'barangay_id',
        'evacuation_center_type_id',
        'max_capacity',
        'is_evacuation_center_full',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'is_evacuation_center_full' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function evacuationCenterType(): BelongsTo
    {
        return $this->belongsTo(EvacuationCenterType::class);
    }

    /**
     * @return BelongsTo
     */
    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class);
    }

    /**
     * @return HasMany
     */
    public function evacuees(): HasMany
    {
        return $this->hasMany(Evacuee::class);
    }
}
