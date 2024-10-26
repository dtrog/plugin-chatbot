<?php

namespace Kanboard\Plugin\ChatBot\Controller;

require_once __DIR__.'/../vendor/autoload.php';

use GuzzleHttp\Client as GuzzleClient;
use OpenAI;

use Kanboard\Controller\BaseController;
use Kanboard\Model\UserModel;

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
            $mentionedUsers = $this->chatUserModel->createUserMentions($values['message'], $this->userSession->getUsername());
            
            $isBotMentioned = count(array_intersect($mentionedUsers, ["bot"])) > 0;
            if ($isBotMentioned) {
                $this->askChatBot($values['message']);
            }
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
                'messages'      => $this->template->render('Chat:chat/messages', array(
                    'messages' => $this->chatMessageModel->getMessages($userId)))
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
            'messages' => $this->chatMessageModel->getMessages($this->userSession->getId()
        )));
    }

    protected function askChatBot($message)
    {
        $botUserId = $this->userModel->getIdByUsername("bot");
        $yourApiKey = $this->configModel->get("openai_api_key");
        $client = OpenAI::client($yourApiKey);

        $answer = $client->chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => $message],
            ],
        ]);
        $answerString = $answer->choices[0]->message->content;
        $this->chatMessageModel->create($botUserId, $answerString);
    }
}
