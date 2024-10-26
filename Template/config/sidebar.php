<li <?= $this->app->checkMenuSelection('ChatSettingsController', 'show', 'ChatBot') ?>>
    <?= $this->url->link(t('ChatBot Settings'), 'ChatSettingsController', 'show', ['plugin' => 'ChatBot']) ?>
</li>