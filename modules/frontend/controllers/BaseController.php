<?php

namespace modules\frontend\controllers;

use Craft;
use craft\elements\GlobalSet;
use craft\helpers\UrlHelper;
use modules\inertia\Inertia;
use modules\inertia\web\Controller;
use yii\base\InvalidConfigException;
use function explode;
use function in_array;

class BaseController extends Controller
{
    public array|int|bool $allowAnonymous = true;

    public ?string $only = '';

    public function beforeAction($action): bool
    {

        // $this->requireAdmin();

        $inertia = Inertia::getInstance();
        if (!$inertia) {
            throw new InvalidConfigException();
        }

        $inertia->share([
            'notice' => Craft::$app->session->getNotice(),
            'error' => Craft::$app->session->getError(),
        ]);

        if (Craft::$app->request->headers->has('X-Inertia-Partial-Data')) {
            $this->only = Craft::$app->request->headers->get('X-Inertia-Partial-Data');
        }

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

    public function checkOnly($key) {
        return in_array($key, explode(',', $this->only), true);
    }
}
