<fieldset id="ChatBotSettings" class="panel chatbot-settings">
    <h3 class="">
        <?= t('ChatBot Settings') ?>
    </h3>

    <fieldset class="chatbot-apikey-settings">
        <legend class=""><?= t('ChatBot OpenAI') ?></legend>
        <p class=""><?= t('Enter the OpenAI api key') ?></p>
        <div class="">
            <div class="openai-key">
                <legend class=""><?= t('OpenAI Key') ?></legend>
                <?= $this->form->label(t('OpenAI API Key'), 'openai_api_key', array('class=""')) ?>
                <?= $this->form->text('openai_api_key', $values, $errors, array('class=""'), 'openai-key-text') ?>    
            </div>
        </div>
    </fieldset>
</fieldset>
