<fieldset>
    <legend><?= t('ChatBot') ?></legend>

    <?= $this->form->label(t('OpenAI API Key'), 'openai_api_key') ?>
    <?= $this->form->text('openai_api_key', $values, $errors) ?>    

    
    <?= $this->form->label(t('Refresh Interval'), 'chat_refresh_interval') ?>
    <?= $this->form->number('chat_refresh_interval', $values, $errors) ?>
    <p class="form-help"><?= t('Period in second (3 seconds by default)') ?></p>
</fieldset>