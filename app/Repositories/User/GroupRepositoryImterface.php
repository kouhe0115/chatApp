<?php

namespace App\Repositories\User;

interface GroupRepositoryImterface
{
    /**
     * 認証中ユーザーの属すグループの取得
     *
     * @param $id
     * @return mixed
     */
    public function fetchAllGroupByUserId($id);

    /**
     * 選択されたグループに属すユーザーの取得
     *
     * @param $id
     * @return mixed
     */
    public function fetchGroupUsersByGroupId($id);

    /**
     * グループの作成
     *
     * @param $attribute
     * @param $userIds
     */
    public function registerGroup($attribute, $userIds);

    /**
     * 選択されたグループに属すユーザーのメッセージを取得
     *
     * @param $id
     * @return mixed
     */
    public function fetchGroupUsersMessages($id);
}
