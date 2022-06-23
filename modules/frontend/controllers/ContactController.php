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
        return $this->inertia('Contact/Form', [
            'title' => 'Contact',
            'message' => [
                'name' => '',
                'eMail' => '',
                'text' => ''
            ]
        ]);
    }

    public function actionSend()
    {
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
            Craft::$app->session->setError(implode(' // ', $model->firstErrors));
            return Craft::$app->response->redirect('contact');
        }

        Craft::$app->session->setNotice('Message sent');
        return Craft::$app->response->redirect('');
    }
}
