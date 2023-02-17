<?php

namespace App\Models;

use App\Enums\ResourceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
     * Get the resources that owns the platform.
     */
    public function resource(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, class-string|string>
     */
    protected $casts = [
        'type' => ResourceType::class,
    ];

    /**
     * Bootstrap the model and its traits.
     */
    public static function boot(): void
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = self::generateId();
        });
    }

    /**
     * Generate random ID
     */
    private static function generateId(): string
    {
        $id = bin2hex(random_bytes(12));
        if (self::find($id))
            return self::generateId();

        return $id;
    }
}
