<?php

namespace App\Nova;

use App\Domain\Book\Models\Author as AuthorModel;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Card;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Lenses\Lens;

class Author extends Resource
{
    public static $model = AuthorModel::class;

    public static function group()
    {
        return __('Books');
    }

    public function title()
    {
        return sprintf(
            '%s (%s - %s)',
            $this->name,
            $this->birth_date->format('Y-m-d'),
            optional($this->death_date)->format('Y-m-d') ?? 'now'
        );
    }

    public static function label()
    {
        return __('Authors');
    }

    public static function singularLabel()
    {
        return __('Author');
    }

    /** @var array<string> */
    public static $search = [
        'id',
        'name',
    ];

    /**
     * @return array<Field>
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Date::make(__('Birth date'), 'birth_date')
                ->sortable()
                ->rules('required', 'date'),

            Date::make(__('Death date'), 'death_date')
                ->sortable()
                ->rules('nullable', 'date'),

            Textarea::make(__('Biography'), 'biography')
                ->rules('nullable'),

            BelongsTo::make(__('Nationality'), 'nationality', Nationality::class)
                ->sortable()
                ->searchable(),

            Images::make(__('Portrait image'), 'portrait-image')
                ->rules('nullable')
                ->singleImageRules('mimes:jpeg,jpg', Rule::dimensions()->minWidth(400)),

            HasMany::make(__('Books'), 'books', Book::class),

            HasMany::make(__('Series'), 'series', Series::class),
        ];
    }

    /**
     * @return array<Card>
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * @return array<Filter>
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * @return array<Lens>
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * @return array<Action>
     */
    public function actions(Request $request)
    {
        return [];
    }
}
