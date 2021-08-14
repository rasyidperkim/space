<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpacePhoto extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user that owns the SpacePhoto
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(Space::class, 'space_id', 'id');
    }
}
