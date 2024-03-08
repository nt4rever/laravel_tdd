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
 * @property array<int> $groups
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @mixin EloquentBuilderMixin
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Template onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereGroups($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Template withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Template withoutTrashed()
 * @mixin \Eloquent
 */
class Template extends Model
{
    use SoftDeletes, HasUuid, HasFactory;

    protected $table = 'templates';

    protected $fillable = [
        'groups',
    ];

    public function getGroupsAttribute($value)
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

    public function setGroupsAttribute($value)
    {
        $result = null;
        if (!($value === null || (is_array($value) && count($value) === 0))) {
            $result = json_encode($value);
        }
        $this->attributes['groups'] = $result;
    }
}
