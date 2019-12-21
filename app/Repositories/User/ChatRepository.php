<?php

namespace App\Repositories\User;

use App\Models\Chat;

class ChatRepository implements ChatRepositoryImterface
{
    /**
     * @var Chat
     */
    private $chat;

    /**
     * ChatRepository constructor.
     * @param Chat $chat
     */
    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    /**
     * DBへメッセージの登録
     *
     * @param $attribute
     */
    public function registerMessage($attribute)
    {
        $this->chat->create([
            'user_id' => $attribute['user_id'],
            'group_id' => $attribute['group_id'],
            'message' => $attribute['message'],
        ]);
    }
}
