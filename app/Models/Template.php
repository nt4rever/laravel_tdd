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
 * @property int $id
 * @property string $uuid
 * @property array<int> $groups
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @mixin EloquentBuilderMixin
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
