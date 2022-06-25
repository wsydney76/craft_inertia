<?php

namespace modules\frontend\controllers;

use Craft;
use craft\elements\GlobalSet;
use modules\inertia\Inertia;
use modules\inertia\web\Controller;

class BaseController extends Controller
{
    public array|int|bool $allowAnonymous = true;

    public function beforeAction($action): bool
    {

        if (!Craft::$app->request->headers->has('X-Inertia-Partial-Data')) {
            $siteInfo = GlobalSet::find()->handle('siteInfo')->one();

            Inertia::getInstance()->share([
                'siteName' => $siteInfo->siteName ?? 'Inertia',
                'siteUrl' => '/',
                'mainNav' => Craft::$app->config->custom->siteNav,
                'notice' => Craft::$app->session->getNotice(),
                'error' => Craft::$app->session->getError(),
                'copyright' => $siteInfo->copyright,
            ]);
        }

        return true;
    }
}
