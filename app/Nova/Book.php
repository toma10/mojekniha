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

    public static $title = 'name';

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

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Original name')
                ->sortable()
                ->rules('required', 'max:255'),

            Textarea::make('Description')
                ->rules('nullable', 'string'),

            Number::make('Release year')->min(0)->step(1)
                ->rules('required', ' numeric', 'min:0'),

            BelongsTo::make('Author')
                ->withoutTrashed(),

            BelongsTo::make('Series')
                ->nullable(),

            Images::make('Cover image', 'cover-image')
                ->rules('nullable')
                ->singleImageRules('mimes:jpeg,jpg', Rule::dimensions()->minWidth(400)),

            HasMany::make('Editions'),

            BelongsToMany::make('Genres'),

            BelongsToMany::make('Tags'),
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
