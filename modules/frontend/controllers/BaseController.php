<?php

namespace modules\frontend\controllers;

use Craft;
use craft\elements\GlobalSet;
use craft\helpers\UrlHelper;
use modules\inertia\Inertia;
use modules\inertia\web\Controller;
use yii\base\InvalidConfigException;

class BaseController extends Controller
{
    public array|int|bool $allowAnonymous = true;

    public mixed $only = [];

    public function beforeAction($action): bool
    {

        $inertia = Inertia::getInstance();
        if (!$inertia) {
            throw new InvalidConfigException();
        }

        $inertia->share([
            'notice' => Craft::$app->session->getNotice(),
            'error' => Craft::$app->session->getError(),
        ]);

        $this->only = Craft::$app->request->headers->get('X-Inertia-Partial-Data');

        if (!$this->only) {
            $siteInfo = GlobalSet::find()->handle('siteInfo')->one();

            $inertia->share([
                'siteInfo' => [
                    'siteName' => $siteInfo->siteName ?? 'Inertia',
                    'siteUrl' => UrlHelper::siteUrl('/'),
                    'mainNav' => Craft::$app->config->custom->siteNav,
                    'copyright' => $siteInfo->copyright,
                ]
            ]);
        }

        return true;
    }
}
