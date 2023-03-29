<?php

declare(strict_types=1);

namespace Modules\Rating\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Lang\Models\Post;

// ------- services ----
// ------- traits ---

// ------- services ----

/**
 * Modules\Rating\Models\Favorite.
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Favorite> $favorites
 * @property-read int|null $favorites_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $linkable
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Favorite> $myFavorites
 * @property-read int|null $my_favorites_count
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite query()
 * @mixin \Eloquent
 */
class Favorite extends BaseModel {
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'post_id', 'post_type', 'user_id'];

    /**
     * Relations.
     */
    public function favorites(): MorphMany {
        return $this->morphMany(self::class, 'post');
    }

    public function myFavorites(): MorphMany {
        return $this->morphMany(self::class, 'post')
            ->where('user_id', \Auth::id());
    }

    public function isMyFavorited(): bool {
        return $this->favorites()
            ->where('user_id', \Auth::id())->count() > 0;
    }

    public function linkable(): MorphTo {
        // dddx(Favorite::where('post_type','LIKE','%media%')->delete());

        return $this->morphTo('post');
    }
}
