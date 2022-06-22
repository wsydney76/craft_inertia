<?php

namespace modules\main\controllers;

use craft\web\Controller;

class TestController extends Controller
{

    public array|int|bool $allowAnonymous = ['hello-world'];

    /**
     * /actions/main/test/hello-world
     *
     * @return string
     */
    public function actionHelloWorld()
    {
        return 'Hello World';
    }
}
