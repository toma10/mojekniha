<?php

namespace App\Nova;

use App\Domain\Book\Models\Series as SeriesModel;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Card;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Lenses\Lens;

class Series extends Resource
{
    public static $model = SeriesModel::class;

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
        return __('Series');
    }

    public static function singularLabel()
    {
        return __('Serie');
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
                ->rules('required'),

            BelongsTo::make(__('Author'), 'author', Author::class)
                ->searchable()
                ->withoutTrashed(),

            HasMany::make(__('Books'), 'books', Book::class),
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
