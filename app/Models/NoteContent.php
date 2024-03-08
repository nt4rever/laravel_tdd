<?php

namespace App\Models;

use App\Services\Traits\HasUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Note
 *
 * @property int $id
 * @property string $uuid
 * @property int $note_id
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property-read \App\Models\Note|null $note
 * @method static \Database\Factories\NoteContentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent whereNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NoteContent withoutTrashed()
 * @mixin \Eloquent
 */
class NoteContent extends Model
{
    use SoftDeletes, HasUuid, HasFactory;

    protected $table = 'note_contents';

    protected $casts = [
        'note_id' => 'int',
    ];

    protected $fillable = [
        'note_id',
        'content',
    ];

    /**
     * A note content belongs to a Note
     *
     * @return BelongsTo
     */
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'note_id');
    }
}
