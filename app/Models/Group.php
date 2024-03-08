<?php

namespace App\Models;

use App\Services\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Services\Traits\EloquentBuilderMixin;

/**
 * Class Image
 *
 * @property int $id
 * @property string $uuid
 * @property int $type
 * @property array<int> $users
 * @property int $required_amount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @mixin EloquentBuilderMixin
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereRequiredAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereUsers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Group withoutTrashed()
 * @mixin \Eloquent
 */
class Group extends Model
{
    use SoftDeletes, HasUuid, HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'type',
        'users',
        'required_amount',
    ];

    public const APPROVER = 0;
    public const DECISION = 1;
    public const TYPES = [
        self::APPROVER,
        self::DECISION,
    ];

    public function getUsersAttribute($value)
    {
        $decodeValue = json_decode($value, true);
        if ($decodeValue === null) {
            return null;
        } elseif (is_array($decodeValue)) {
            return $decodeValue;
        } else {
            return [$decodeValue];
        }
    }

    public function setUsersAttribute($value)
    {
        $result = null;
        if (!($value === null || (is_array($value) && count($value) === 0))) {
            $result = json_encode($value);
        }
        $this->attributes['users'] = $result;
    }
}
