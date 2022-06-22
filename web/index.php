<?php
/**
 * Craft web bootstrap file
 */

// Set path constants
use config\Env;

define('CRAFT_BASE_PATH', dirname(__DIR__));
define('CRAFT_VENDOR_PATH', CRAFT_BASE_PATH . '/vendor');

// Load Composer's autoloader
require_once CRAFT_VENDOR_PATH . '/autoload.php';


// Load and run Craft
define('CRAFT_ENVIRONMENT', Env::ENVIRONMENT ?: 'production');
$app = require CRAFT_VENDOR_PATH . '/craftcms/cms/bootstrap/web.php';
$app->run();
