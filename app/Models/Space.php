<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Space extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function photos()
    {
        return $this->hasMany(SpacePhoto::class, 'space_id', 'id');
    }

    /**
     * Get the user that owns the Space
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getSpaces($latitude, $longitude, $radius) {
        return $this->select('spaces.*')
            ->selectRaw(
                '( 6371 *
                    acos( cos( radians(?) ) *
                        cos( radians( latitude ) ) *
                        cos( radians(longitude ) - radians(?)) +
                        sin( radians(?) ) *
                        sin( radians( latitude ) )
                    )
                ) AS distance', [$latitude, $longitude, $latitude]
            )
            ->havingRaw("distance < ?", [$radius])
            ->orderBy('distance', 'asc');
    }
}
