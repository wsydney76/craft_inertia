<?php

namespace modules\frontend\behaviors;

use Craft;
use craft\elements\Entry;
use yii\base\Behavior;
use function nl2br;

class EntryBehavior extends Behavior
{
    public function getEntryData() {

        /** @var Entry $entry */
        $entry = $this->owner;

        $featuredImage = $entry->featuredImage->one();

        $blocks = $entry->bodyContent->all();

        $blockData = [];

        foreach ($blocks as $block) {
            switch ($block->type->handle) {
                case "heading": {
                    $blockData[] = [
                        'type' => 'heading',
                        'text' => $block->text
                    ];
                    break;
                }
                case "text": {
                    $blockData[] = [
                        'type' => 'text',
                        'text' => nl2br($block->text)
                    ];
                    break;
                }
                case "image": {
                    $image = $block->image->one();
                    $blockData[] = [
                        'type' => 'image',
                        'caption' => $block->caption,
                        'imageUrl' => $image ? $image->getUrl(['width' => 768, 'height' => 400]) : '',
                        'alt' => $image ? $image->altText : ''
                    ];
                    break;
                }
            }
        }

        return [
            'id' => $entry->id,
            'title' => $entry->title,
            'slug' => $entry->slug,
            'author' => $entry->author->name,
            'postDate' => $entry->postDate ? Craft::$app->formatter->asDate($entry->postDate) : '',
            'expiryDate' => $entry->expiryDate ? Craft::$app->formatter->asDate($entry->expiryDate) : 'n/a',
            'teaser' => $entry->teaser,
            'imageUrl' => $featuredImage ? $featuredImage->getUrl(['width' => 2000, 'height' => 400]) : '',
            'blocks' => $blockData
        ];
    }
}
