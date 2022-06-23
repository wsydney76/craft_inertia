<?php

namespace modules\frontend\helpers;

use craft\helpers\Html;
use craft\helpers\HtmlPurifier;
use function nl2br;

class HtmlHelper extends Html
{
    public static function getSafeHtml($text)
    {
        return HtmlPurifier::process(nl2br($text));
    }
}
