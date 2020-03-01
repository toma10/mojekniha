<?php

namespace App\Nova;

use App\Domain\Auth\Models\User as UserModel;
use Illuminate\Http\Request;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Card;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Lenses\Lens;

class User extends Resource
{
    public static $model = UserModel::class;

    public static $title = 'name';

    /** @var array<string> */
    public static $search = [
        'id',
        'name',
        'email',
    ];

    /**
     * @return array<Field>
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Gravatar::make(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('username')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
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
