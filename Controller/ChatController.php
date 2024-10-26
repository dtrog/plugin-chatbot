<?php

namespace Kanboard\Plugin\ChatBot\Controller;

use Kanboard\Controller\BaseController;

/**
 * Class ChatController
 *
 * @package Kanboard\Plugin\ChatBot\Controller
 * @author  Damien Trog
 * @author  Frederic Guillot
 * @property \Kanboard\Plugin\ChatBot\Model\ChatMessageModel  $chatMessageModel
 * @property \Kanboard\Plugin\ChatBot\Model\ChatUserModel     $chatUserModel
 */
class ChatController extends BaseController
{
    public function create()
    {
        $values = $this->request->getValues();

        if (! empty($values['message'])) {
            $this->chatMessageModel->create($this->userSession->getId(), $values['message']);
            $this->chatUserModel->createUserMentions($values['message'], $this->userSession->getUsername());
        }

        $this->response->html($this->renderWidget());
    }

    public function show()
    {
        $this->response->html($this->renderWidget());
    }

    public function check()
    {
        $lastSeenMessageId = $this->request->getIntegerParam('lastMessageId');

        if ($this->chatMessageModel->hasUnseenMessages($lastSeenMessageId)) {
            $userId = $this->userSession->getId();

            $this->response->json(array(
                'lastMessageId' => $this->chatMessageModel->getLastMessageId(),
                'mentioned'     => $this->chatUserModel->hasUserMention($userId),
                'nbUnread'      => $this->chatUserModel->countUnreadMessages($userId),
                'messages'      => $this->template->render('ChatBot:chat/messages', array(
                    'messages' => $this->chatMessageModel->getMessages($userId),
                )),
            ));
        } else {
            $this->response->status(304);
        }
    }

    public function ping()
    {
        $lastSeenMessageId = $this->request->getIntegerParam('lastMessageId');

        if ($this->chatMessageModel->hasUnseenMessages($lastSeenMessageId)) {
            $userId = $this->userSession->getId();
            $this->response->json(array(
                'lastMessageId' => $this->chatMessageModel->getLastMessageId(),
                'mentioned'     => $this->chatUserModel->hasUserMention($userId),
                'nbUnread'      => $this->chatUserModel->countUnreadMessages($userId),
            ));
        } else {
            $this->response->status(304);
        }
    }

    public function ack()
    {
        $userId = $this->userSession->getId();
        $this->response->json(array('result' => $this->chatUserModel->unsetUserMention($userId)));
    }

    protected function renderWidget()
    {
        return $this->template->render('ChatBot:chat/widget', array(
            'messages' => $this->chatMessageModel->getMessages($this->userSession->getId()),
        ));
    }
}
