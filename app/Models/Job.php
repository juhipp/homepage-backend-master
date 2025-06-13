<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Job
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $user_id
 * @property int $content_id
 * @property string|null $permapath
 * @property-read \App\Models\JobCategory $category
 * @property-read \App\Models\Content $content
 * @property-read \App\Models\User $user
 * @method static Builder|Job active()
 * @method static \Database\Factories\JobFactory factory($count = null, $state = [])
 * @method static Builder|Job newModelQuery()
 * @method static Builder|Job newQuery()
 * @method static Builder|Job onlyTrashed()
 * @method static Builder|Job query()
 * @method static Builder|Job whereActive($value)
 * @method static Builder|Job whereContentId($value)
 * @method static Builder|Job whereCreatedAt($value)
 * @method static Builder|Job whereDeletedAt($value)
 * @method static Builder|Job whereId($value)
 * @method static Builder|Job wherePermapath($value)
 * @method static Builder|Job whereUpdatedAt($value)
 * @method static Builder|Job whereUserId($value)
 * @method static Builder|Job withTrashed()
 * @method static Builder|Job withoutTrashed()
 * @mixin \Eloquent
 */
class Job extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'content_id',
        'active',
        'permapath',
    ];

    protected $with = [
        'category',
        'content',
        'user',
    ];

    protected $appends = [
        'url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('active', 1);
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->permapath ? (config('app.web_url') . '/jobs/' . urlencode($this->permapath)) : null,
        );
    }

    public function resolveRouteBinding($value, $field = null): Job|null
    {
        if (request()->route()->getName() === 'feed.jobs.show') {
            return $this->where('permapath', $value)->where('active', 1)->firstOrFail();
        }

        return $this->find($value);
    }
}
