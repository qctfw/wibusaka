<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anime_platforms';
    
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
     * Get the resources that owns the platform.
     */
    public function resource()
    {
        return $this->hasMany(Resource::class);
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
