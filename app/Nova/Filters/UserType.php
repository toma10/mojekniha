<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class UserType extends BooleanFilter
{
    public function apply(Request $request, $query, $value)
    {
        if ($value['admin'] && $value['user']) {
            return $query;
        }

        return $query
            ->where('is_admin', $value['admin'])
            ->where('is_admin', ! $value['user']);
    }

    public function options(Request $request)
    {
        return [
            'Administrator' => 'admin',
            'Regular User' => 'user',
        ];
    }

    public function default()
    {
        return [
            'admin' => true,
            'user' => true,
        ];
    }
}
