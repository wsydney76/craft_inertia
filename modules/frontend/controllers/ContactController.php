<?php

namespace modules\frontend\controllers;

use Craft;
use yii\base\DynamicModel;
use function compact;
use function implode;

class ContactController extends BaseController
{

    public function actionForm()
    {

        $user = Craft::$app->user->identity;
        return $this->inertia('Contact/Form', [
            'title' => 'Contact',
            'message' => [
                'name' => $user ? $user->name : '',
                'email' => $user ? $user->email : '',
                'text' => '',
            ],
            'errors' => Craft::$app->session->getFlash('errors') ?? []
        ]);
    }

    public function actionSend()
    {
        $user = Craft::$app->user->identity;

        $request = Craft::$app->request;

        $name = $request->getBodyParam('name');
        $email = $request->getBodyParam('email');
        $text = $request->getBodyParam('text');

        $model = DynamicModel::validateData(compact('name', 'email', 'text'), [
            ['name', 'required'],
            ['name', 'string', 'max' => 30],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 50],
            ['text', 'required'],
            ['text', 'string', 'min' => 20],
        ]);

        if ($model->hasErrors()) {
            Craft::$app->session->setError("Could not send message");
            Craft::$app->session->setFlash('errors', $model->errors);
            return Craft::$app->response->redirect('contact');
        }

        if ($user && $user->name != $name) {
            Craft::$app->session->setError("You are not $name!");
            return Craft::$app->response->redirect('contact');
        }

        Craft::$app->session->setNotice("Thanks $name, your message would have been sent, but sorry, this is only a demo...");
        return Craft::$app->response->redirect('');
    }
}
