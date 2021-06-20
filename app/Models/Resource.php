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
     * Get the platform associated with the anime resource.
     */
    public function platform()
    {
        return $this->belongsTo(Platform::class);
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
