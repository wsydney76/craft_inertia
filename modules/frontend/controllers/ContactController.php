<?php

namespace modules\frontend\controllers;

use Craft;
use yii\base\DynamicModel;

class ContactController extends BaseController
{

    public function actionForm()
    {

        $user = Craft::$app->user->identity;

        return $this->inertia('Contact/Form', [
            'title' => 'Contact',
            'message' => [
                'name' => $user->name ?? '',
                'email' => $user->email ?? '',
                'text' => '',
            ],
            'errors' => Craft::$app->session->getFlash('errors', [], true)
        ]);
    }

    public function actionSend()
    {
        $request = Craft::$app->request;

        $model = DynamicModel::validateData([
            'name' => $request->getBodyParam('name'),
            'email' => $request->getBodyParam('email'),
            'text' => $request->getBodyParam('text')
        ], [
            [['name', 'email', 'text'], 'required'],
            ['name', 'string', 'max' => 30],
            ['email', 'email'],
            ['text', 'string', 'min' => 30],
        ]);

        if ($model->hasErrors()) {
            Craft::$app->session->setError("Could not send message");
            Craft::$app->session->setFlash('errors', $model->errors);
            return Craft::$app->response->redirect('contact');
        }


        Craft::$app->session->setNotice("Thank you, your message would have been sent, but sorry, this is only a demo...");
        return Craft::$app->response->redirect('');
    }
}
