<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Content
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property string $content
 * @property string|null $meta_description
 * @property string|null $vorschauPic
 * @property string|null $vorschau_text
 * @property string|null $workplace
 * @property string|null $worktime
 * @method static \Database\Factories\ContentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content query()
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereVorschauPic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereVorschauText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereWorkplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereWorktime($value)
 * @mixin \Eloquent
 */
class Content extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'meta_description',
        'vorschauPic',
        'vorschau_text',
        'workplace',
        'worktime'
    ];

    protected $attributes = [
        'vorschau_text' => '',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    protected function article(): HasOne
    {
        return $this->hasOne(Article::class);
    }

    protected function job(): HasOne
    {
        return $this->hasOne(Job::class);
    }
}
