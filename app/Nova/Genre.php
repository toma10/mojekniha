<?php

namespace App\Nova;

use App\Domain\Book\Models\Genre as GenreModel;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Card;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Lenses\Lens;

class Genre extends Resource
{
    public static $model = GenreModel::class;

    public static $title = 'name';

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

            Text::make('Name')
                ->sortable()
                ->rules('required', 'unique:genres,name'),

            BelongsToMany::make('Books'),
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
