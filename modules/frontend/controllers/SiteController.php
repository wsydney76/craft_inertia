<?php

namespace modules\frontend\controllers;

use craft\elements\Entry;
use craft\elements\GlobalSet;
use modules\frontend\helpers\HtmlHelper;

class SiteController extends BaseController
{
    public function actionIndex()
    {

        if ($this->only == 'randomPosts') {
            return $this->inertia('Site/Index', [
                'randomPosts' => $this->_getRandomPosts()
            ]);
        }

        $siteInfo = GlobalSet::find()->handle('siteInfo')->one();

        return $this->inertia('Site/Index', [
            'title' => $siteInfo->siteIntoTitle,
            'dashboardData' => [
                'text' => HtmlHelper::getSafeHtml($siteInfo->siteIntroText),
                'buttons' => $siteInfo->siteIntroButtons
            ]
        ]);
    }

    protected function _getRandomPosts()
    {
        $entries = Entry::find()->section('post')->limit(8)->orderBy('rand()')->all();

        return array_map(fn($entry) => [
            'id' => $entry->id,
            'title' => $entry->title,
            'url' => $entry->inertiaUrl,
        ], $entries);
    }
}
