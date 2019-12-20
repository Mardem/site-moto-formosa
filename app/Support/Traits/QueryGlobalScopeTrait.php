<?php


namespace App\Support\Traits;


use App\Support\Scopes\QueryGlobalScope;

trait QueryGlobalScopeTrait
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new QueryGlobalScope());
    }

}
