<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Panels;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//--- Services --

use Modules\Xot\Models\Panels\XotBasePanel;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class FavoritePanel.
 */
class FavoritePanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Rating\Models\Favorite';


    /**
     * index navigation.
     */
    public function indexNav(): ?Renderable {
        if (! inAdmin()) {
            $view = 'rating::favorites.index.nav';

            return view()->make($view);
        }

        return null;
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param RowsContract $query
     *
     * @return RowsContract
     */
    public static function indexQuery(array $data, $query) {
        return $query->where('user_id', Auth::id());
        
    }

    /**
     * @return object[]
     */
    public function fields(): array {
        return [
             (object) [
                'type' => 'Id',
                'name' => 'id',
                'comment' => null,
            ],
            (object) [
                'type' => 'BigInt',
                'name' => 'post_id',
                'comment' => null,
            ],
            2 => (object) [
                'type' => 'String',
                'name' => 'post_type',
                'comment' => null,
            ],
            3 => (object) [
                'type' => 'Integer',
                'name' => 'user_id',
                'comment' => null,
            ],
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions():array {
        return [
            new Actions\Favorite\NoMoreFavoriteAction(Auth::id()),
        ];
    }
}
