<?php

namespace modules\frontend\behaviors;

use Craft;
use craft\elements\Entry;
use craft\helpers\HtmlPurifier;
use modules\frontend\helpers\HtmlHelper;
use yii\base\Behavior;
use function nl2br;

class EntryBehavior extends Behavior
{
    public function getEntryData()
    {

        /** @var Entry $entry */
        $entry = $this->owner;

        $featuredImage = $entry->featuredImage->one();
        if ($featuredImage) {
            $featuredImage->setTransform(['width' => 2000, 'height' => 400, 'format' => 'webp']);
        }

        $blocks = $entry->bodyContent->all();

        $blockData = [];

        foreach ($blocks as $block) {
            switch ($block->type->handle) {
                case "heading":
                {
                    $blockData[] = [
                        'type' => 'heading',
                        'text' => $block->text
                    ];
                    break;
                }
                case "text":
                {
                    $blockData[] = [
                        'type' => 'text',
                        'text' => HtmlHelper::getSafeMarkdownHtml($block->text)
                    ];
                    break;
                }
                case "image":
                {
                    $image = $block->image->one();
                    if ($image) {
                        $image->setTransform(['width' => 768, 'height' => 400, 'format' => 'webp']);
                        $blockData[] = [
                            'type' => 'image',
                            'caption' => $block->caption,
                            'image' => [
                                'url' => $image->getUrl(),
                                'alt' => $image->altText ?: $image->title
                            ]
                        ];
                    }
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
            'featuredImage' => $featuredImage ? [
                'url' => $featuredImage->getUrl(),
                'alt' => $featuredImage->altText ?: $featuredImage->title,
                'copyright' => $featuredImage->copyright,
                'srcset' => $featuredImage->getSrcset([1024, 640, 480])
            ] : [],
            'blocks' => $blockData
        ];
    }
}
