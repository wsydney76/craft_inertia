<?php

namespace modules\frontend\controllers;

use Craft;
use craft\elements\Entry;
use modules\frontend\controllers\filters\SharedDataFilter;
use modules\inertia\web\Controller;
use yii\web\NotFoundHttpException;

class PostController extends Controller
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

    public function actionIndex()
    {
        $entries = Entry::find()->section('post')->asArray()->all();

        return $this->inertia('Posts/Index', [
            'title' => 'Posts',
            'entries' => $entries
        ]);
    }

    public function actionPost($slug)
    {
        // An id is passed in by live preview
        $id = Craft::$app->request->getQueryParam('id');

        if ($id) {
            $entry = Entry::find()->id($id)->provisionalDrafts(null)->drafts(null)->status(null)->one();
        } else {
            $entry = Entry::find()->slug($slug)->one();
        }

        if (!$entry) {
            throw new NotFoundHttpException();
        }

        return $this->inertia('Posts/Post', [
            'title' => $entry['title'],
            'entry' => $entry->getEntryData()
        ]);
    }
}
