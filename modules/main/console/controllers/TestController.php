<?php

namespace modules\main\console\controllers;

use Craft;
use craft\console\Controller;
use craft\db\Table;
use craft\helpers\FileHelper;
use craft\volumes\Local;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use yii\base\ErrorException;
use yii\console\ExitCode;
use yii\db\Exception;
use function is_dir;
use function rmdir;
use function strpos;
use const DIRECTORY_SEPARATOR;

class TestController extends Controller
{

    /**
     *
     * .\craft main/test/hello-world
     *
     * @return int
     */
    public function actionHelloWorld()
    {
        $this->stdout('Hello World');
        return ExitCode::OK;
    }

    // This is an example, better call a service method in real live.
    //
    // .\craft main/test/clear-image-transform-directories
    //

    /**
     * Clear all image transform stuff
     *
     * @throws Exception
     */
    public function actionClearImageTransformDirectories()
    {

        if (!$this->confirm('This will delete all image transform data', true)) {
            return ExitCode::OK;
        }
        Craft::$app->getDb()->createCommand()
            ->truncateTable(Table::ASSETTRANSFORMINDEX)
            ->execute();

        $volumes = Craft::$app->volumes->getAllVolumes();
        foreach ($volumes as $volume) {
            $this->_clearVolume($volume);
        }

        echo 'Image Transform Directories cleared';
        return ExitCode::OK;
    }

    private function _clearVolume(Local $volume)
    {
        $root = Craft::parseEnv($volume->path);
        $dirs = $this->_getTransFormDirs($root);
        foreach ($dirs as $dir) {
            $this->_deleteDir($dir);
        }
    }

    /**
     * @param $path
     * @return array
     */
    private function _getTransFormDirs($path): array
    {
        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

        $dirs = [];
        foreach ($rii as $dir) {
            if ($dir->isDir() && strpos($dir->getPathname(), DIRECTORY_SEPARATOR . '_') &&
                !strpos($dir->getPathname(), '..')) {
                $dirs[] = $dir->getPathname();
            }
        }

        return $dirs;
    }

    private function _deleteDir($dir)
    {
        if (is_dir($dir)) {
            try {
                echo "Deleting {$dir}\n";
                FileHelper::clearDirectory($dir);
                rmdir($dir);
            } catch (ErrorException $e) {
                echo 'Error deleting ' . $dir . ': ' . $e->getMessage() . PHP_EOL;
            }
        }
    }
}
