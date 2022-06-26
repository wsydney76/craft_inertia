<?php

namespace modules\frontend\controllers;

use Craft;
use craft\helpers\UrlHelper;
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
            ]
        ]);
    }

    public function actionSend()
    {

        $model = DynamicModel::validateData(Craft::$app->request->getRequiredBodyParam('message'), [
            [['name', 'email', 'text'], 'required'],
            ['name', 'string', 'max' => 30],
            ['email', 'email'],
            ['text', 'string', 'min' => 30],
        ]);

        if ($model->hasErrors()) {
            return $this->inertia('Contact/Form', [
                'error' => "Could not send message",
                'errors' => $model->errors
            ]);
        }

        Craft::$app->session->setNotice("Thank you, your message would have been sent, but sorry, this is only a demo...");
        return Craft::$app->response->redirect(UrlHelper::siteUrl('/', ['siteInfo' => 1]));
    }
}
