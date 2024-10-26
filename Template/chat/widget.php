<div id="chat-widget-messages-container">
    <?= $this->render('chatBot:chat/messages', array('messages' => $messages)) ?>
</div>
<?= $this->render('chatBot:chat/form') ?>