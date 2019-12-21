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
     * * 選択されたグループに属すユーザーのメッセージを取得
     *
     * @param $id
     * @param $groupUsers
     * @return mixed
     */
    public function fetchGroupUsersMessage($id, $groupUsers);

    /**
     * グループの作成
     *
     * @param $attribute
     * @param $userIds
     */
    public function registerGroup($attribute, $userIds);
}
