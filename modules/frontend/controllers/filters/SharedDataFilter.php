<?php

namespace modules\frontend\controllers\filters;

use Craft;
use craft\elements\GlobalSet;
use modules\inertia\Inertia;
use yii\base\ActionFilter;

class SharedDataFilter extends ActionFilter
{
  public function beforeAction($action): bool
  {
      $siteInfo = GlobalSet::find()->handle('siteInfo')->one();

      Inertia::getInstance()->share([
          'siteName' => $siteInfo->siteName ?? 'Inertia',
          'siteUrl' => '/',
          'mainNav' => Craft::$app->config->custom->siteNav,
          'notice' => Craft::$app->session->getNotice(),
          'error' => Craft::$app->session->getError(),
          'copyright' => $siteInfo->copyright,
      ]);

      return true;
  }
}
