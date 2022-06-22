<?php

namespace modules\frontend\controllers\filters;

use craft\elements\GlobalSet;
use modules\inertia\Inertia;
use yii\base\ActionFilter;

class SharedDataFilter extends ActionFilter
{
  public function beforeAction($action): bool
  {
      Inertia::getInstance()->share([
          'siteName' => GlobalSet::find()->handle('siteInfo')->one()->siteName ?? 'Inertia',
          'siteUrl' => '',
          'mainNav' => [
              ['label' => 'Posts', 'url' => 'posts'],
              ['label' => 'Topics', 'url' => 'topics'],
              ['label' => 'Contact', 'url' => 'contact'],
          ],
      ]);

      return true;
  }
}
