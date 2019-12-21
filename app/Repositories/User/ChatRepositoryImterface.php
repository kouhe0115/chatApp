<?php

namespace App\Repositories\User;

interface ChatRepositoryImterface
{
    /**
     * DBへメッセージの登録
     *
     * @param $attribute
     */
    public function registerMessage($attribute);
}
