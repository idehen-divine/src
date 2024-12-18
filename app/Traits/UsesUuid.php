<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UsesUuid
{
    /**
     * Boots the UsesUuidTrait by setting a UUID as the model's key when creating a new instance.
     * This ensures that the model's primary key is a UUID instead of an auto-incrementing integer.
     */
    protected static function bootUsesUuid(): void
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Indicates that the model's primary key is not an incrementing integer value.
     *
     * This method is part of the `UsesUuidTrait` which provides functionality for
     * automatically generating UUIDs as the primary key for Eloquent models.
     *
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Returns the key type for the model, which is always a string for this trait.
     *
     * @return string
     */
    public function getKeyType(): string
    {
        return 'string';
    }
}
