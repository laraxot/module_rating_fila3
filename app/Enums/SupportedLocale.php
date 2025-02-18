<?php

declare(strict_types=1);

namespace Modules\Rating\App\Enums;

enum SupportedLocale: string
{
    case IT = 'it';
    case EN = 'en';

    /**
     * Get the human-readable label for the locale.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::IT => 'Italiano',
            self::EN => 'English',
        };
    }

    /**
     * Get all available locales as array.
     *
     * @return array<string, string>
     */
    public static function toArray(): array
    {
        return array_reduce(
            self::cases(),
            fn (array $carry, self $locale) => [...$carry, $locale->value => $locale->getLabel()],
            []
        );
    }
}
