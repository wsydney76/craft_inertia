<?php

namespace modules\main\validators;

use Craft;
use yii\validators\Validator;

class BodyContentValidator extends Validator

// https://nystudio107.com/blog/custom-matrix-block-validation-rules

{
    public function validateAttribute($entry, $attribute)
    {
        $isHeadingLevelValid = true;
        $lastHeadingLevel = 1;

        $query = $entry->$attribute;
        // Iterate through all of the blocks
        $blocks = $query->getCachedResult() ?? $query->limit(null)->anyStatus()->all();

        foreach ($blocks as $block) {

            if ($block->type->handle == 'heading') {
                $level = (int)str_replace('h', '', $block->tag->value);
                if ($level - $lastHeadingLevel > 1) {
                    $block->addError('tag', Craft::t('site', 'h{level} cannot follow h{lastHeadingLevel}', [
                        'level' => $level,
                        'lastHeadingLevel' => $lastHeadingLevel
                    ]));
                    $isHeadingLevelValid = false;
                }
                $lastHeadingLevel = $level;
            }
        }

        $query->setCachedResult($blocks);

        if (!$isHeadingLevelValid) {
            $entry->addError('bodyContent', Craft::t('site', 'Nesting of heading levels is wrong.'));
        }
    }
}
