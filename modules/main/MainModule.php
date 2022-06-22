<?php

namespace modules\main;

use Craft;
use craft\elements\Entry;
use craft\events\DefineFieldLayoutElementsEvent;
use craft\events\DefineRulesEvent;
use craft\models\FieldLayout;
use Illuminate\Support\Collection;
use modules\main\fieldlayoutelements\NewRow;
use modules\main\twigextensions\TwigExtension;
use modules\main\validators\BodyContentValidator;
use yii\base\Event;
use yii\base\Module;
use function implode;

class MainModule extends Module
{

    protected static $_config;

    public function init()
    {

        Craft::setAlias('@modules/main', $this->getBasePath());

        // Set the controllerNamespace based on whether this is a console or web request
        $this->controllerNamespace = Craft::$app->request->isConsoleRequest ?
            'modules\\main\\console\\controllers' :
            'modules\\main\\controllers';

        // Add Drafts Warning to UI Elements
        Event::on(
            FieldLayout::class,
            FieldLayout::EVENT_DEFINE_UI_ELEMENTS, function(DefineFieldLayoutElementsEvent $event) {
            if ($event->sender->type == 'craft\\elements\\Entry') {
                $event->elements[] = new NewRow();
            }
        }
        );

        // Validation Rules

        Event::on(
            Entry::class,
            Entry::EVENT_DEFINE_RULES, function(DefineRulesEvent $event) {
            /** @var Entry $entry */
            $entry = $event->sender;
            if ($entry->resaving || $entry->propagating || $entry->scenario != Entry::STATUS_LIVE) {
                return;
            }
            $event->rules[] = [['bodyContent'], BodyContentValidator::class];
        });

        // Validate entries on all sites (fixes open Craft bug)
        Event::on(
            Entry::class,
            Entry::EVENT_BEFORE_SAVE, function($event) {

            /** @var Entry $entry */
            $entry = $event->sender;

            // TODO: Check conditionals

            if ($entry->resaving || $entry->propagating || $entry->scenario != Entry::STATUS_LIVE) {
                return;
            }

            $entry->validate();

            if ($entry->hasErrors()) {
                return;
            }

            foreach ($entry->getLocalized()->all() as $localizedEntry) {
                $localizedEntry->scenario = Entry::SCENARIO_LIVE;

                if (!$localizedEntry->validate()) {
                    $entry->addError(
                        $entry->type->hasTitleField ? 'title' : 'slug',
                        Craft::t('site', 'Error validating entry in') .
                        ' "' . $localizedEntry->site->name . '". ' .
                        implode(' ', $localizedEntry->getErrorSummary(false)));
                    $event->isValid = false;
                }
            }
        });

        // Register Collection::one() as an alias of first(), for consistency with yii\db\Query.
        // TODO: Remove when upgrading to 4.1
        Collection::macro('one', function() {
            /** @var Collection $this */
            return $this->first(...func_get_args());
        });


        // Prevent password managers like Bitdefender Wallet from falsely inserting credentials into user form
        Craft::$app->view->hook('cp.users.edit.content', function(array &$context) {
            return '<input type="text" name="dummy-first-name" value="wtf" style="display: none">';
        });


    }

    public static function getConfig()
    {
        if (!static::$_config) {
            static::$_config = Craft::$app->config->getConfigFromFile('project');
        }
        return static::$_config;
    }

}
