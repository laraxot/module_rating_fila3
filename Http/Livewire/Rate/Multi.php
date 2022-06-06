<?php

declare(strict_types=1);

namespace Modules\Rating\Http\Livewire\Rate;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Modules\Rating\Models\Rating;
use Modules\Xot\Services\PanelService;

/**
 * Class Multi.
 */
class Multi extends Component {
    public Model $model;

    public int $post_id;

    public string $post_type;

    /**
     * @var int|string|null
     */
    public $user_id;

    // --------------

    public string $modal_guid;

    public string $modal_title;

    // public $fav;

    /**
     * @param Model $model
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws \ReflectionException
     */
    public function mount($model): void {
        $this->model = $model;
        $this->post_type = PanelService::make()->get($model)->postType();
        $this->post_id = $model->getKey();
        $this->user_id = \Auth::id();
        $this->modal_guid = 'modalrateit';
        $this->modal_title = 'Vota';
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render() {
        $view = 'blog::livewire.rate.multi';

        $goals = Rating::where('related_type', $this->post_type)->get();

        $view_params = [
            'view' => $view,
            'goals' => $goals,
        ];

        return view($view, $view_params);
    }

    public function cancel(): void {
        // $this->updateMode = false;
        // $this->resetInputFields();
    }

    //private function resetInputFields(): void {
        // $this->name = '';
        // $this->email = '';
    //}
}