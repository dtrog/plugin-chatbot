<?php

namespace Kanboard\Plugin\ChatBot\Controller;

/**
 *
 * @author Damien Trog
 */

class ChatSettingsController extends \Kanboard\Controller\PluginController
{
    /**
     * Display the Settings Page
     * Use this function to create a page showing your template content.
     * This function must be checked with 'Views - Add Menu Item - Template Hook' in Plugin.php
     * This function must be checked with 'Extra Page - Routes' in Plugin.php
     * Use: $this->helper->layout->config for config settings menu sidebar
     * Use: $this->helper->layout->plugin for plugin menu sidebar
     * @access public
     */

    public function show()
    {
        $this->response->html($this->helper->layout->config('chatBot:config/chatbot-settings', array(
            'title' => t('ChatBot'),
        )));
    }

    /**
     * Save settings
     *
     */
    public function save()
    {
        $values = $this->request->getValues();
        $redirect = $this->request->getStringParam('redirect', 'chatbot-settings');

        if ($this->configModel->save($values)) {
            $this->languageModel->loadCurrentLanguage();
            $this->flash->success(t('Settings saved successfully'));
        } else {
            $this->flash->failure(t('Unable to save your settings'));
        }

        $this->response->redirect($this->helper->url->to('ChatSettingsController', 
            $redirect, ['plugin' => 'ChatBot']));
    }
}
