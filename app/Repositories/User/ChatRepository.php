<?php

namespace App\Repositories\User;

use App\Models\Chat;

class ChatRepository
{
    private $chat;

    /**
     * ChatRepository constructor.
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
        $this->chat->create($attribute);
    }
}
