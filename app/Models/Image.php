<?php

namespace App\Models;

use App\Services\Traits\EloquentBuilderMixin;
use App\Services\Traits\HasUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Image
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $filename
 * @property string $url
 * @property string $service
 * @property array $payload
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @mixin EloquentBuilderMixin
 * @method static \Database\Factories\ImageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUuid($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
    use HasUuid, HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'user_id',
        'filename',
        'url',
        'service',
        'payload',
    ];

    protected $casts = [
        'user_id' => 'int',
        'payload' => 'array',
    ];

    /**
     * A note belongs to an User
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
