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
 * @property string $name
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @mixin EloquentBuilderMixin
 */
class Issuance extends Model
{
    use SoftDeletes, HasUuid, HasFactory;

    protected $table = 'issuances';

    protected $fillable = [
        'name',
        'status',
    ];
}
