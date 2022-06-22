<?php

namespace modules\main\variables;

use modules\main\MainModule;
use yii\base\Behavior;

class ProjectVariable extends Behavior
{

    public function config()
    {
       return MainModule::getConfig();
    }
}
