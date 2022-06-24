<?php

namespace modules\frontend\helpers;

use cebe\markdown\Markdown;
use craft\helpers\Html;
use craft\helpers\HtmlPurifier;
use function nl2br;

class HtmlHelper extends Html
{
    public static function getSafeHtml($text)
    {
        return HtmlPurifier::process(nl2br($text));
    }

    public static function getSafeMarkdownHtml($text)
    {
        $parser = new Markdown();
        $html = $parser->parse($text);

        return HtmlPurifier::process($html);
    }
}
