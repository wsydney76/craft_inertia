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
            $entries = Entry::find()->section('post')->limit(8)->orderBy('rand()')->all();

            return $this->inertia('Site/Index', [
                'randomPosts' => array_map(fn($entry) => [
                    'id' => $entry->id,
                    'title' => $entry->title,
                    'url' => $entry->inertiaUrl,
                ], $entries)
            ]);
        }

        $siteInfo = GlobalSet::find()->handle('siteInfo')->one();

        return $this->inertia('Site/Index', [
            'title' => $siteInfo->siteIntoTitle,
            'text' => HtmlHelper::getSafeHtml($siteInfo->siteIntroText),
            'buttons' => $siteInfo->siteIntroButtons
        ]);
    }

    public function actionEmpty()
    {
        return $this->inertia('Site/Empty');
    }
}
