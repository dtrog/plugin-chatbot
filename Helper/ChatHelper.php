<?php

namespace Kanboard\Plugin\ChatBot\Helper;

use Kanboard\Core\Base;

/**
 * Class ChatHelper
 *
 * @package Kanboard\Plugin\ChatBot\Helper
 * @author  Damien Trog
 * @author  Frederic Guillot
 */
class ChatHelper extends Base
{
    public function markdown($text)
    {
        $parser = new ChatMarkdown($this->container, false);
        $parser->setMarkupEscaped(true);
        return $parser->text($text);
    }
}
