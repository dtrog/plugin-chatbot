<fieldset id="ChatBotSettings" class="panel chatbot-settings">
    <h3 class="">
        <?= t('ChatBot') ?>
    </h3>

    <fieldset class="chatbot-settings">
        <legend class=""><?= t('OpenAI API') ?></legend>
        <p class=""><?= t('Adjust the settings below to set the api key for OpenAI') ?></p>
        <fieldset class="settings-subsection">
            <legend><?= t('API Key') ?></legend>
            <div class="openai-api-key">
                <?= $this->form->label(t('API Key'), 'openai_api_key', array('class=""')) ?>
                <?= $this->form->text('openai_api_key', $values, $errors, array(), 'openai-api-key-text') ?>
            </div>
        </fieldset>
    </fieldset>
</fieldset>
