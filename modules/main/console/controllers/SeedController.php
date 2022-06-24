<?php

namespace modules\main\console\controllers;

use Craft;
use craft\console\Controller;
use craft\elements\Asset;
use craft\elements\Entry;
use craft\elements\User;
use Faker\Factory;
use Faker\Generator;
use yii\console\ExitCode;
use yii\helpers\Console;
use function implode;
use const PHP_EOL;

class SeedController extends Controller
{
    public const NUM_ENTRIES = 10;
    public const SECTIONHANDLE = 'post';
    public $topicSlug = 'examples';

    public function actionCreateEntries(int $num = self::NUM_ENTRIES, $sectionHandle = self::SECTIONHANDLE): int
    {
        $section = Craft::$app->sections->getSectionByHandle($sectionHandle);
        if (!$section) {
            $this->stderr("Invalid section {$sectionHandle}") . PHP_EOL;
            return ExitCode::UNSPECIFIED_ERROR;
        }

        if (!$this->confirm("Create {$num} entries of type '{$section->name}'?")) {
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $faker = Factory::create();

        $type = $section->getEntryTypes()[0];
        $user = User::find()->admin()->one();

        $topic = $this->getTopic();

        for ($i = 1; $i <= $num; $i++) {
            $entry = new Entry();
            $entry->sectionId = $section->id;
            $entry->typeId = $type->id;
            $entry->authorId = $user->id;
            $entry->postDate = $faker->dateTimeInInterval('-1 days', '-2 months');

            $title = $faker->text(50);
            $this->stdout("[{$i}/{$num}] Creating {$title} ... ");

            $entry->title = $title;
            $entry->setFieldValue('teaser', $faker->text(50));

            $image = $this->getRandomImage(1900);
            if ($image) {
                $entry->setFieldValue('featuredImage', [$image->id]);
            }

            if ($topic && $sectionHandle == 'post') {
                $entry->setFieldValue('topics', [$topic->id]);
            }

            $entry->setFieldValue('bodyContent', $this->getBodyContent($faker));

            if (Craft::$app->elements->saveElement($entry)) {
                $this->stdout('done, ID:' . $entry->id . PHP_EOL);
            } else {
                $this->stderr('failed: ' . implode(', ', $entry->getErrorSummary(true)) . PHP_EOL, Console::FG_RED);
            }
        }

        return ExitCode::OK;
    }

    protected function getBodyContent(Generator $faker)
    {

        $content = [
            'sortOrder' => [],
            'blocks' => []
        ];

        $layouts = [
            ['text', 'heading', 'image', 'text', 'image'],
            ['image', 'text', 'heading', 'text', 'quote', 'text', 'gallery'],
            ['text', 'text', 'text', 'heading', 'text', 'text', 'text', 'heading', 'text', 'text', 'text'],
            ['image', 'image', 'image'],
            ['text', 'text', 'quote', 'text', 'image'],
            ['heading', 'text', 'text', 'heading', 'text', 'quote'],
            ['text', 'heading', 'gallery']
        ];

        $blockTypes = $faker->randomElement($layouts);

        $i = 0;
        foreach ($blockTypes as $blockType) {

            switch ($blockType) {
                case 'text':
                    $block = [
                        'type' => 'text',
                        'fields' => [
                            'text' => $faker->paragraphs($faker->numberBetween(1, 5), true)
                        ]
                    ];
                    break;
                case 'heading':
                    $block = [
                        'type' => 'heading',
                        'fields' => [
                            'text' => $faker->text(40)
                        ]
                    ];
                    break;
                case 'image':
                    $image = $this->getRandomImage(900);
                    $block = [
                        'type' => 'image',
                        'fields' => [
                            'image' => $image ? [$image->id] : null,
                            'caption' => $faker->text(30)
                        ]
                    ];
                    break;
                case 'gallery':
                    $imageIds = [];
                    for ($img = 0; $img < 6; $img++) {
                        $image = $this->getRandomImage(500);
                        if ($image) {
                            $imageIds[] = $image->id;
                        }
                    }
                    $block = [
                        'type' => 'gallery',
                        'fields' => [
                            'images' => $imageIds
                        ]
                    ];
                    break;
                case 'quote':
                    $block = [
                        'type' => 'quote',
                        'fields' => [
                            'text' => $faker->text(80),
                            'attribution' => $faker->name
                        ]
                    ];
                    break;
            }

            $i++;
            $id = "new{$i}";
            $content['sortOrder'][] = $id;
            $content['blocks'][$id] = $block;
        }

        $id = 'newExample';
        $content['sortOrder'][] = $id;
        $content['blocks'][$id] = [
            'blockType' => 'text',
            'fields' => [
                'text' => 'This is an autogenerated example entry.',
                'display' => 'information'
            ]
        ];

        return $content;
    }

    protected function getRandomImage($width = 1900)
    {
        return Asset::find()
            ->volume('images')
            ->kind('image')
            ->width('> ' . $width)
            ->orderBy(Craft::$app->db->driverName == 'mysql' ? 'RAND()' : 'RANDOM()')
            ->one();
    }

    public function actionDeleteFakedPosts()
    {
        $topic = Entry::find()->section('topic')->slug($this->topicSlug)->one();
        if (!$topic) {
            $this->stderr('No example topic found');
            return;
        }
        $entries = Entry::find()->section('post')->relatedTo($topic)->anyStatus()->all();
        if (!$entries) {
            $this->stderr('No example posts found');
            return;
        }
        $count = count($entries);
        if (!$this->confirm("Delete {$count} posts related to topic {$topic->title}?")) {
            return;
        }
        foreach ($entries as $entry) {
            $this->stdout("Deleting {$entry->title}" . PHP_EOL);
            Craft::$app->elements->deleteElement($entry);
        }
        if (!$this->confirm("Delete example topic?")) {
            return;
        }
        Craft::$app->elements->deleteElement($topic);

        $this->stdout('The entries have been soft-deleted, they can be restored from the entries index.' . PHP_EOL);
    }

    protected function getTopic()
    {
        $entry = Entry::find()->section('topic')->slug($this->topicSlug)->one();
        if (!$entry) {
            $section = Craft::$app->sections->getSectionByHandle('topic');
            if (!$section) {
                return $entry;
            }
            $type = $section->getEntryTypes()[0];
            $user = User::find()->admin()->one();
            $entry = new Entry();
            $entry->sectionId = $section->id;
            $entry->typeId = $type->id;
            $entry->authorId = $user->id;
            $entry->title = 'Examples';
            $entry->slug = $this->topicSlug;
            $entry->setFieldValue('teaser', 'Collection of auto-generated examples');
            $this->stdout('Creating Example Content Topic ... ');

            if (!Craft::$app->elements->saveElement($entry)) {
                $this->stderr('failed: ' . implode(', ', $entry->getErrorSummary(true)) . PHP_EOL, Console::FG_RED);
            } else {
                $localEntry = $entry->getLocalized()->one();
                if ($localEntry) {
                    $localEntry->title = 'Beispiele';
                    $localEntry->slug = 'beispiele';
                    $localEntry->setFieldValue('teaser', 'Sammlung von automatisch generierten Beispielen');
                    Craft::$app->elements->saveElement($localEntry);
                }
                $this->stdout('done' . PHP_EOL);
            }
        }
        return $entry;
    }
}
