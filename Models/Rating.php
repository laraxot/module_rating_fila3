<?php

declare(strict_types=1);

namespace Modules\Rating\Models;

use Modules\Rating\Enums\RuleEnum;
use Illuminate\Database\Eloquent\Builder;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class Rating extends BaseModel
{
    protected $fillable = [
        'id',
        'extra_attributes',
        'title',
        'color',
        'txt',
        'rule',
        'is_disabled',
        'is_readonly',
        'order_column',
    ];

    public $casts = [
        'extra_attributes' => SchemalessAttributes::class,
        'rule'=>RuleEnum::class,
        'is_disabled' => 'boolean',
        'is_readonly'=> 'boolean',
    ];

    public function scopeWithExtraAttributes(): Builder
    {
        return $this->extra_attributes->modelScope();
    }
}
