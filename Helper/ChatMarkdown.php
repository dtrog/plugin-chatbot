<?php

namespace Kanboard\Plugin\ChatBot\Helper;

use Kanboard\Core\Markdown;

/**
 * Class ChatMarkdown
 *
 * @package Kanboard\Plugin\ChatBot\Helper
 * @author  Damien Trog
 * @author  Frederic Guillot
 */
class ChatMarkdown extends Markdown
{
    protected function blockHeader($line)
    {
        return;
    }

    protected function blockSetextHeader($Line, array $Block = null)
    {
        return;
    }

    protected function blockCode($Line, $Block = null)
    {
        return;
    }

    protected function blockList($Line)
    {
        return;
    }

    protected function blockRule($Line)
    {
        return;
    }

    protected function blockTable($Line, array $Block = null)
    {
        return;
    }

    protected function inlineImage($Excerpt)
    {
        return;
    }
}
