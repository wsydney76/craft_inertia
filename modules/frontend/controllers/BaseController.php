<?php

namespace modules\frontend\controllers;

use modules\frontend\controllers\filters\SharedDataFilter;
use modules\inertia\web\Controller;

class BaseController extends Controller
{
    public array|int|bool $allowAnonymous = true;

    public function behaviors()
    {
        return [
            [
                'class' => SharedDataFilter::class
            ]
        ];
    }
}
