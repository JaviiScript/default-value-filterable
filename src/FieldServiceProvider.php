<?php

namespace JaviiScript\DefaultValueFilterable;

use Closure;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerFieldMacros();
    }

    /**
     * Register field macros.
     *
     * @return void
     */
    protected function registerFieldMacros()
    {
        Field::macro('defaultValueFilterable', function ($callback, callable $filterableCallback = null) {
            $this->withMeta(['defaultValueCallback' => $callback]);
            $this->filterable($filterableCallback);
            return $this;
        });

        Field::macro('resolveDefaultValueFilterable', function (NovaRequest $request) {
            if (!array_key_exists('defaultValueCallback', $this->meta())) {
                return null;
            }

            $defaultValue = $this->meta['defaultValueCallback'];

            if ($defaultValue instanceof Closure) {
                $defaultValue = call_user_func($defaultValue, $request);
            }

            return $defaultValue;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
