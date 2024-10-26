<?= $this->app->component('chat-widget', array(
    'defaultTitle'  => t('ChatBot'),
    'interval'      => $this->app->config('chat_refresh_interval', 3),
    'lastMessageId' => $last_message_id,
    'showUrl'       => $this->url->to('ChatController', 'show', array('plugin' => 'ChatBot')),
    'checkUrl'      => $this->url->to('ChatController', 'check', array('plugin' => 'ChatBot')),
    'pingUrl'       => $this->url->to('ChatController', 'ping', array('plugin' => 'ChatBot')),
    'ackUrl'        => $this->url->to('ChatController', 'ack', array('plugin' => 'ChatBot')),
)) ?>