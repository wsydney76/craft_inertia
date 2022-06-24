<?php

namespace modules\frontend\controllers;

use Craft;
use craft\db\Paginator;
use craft\elements\Entry;
use craft\helpers\UrlHelper;
use modules\frontend\controllers\filters\SharedDataFilter;
use modules\inertia\web\Controller;
use yii\web\NotFoundHttpException;

class PostController extends BaseController
{

    public function actionIndex()
    {

        $query = Entry::find()->section('post');

        $q = Craft::$app->request->getQueryParam('q');
        $page = Craft::$app->request->getQueryParam('page', 1);

        if ($q) {
            $query->search($q)->orderBy('score');
        }

        $paginator = new Paginator($query,[
            'pageSize' => $q ? 9999 : 10,
            'currentPage' => $page
        ]);


        $entries = $paginator->getPageResults()   ;

        return $this->inertia('Posts/Index', [
            'title' => 'Posts',
            'entries' => $entries,
            'q' => $q,
            'nextUrl' => $page < $paginator->totalPages ? UrlHelper::url('/posts', ['page' => $page + 1]) : '',
            'prevUrl' => $page > 1 ? UrlHelper::url('/posts', ['page' => $page - 1]) : '',
            'pageInfo' => $paginator->totalPages > 1 ? "Page {$page} of {$paginator->totalPages}" : ''
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

        $prevEntry = $entry->getPrev(['section' => $entry->section->handle]);
        $nextEntry = $entry->getNext(['section' => $entry->section->handle]);

        return $this->inertia('Posts/Post', [
            'title' => $entry['title'],
            'entry' => $entry->getEntryData(),
            'nextUrl' => $nextEntry ? $nextEntry->getUrl() : '',
            'prevUrl' => $prevEntry ? $prevEntry->getUrl() : ''
        ]);
    }
}
