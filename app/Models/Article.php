<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $user_id
 * @property int $content_id
 * @property int|null $category_id
 * @property string|null $permapath
 * @property int $app_usage
 * @property-read \App\Models\ArticleCategory|null $category
 * @property-read \App\Models\Content $content
 * @property-read \App\Models\User $user
 * @method static Builder|Article active()
 * @method static \Database\Factories\ArticleFactory factory($count = null, $state = [])
 * @method static Builder|Article newModelQuery()
 * @method static Builder|Article newQuery()
 * @method static Builder|Article onlyTrashed()
 * @method static Builder|Article query()
 * @method static Builder|Article whereActive($value)
 * @method static Builder|Article whereAppUsage($value)
 * @method static Builder|Article whereCategoryId($value)
 * @method static Builder|Article whereContentId($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereDeletedAt($value)
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article wherePermapath($value)
 * @method static Builder|Article whereUpdatedAt($value)
 * @method static Builder|Article whereUserId($value)
 * @method static Builder|Article withTrashed()
 * @method static Builder|Article withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ArticleCategory> $categories
 * @property-read int|null $categories_count
 * @mixin \Eloquent
 */
class Article extends Model
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
        'app_usage',
        'permapath',
    ];

    protected $with = [
        'content',
        'user',
        'categories',
    ];

    protected $appends = [
        'url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ArticleCategory::class, 'article_category', 'article_id', 'article_category_id');
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('active', 1);
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->permapath ? (config('app.web_url') . '/articles/' . urlencode($this->permapath)) : null,
        );
    }

    public function resolveRouteBinding($value, $field = null): Article|null
    {
        if (request()->route()->getName() === 'feed.articles.show') {
            return $this->where('permapath', $value)->where('active', 1)->firstOrFail();
        }

        return $this->find($value);
    }
}
