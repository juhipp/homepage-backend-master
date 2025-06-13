<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TrackEntry
 *
 * @property int $id
 * @property string $session
 * @property string $date
 * @property string $type
 * @property string|null $target
 * @property string $currentUrl
 * @property bool $conversion
 * @property string|null $text
 * @property string|null $campaign
 * @property string|null $keyword
 * @property array|null $params
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereCampaign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereConversion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereCurrentUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrackEntry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TrackEntry extends Model
{
    protected $table = 'trackentries';
    
    protected $fillable = [
        'session',
        'date',
        'type',
        'target',
        'currentUrl',
        'conversion',
        'text',
        'campaign',
        'keyword',
        'params',
    ];

    protected $casts = ['conversion' => 'bool', 'params' => 'array'];
}
