<?php

namespace modules\frontend\controllers;

use craft\elements\GlobalSet;
use modules\frontend\helpers\HtmlHelper;

class SiteController extends BaseController
{
    public function actionIndex()
    {
        $siteInfo = GlobalSet::find()->handle('siteInfo')->one();


        return $this->inertia('Site/Index', [
            'title' => $siteInfo->siteIntoTitle,
            'text' => HtmlHelper::getSafeHtml($siteInfo->siteIntroText),
            'buttons' => $siteInfo->siteIntroButtons
        ]);
    }
}
