<?php

namespace App\Nova;

use App\Domain\Book\Models\Book as BookModel;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Card;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Lenses\Lens;

class Book extends Resource
{
    public static $model = BookModel::class;

    public static function group()
    {
        return __('Books');
    }

    public function title()
    {
        return sprintf(
            '%s (%s)',
            $this->name,
            $this->author->name
        );
    }

    public static function label()
    {
        return __('Books');
    }

    public static function singularLabel()
    {
        return __('Book');
    }

    /** @var array<string> */
    public static $search = [
        'id',
        'name',
        'original_name',
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

            Text::make(__('Original name'), 'original_name')
                ->sortable()
                ->rules('required', 'max:255'),

            Textarea::make(__('Description'), 'description')
                ->rules('required'),

            Number::make(__('Release year'), 'release_year')->min(0)->step(1)
                ->rules('required', ' numeric', 'min:0'),

            BelongsTo::make(__('Author'), 'author', Author::class)
                ->searchable()
                ->withoutTrashed(),

            BelongsTo::make(__('Series'), 'series', Series::class)
                ->searchable()
                ->rules('nullable'),

            Images::make(__('Cover image'), 'cover-image')
                ->rules('nullable')
                ->singleImageRules('mimes:jpeg,jpg', Rule::dimensions()->minWidth(400)),

            HasMany::make(__('Editions'), 'editions', Edition::class),

            BelongsToMany::make(__('Genres'), 'genres', Genre::class)
                ->searchable(),

            BelongsToMany::make(__('Tags'), 'tags', Tag::class)
                ->searchable(),
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
