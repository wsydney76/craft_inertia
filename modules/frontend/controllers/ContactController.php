<?php

namespace modules\frontend\controllers;

use Craft;
use modules\frontend\controllers\filters\SharedDataFilter;
use modules\inertia\web\Controller;

class ContactController extends Controller
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

    public function actionForm() {

        $request = Craft::$app->request;
        $fullName = $request->getBodyParam('fullName');
        $email = $request->getBodyParam('email');
        $message = $request->getBodyParam('message');

        $error = '';
        $notice = '';

        return $this->inertia('Contact/Form', [
            'title' => 'Contact',
            'fullName' => $fullName,
            'eMail' => $email,
            'message' => $message,
            'notice' => $notice,
            'error' => $error
        ]);
    }
}
