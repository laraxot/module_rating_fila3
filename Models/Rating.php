<?php

declare(strict_types=1);

namespace Modules\Rating\Models;

/**
 * Modules\Rating\Models\Rating.
 *
 * @property int                                                                        $id
 * @property string|null                                                                $created_by
 * @property string|null                                                                $updated_by
 * @property string|null                                                                $deleted_by
 * @property \Illuminate\Support\Carbon|null                                            $created_at
 * @property \Illuminate\Support\Carbon|null                                            $updated_at
 * @property string|null                                                                $related_type
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Rating\Models\Favorite[] $favorites
 * @property int|null                                                                   $favorites_count
 * @property mixed                                                                      $create_url
 * @property mixed                                                                      $destroy_url
 * @property mixed                                                                      $detach_url
 * @property mixed                                                                      $edit_url
 * @property mixed                                                                      $guid
 * @property mixed                                                                      $image_src
 * @property mixed                                                                      $index_edit_url
 * @property mixed                                                                      $index_url
 * @property mixed                                                                      $lang
 * @property mixed                                                                      $movedown_url
 * @property mixed                                                                      $moveup_url
 * @property mixed                                                                      $post_type
 * @property mixed                                                                      $routename
 * @property mixed                                                                      $show_url
 * @property mixed                                                                      $subtitle
 * @property mixed                                                                      $title
 * @property mixed                                                                      $txt
 * @property mixed                                                                      $update_url
 * @property mixed                                                                      $url
 * @property mixed                                                                      $user_handle
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Rating\Models\Image[]    $images
 * @property int|null                                                                   $images_count
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Rating\Models\Favorite[] $myFavorites
 * @property int|null                                                                   $my_favorites_count
 * @property \Modules\Rating\Models\Post|null                                           $post
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang ofItem($guid)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereRelatedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang withPost($guid)
 * @mixin \Eloquent
 * @property string|null $note
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereNote($value)
 * @property int $post_id
 * @method static \Illuminate\Database\Eloquent\Builder|Rating wherePostId($value)
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Blog\Models\Post[] $posts
 * @property int|null                                                             $posts_count
 * @mixin IdeHelperRating
 */
class Rating extends BaseModelLang {
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'related_type'];

    // -------- relationship -----
    // -------- mutators ---------
    /*
    public function getRatingAvgAttribute($value){
        return $this->ratingMorph()->avg('rating');
    }
    */
}
