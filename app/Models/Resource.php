<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anime_resources';
    
    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'paid' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get the platform associated with the anime resource.
     */
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    /**
     * Scope a query to only include resources of a given MyAnimeList ID.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array|int  $mal_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByMalId($query, $mal_id)
    {
        if (is_array($mal_id))
        {
            return $query->whereIn('mal_id', $mal_id);
        }

        return $query->where('mal_id', $mal_id);
    }

    /**
     * Get the resource's alternative note.
     *
     * @return string
     */
    public function getAlternativeNoteAttribute()
    {
        $alternative_note = $this->platform->name;
        $alternative_note .= ($this->paid) ? ' (Berbayar)' : '';
        $alternative_note .= ($this->note) ? ' (' . $this->note . ')' : '';

        return $alternative_note;
    }

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = self::generateId();
        });
    }

    /**
     * Generate random ID
     * 
     * @return string
     */
    private static function generateId()
    {
        $id = bin2hex(random_bytes(12));
        if (self::find($id))
            return self::generateId();

        return $id;
    }
}
