<?php

namespace JaviiScript\DefaultValueFilterable;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Contracts\FilterableField;
use Laravel\Nova\Filters\Filter as BaseFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

abstract class Filter extends BaseFilter
{
    /**
     * Construct a new filter.
     *
     * @param  \Laravel\Nova\Contracts\FilterableField&\Laravel\Nova\Fields\Field  $field
     */
    public function __construct(public FilterableField $field)
    {
        //
    }

    /**
     * Get the displayable name of the filter.
     *
     * @return string
     */
    public function name()
    {
        return $this->field->name;
    }

    /**
     * Get the key for the filter.
     *
     * @return string
     */
    public function key()
    {
        return class_basename($this->field).':'.$this->field->attribute;
    }

    /**
     * Apply the filter to the given query.
     *
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, Builder $query, mixed $value)
    {
        $this->field->applyFilter($request, $query, $value);

        return $query;
    }

    /**
     * Set the default options for the filter.
     *
     * @return array|mixed
     */
    public function default()
    {
        $request = app(NovaRequest::class);

        return $this->field->resolveDefaultValueFilterable($request);
    }

    /**
     * Prepare the field for JSON serialization.
     *
     * @return array
     */
    public function serializeField()
    {
        return $this->field->serializeForFilter();
    }

    /**
     * Prepare the filter for JSON serialization.
     *
     * @return array<string, mixed>
     */
    #[\Override]
    public function jsonSerialize(): array
    {
        $component = $this->component();

        return array_merge(parent::jsonSerialize(), [
            'uniqueKey' => sprintf('%s-%s-filter', $this->field->attribute, $component),
            'component' => "filter-{$component}",
            'field' => $this->serializeField(),
        ]);
    }
}
