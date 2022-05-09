<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Panels;

use Illuminate\Http\Request;
//--- Services --
use Modules\Xot\Models\Panels\XotBasePanel;

//----- actions ---

/**
 * Class RatingMorphPanel.
 */
class RatingMorphPanel extends XotBasePanel {
    protected static string $model = 'Modules\Rating\Models\RatingMorph';

    protected static string $title = 'title';

    protected static array $search = [];

    public function with(): array {
        return [];
    }

    public function search(): array {
        return [];
    }

    public function optionLabel(object $row): string {
        return $row->area_define_name;
    }

    /**
     * @return object[]
     */
    public function fields(): array {
        //$route_params = optional(\Route::current())->parameters();
        [$containers, $items] = params2ContainerItem();

        return [
            /*
            (object) [
            'type' => 'Id',
            'name' => 'id',
            ],
            (object) [
            'type' => 'Integer',
            'name' => 'post_id',
            ],
            (object) [
            'type' => 'Text',
            'name' => 'post_type',
            ],
            (object) [
            'type' => 'Text',
            'name' => 'related_id',
            ],
             */
            /*
            (object) [
            'type' => 'Hidden',
            'name' => 'related_type',
            ],
             */
            /*
            (object) [
            'type' => 'Text',
            'name' => 'title',
            'comment' => 'not in Doctrine',
            ],
             */
            /*
            (object) [
            'type'     => 'Decimal',
            'sub_type' => 'JqStar',
            //'sub_type'=>'VueStar',
            'name'     => 'rating',
            ],
             */
            (object) [
                'type' => 'Rating',
                //'sub_type' => 'JqStar',
                //'sub_type'=>'VueStar',
                'name' => 'myRatings',
                'parent' => last($items),
            ],
            /*
        (object) [
        'type' => 'Hidden',
        'name' => 'user_id',
        ],
        //*/
        ];
    }

    /**
     * Get the tabs available.
     *
     * @return array
     */
    public function tabs():array {
        $tabs_name = [];

        return [];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(Request $request):array {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(Request $request = null):array {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(Request $request):array {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions():array {
        return [
            new Actions\RateItAction(),
        ];
    }
}
