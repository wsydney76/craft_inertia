<?php

namespace modules\frontend\controllers;

use Craft;
use modules\frontend\controllers\filters\SharedDataFilter;
use modules\inertia\web\Controller;
use yii\base\DynamicModel;
use function compact;
use function implode;
use function join;

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

    public function actionForm()
    {

        // TODO: Correct form handling via redirects ???

        $request = Craft::$app->request;

        $isPost = $request->method == 'POST';

        $fullName = $request->getBodyParam('fullName');
        $email = $request->getBodyParam('email');
        $text = $request->getBodyParam('text');

        if ($isPost) {
            $model = DynamicModel::validateData(compact('fullName', 'email', 'text'), [
                ['fullName', 'required'],
                ['fullName', 'string', 'max' => 30],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'string', 'max' => 50],
                ['text', 'required'],
                ['text', 'string', 'min' => 20],
            ]);

            if ($model->hasErrors()) {

                Craft::$app->session->setError(implode(' // ', $model->firstErrors));
                return Craft::$app->response->redirect('contact');
            }

            Craft::$app->session->setNotice('Message sent');
            return Craft::$app->response->redirect('');
        }

        return $this->inertia('Contact/Form', [
            'title' => 'Contact',
            'message' => [
                'fullName' => '',
                'eMail' => '',
                'text' => '',
                'token' => $request->getCsrfToken()
            ]
        ]);
    }
}
