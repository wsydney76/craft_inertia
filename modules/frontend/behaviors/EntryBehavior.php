<?php

namespace modules\frontend\behaviors;

use Craft;
use craft\elements\Asset;
use craft\elements\Entry;
use craft\helpers\UrlHelper;
use modules\frontend\helpers\HtmlHelper;
use yii\base\Behavior;

class EntryBehavior extends Behavior
{

    public function getSiteUrl()
    {
        /** @var Entry $entry */
        $entry = $this->owner;

        switch ($entry->section->handle) {
            case 'topic':
            {
                return UrlHelper::siteUrl('topics/' . $entry->slug);
            }
            default: {
                return UrlHelper::siteUrl('posts/' . $entry->slug);
            }

        }
    }

    public function getEntryData(): array
    {

        /** @var Entry $entry */
        $entry = $this->owner;

        $featuredImageTransform = ['width' => 2000, 'height' => 400, 'format' => 'webp'];
        $blockImageTransform = ['width' => 768, 'height' => 400, 'format' => 'webp'];

        $blocks = $entry->bodyContent
            ->with([
                ['bodyContent:image', ['withTransforms' => [$blockImageTransform]]],
                ['bodyContent:images', ['withTransforms' => ['galleryThumbnail', 'galleryFullHeight']]]
            ])
            ->all();

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
                            'image' => $this->getImageData($image, $blockImageTransform)
                        ];
                    }
                    break;
                }

                case "quote":
                {
                    $blockData[] = [
                        'type' => 'quote',
                        'text' => HtmlHelper::getSafeHtml($block->text),
                        'attribution' => $block->attribution
                    ];
                    break;
                }

                case "button":
                {
                    $target = $block->target->one();
                    if ($target) {
                        $blockData[] = [
                            'type' => 'button',
                            'url' => $target->getsiteUrl(),
                            'caption' => $block->caption ?: $target->title
                        ];
                    }
                    break;
                }

                case "gallery":
                {
                    $images = $block->images->withTransforms(['galleryThumbnail', 'galleryFullHeight'])->all();

                    if ($images) {
                        $imageData = [];
                        foreach ($images as $image) {
                            $imageData[] = [
                                'thumbnailUrl' => $image->getUrl('galleryThumbnail'),
                                'fullHeightUrl' => $image->getUrl('galleryFullHeight'),
                                'caption' => $image->altText ?: $image->title
                            ];
                        }

                        $blockData[] = [
                            'type' => 'gallery',
                            'id' => $block->id,
                            'images' => $imageData
                        ];
                    }

                    break;
                }
            }
        }

        $topicsData = [];
        $topics = $entry->topics->all();

        return [
            'id' => $entry->id,
            'title' => $entry->title,
            'slug' => $entry->slug,
            'author' => $entry->author->name,
            'postDate' => $entry->postDate ? Craft::$app->formatter->asDate($entry->postDate) : '',
            'expiryDate' => $entry->expiryDate ? Craft::$app->formatter->asDate($entry->expiryDate) : 'n/a',
            'teaser' => $entry->teaser,
            'featuredImage' => $this->getImageData($entry->featuredImage->one(), $featuredImageTransform, [1024, 640, 480]),
            'blocks' => $blockData,
            'topics' => array_map(fn($entry) => [
                'id' => $entry->id,
                'title' => $entry->title,
                'url' => $entry->siteUrl
            ], $topics)
        ];
    }

    protected function getImageData(?Asset $image, mixed $transform, $srcset = ''): array
    {
        if (!$image) {
            return [];
        }

        $image->setTransform($transform);

        return [
            'url' => $image->getUrl(),
            'alt' => $image->altText ?: $image->title,
            'copyright' => $image->copyright,
            'srcset' => $srcset ? $image->getSrcset($srcset) : '',
            'width' => $image->width,
            'height' => $image->height
        ];
    }
}
