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
 * @property string $name
 * @property int $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @mixin EloquentBuilderMixin
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Issuance withoutTrashed()
 * @mixin \Eloquent
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
