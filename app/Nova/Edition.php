<?php

namespace App\Nova;

use App\Domain\Book\Models\Edition as EditionModel;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Card;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Lenses\Lens;

class Edition extends Resource
{
    public static $model = EditionModel::class;

    public static $title = 'isbn';

    /** @var array<string> */
    public static $search = [
        'id',
        'isbn',
    ];

    /**
     * @return array<Field>
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Book')
                ->withoutTrashed(),

            Text::make('ISBN')
                ->rules('required', 'max:255'),

            Number::make('Release year')->min(0)->step(1)
                ->rules('required', ' numeric', 'min:0'),

            BelongsTo::make('Language'),

            Number::make('Number of pages')->min(0)->step(1)
                ->rules('required', ' numeric', 'min:0')
                ->hideFromIndex(),

            Number::make('Number of copies')->min(0)->step(1)
                ->rules('required', ' numeric', 'min:0')
                ->hideFromIndex(),

            Images::make('Cover image', 'cover-image')
                ->rules('nullable'),

            BelongsTo::make('BookBinding')
                ->hideFromIndex(),
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
