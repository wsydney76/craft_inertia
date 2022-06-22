<?php

namespace modules\frontend;

use Craft;
use craft\elements\Entry;
use craft\events\DefineBehaviorsEvent;
use craft\events\RegisterTemplateRootsEvent;
use craft\web\View;
use modules\frontend\behaviors\EntryBehavior;
use yii\base\Event;
use yii\base\Module;

class AppModule extends Module
{
    public function init()
    {
        Craft::setAlias('@modules/frontend', $this->getBasePath());

        Event::on(
            View::class,
            View::EVENT_REGISTER_SITE_TEMPLATE_ROOTS,
            function(RegisterTemplateRootsEvent $event) {
                $event->roots['frontend'] = __DIR__ . '/templates';
            }
        );

        Event::on(
            Entry::class,
            Entry::EVENT_DEFINE_BEHAVIORS, function (DefineBehaviorsEvent $event) {
                $event->behaviors[] = EntryBehavior::class;
        });

        parent::init();
    }
}
