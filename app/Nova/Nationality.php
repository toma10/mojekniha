<?php

namespace App\Nova;

use App\Domain\Book\Models\Nationality as NationalityModel;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Card;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Lenses\Lens;

class Nationality extends Resource
{
    public static $model = NationalityModel::class;

    public static function group()
    {
        return __('Books');
    }

    public static $title = 'name';

    /** @var array<string> */
    public static $search = [
        'id',
        'name',
    ];

    public static function label()
    {
        return __('Nationalities');
    }

    public static function singularLabel()
    {
        return __('Nationality');
    }

    /**
     * @return array<Field>
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(__('Name'), 'name')
                ->sortable(),

            HasMany::make(__('Authors'), 'authors', Author::class),
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
