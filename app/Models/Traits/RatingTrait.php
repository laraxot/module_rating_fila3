<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
// //use Laravel\Scout\Searchable;

// ----- models------
use Illuminate\Support\Facades\Auth;
// ---- services -----
use Modules\Cms\Services\PanelService as Panel;
use Modules\Rating\Models\Rating;

// ------ traits ---

/**
 * Trait RatingTrait.
 */
trait RatingTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function ratings()
    {
        return $this->morphRelated(Rating::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratingObjectives()
    {
        $related = Rating::class;
        $user_id = Auth::id();

        return $this->hasMany($related, 'related_type', 'post_type')

            ->selectRaw(
                'ratings.*,
                count(value) as rating_count,
                avg(value) as rating_avg,
                sum(if(user_id="'.$user_id.'",value,0)) AS rating_my
                '
            )->leftJoin(
                'rating_morph',
                function ($join): void {
                    $join->on('rating_morph.rating_id', 'ratings.id')
                        ->whereRaw('rating_morph.post_type = ratings.related_type')
                        ->where('rating_morph.post_id', $this->id);
                }
            )->groupBy('ratings.id')
            ->with('post');
    }

    /**
     * Scope a query to only include popular users.
     */
    public function scopeWithRating(Builder $query): Builder
    {
        return $query->leftJoin(
            'rating_morph',
            function ($join): void {
                $join->on('rating_morph.post_type = ratings.related_type');
            }
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function myRatings()
    {
        return $this->morphRelated(Rating::class)
            ->wherePivot('user_id', Auth::id());
    }

    // ----- mutators -----
    // *

    /**
     * @param float $value
     *
     * @return \Illuminate\Support\Collection
     */
    public function getMyRatingAttribute($value)
    {
        $my = $this->myRatings;

        return $my->pluck('pivot.rating', 'post_id');
    }

    /**
     * ----.
     */
    public function getRatingsAvgAttribute(?float $value): ?float
    {
        if (null !== $value) {
            return $value;
        }
        $value = $this->ratings->avg('pivot.rating');
        if (null !== $value) {
            $this->ratings_avg = $value;
            $this->save();
        }

        return $value;
    }

    public function getRatingsCountAttribute(?int $value): ?int
    {
        if (null !== $value) {
            return $value;
        }
        // Method Illuminate\Support\Collection<int,Modules\Rating\Models\Rating>::count() invoked with 1 parameter, 0 required.
        // $value = $this->ratings->count('pivot.rating');
        $value = $this->ratings->count(); // ?? forse fare filtro
        $this->ratings_count = $value;
        $this->save();

        return $value;
    }

    // */
    /*
        public function setMyRatingAttribute($value){
        dddx($value);
        }
    */
    // ------ functions ------
    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public function ratingAvgHtml(): string
    {
        // Method Illuminate\Support\Collection<int,Modules\Rating\Models\Rating>::count() invoked with 1 parameter, 0 required.
        // $pivot_avg = $ratings->avg('pivot.rating');
        $pivot_avg = $this->ratings_avg;
        // $pivot_cout = $ratings->count('pivot.rating');
        $pivot_cout = $this->ratings_count;

        $msg = '<div class="rateit" data-rateit-value="'.$pivot_avg.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
        $msg .= '('.$pivot_avg.') '.$pivot_cout.' Votes ';

        // $rating_url = Panel::make()->get($this)->relatedUrl('my_rating','index_edit');
        // $rating_url = Panel::make()->get($this)->url('show').'?_act=rate';
        // $rating_url = Panel::make()->get($this)->itemAction('rate_it')->url();
        $rating_url = '#';
        // http://geek.local/public_html/it/article/prova-articolo?_act=rate
        /*
        return $msg.'<a data-href="'.$rating_url.'" class="btn btn-danger" data-toggle="modal" data-target="#myModalAjax" data-title="Rate it">
        Rate It </a>';
        */
        $title = 'Vota '.$this->title;

        $btn = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueModal" data-title="'.$title.'" data-href="'.$rating_url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        $btn_iframe = '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueIframeModal" data-title="'.$title.'" data-href="'.$rating_url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        return $msg.$btn.$btn_iframe;
    }
}
