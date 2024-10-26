<?php

namespace Kanboard\Plugin\ChatBot;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;
use Kanboard\Plugin\ChatBot\Model\ChatMessageModel;

class Plugin extends Base
{
    public function initialize()
    {
        $this->hook->on('template:layout:js', array('template' => 'plugins/ChatBot/Assets/chat.js'));
        $this->hook->on('template:layout:css', array('template' => 'plugins/ChatBot/Assets/chat.css'));

        $this->helper->hook->attach('template:layout:bottom', 'chatBot:layout/bottom', array(
            'last_message_id' => ChatMessageModel::getInstance($this->container)->getLastMessageId()
        ));

        //  - Override name should start lowercase e.g. pluginNameExampleCamelCase
        $this->template->hook->attach('template:config:application', 'chatBot:config/chatbot-settings');
        $this->template->hook->attach('template:config:sidebar', 'chatBot:config/sidebar');         
    

        $this->helper->register('chat', '\Kanboard\Plugin\ChatBot\Helper\ChatHelper');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getClasses()
    {
        return array(
            'Plugin\ChatBot\Model' => array(
                'ChatMessageModel',
                'ChatUserModel',
            )
        );
    }

    public function getPluginName()
    {
        return 'ChatBot';
    }

    public function getPluginDescription()
    {
        return t('Minimalist ChatBot for Kanboard.');
    }

    public function getPluginAuthor()
    {
        return 'Damien Trog';
    }

    public function getPluginVersion()
    {
        return '0.0.1';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/dtrog/plugin-chatbot';
    }
    
    public function getCompatibleVersion()
    {
        return '>=1.2.3';
    }
}
