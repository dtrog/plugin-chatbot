<form method="post" autocomplete="off" action="<?= $this->url->href('ChatController', 'create', array('plugin' => 'ChatBot')) ?>" id="chat-form">
    <?= $this->form->csrf() ?>
    <?= $this->form->text('message') ?>
</form>