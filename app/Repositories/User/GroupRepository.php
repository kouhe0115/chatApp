<?php

namespace App\Repositories\User;

use App\Models\Group;
use App\User;
use DB;

class GroupRepository implements GroupRepositoryImterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Group
     */
    private $group;

    /**
     * GroupRepository constructor.
     * @param User $user
     * @param Group $group
     */
    public function __construct(User $user, Group $group)
    {
        $this->user = $user;
        $this->group = $group;
    }

    /**
     * 認証中ユーザーの属すグループの取得
     *
     * @param $id
     * @return mixed
     */
    public function fetchAllGroupByUserId($id)
    {
        return $this->user->find($id)->groups()->get();
    }

    /**
     * 選択されたグループに属すユーザーの取得
     *
     * @param $id
     * @return mixed
     */
    public function fetchGroupUsersByGroupId($id)
    {
        return $this->group->find($id)->users->all();
    }

    /**
     * 選択されたグループに属すユーザーのメッセージを取得
     *
     * @param $userId
     * @param $id
     * @return mixed
     */
    public function fetchGroupUsersMessages($id)
    {
        return DB::select('
            select *
            from `users`
            inner join `chats`
            on `chats`.`user_id` = `users`.`id`
            where `chats`.`group_id` = ?
            '
            , [$id]
        );
    }

    /**
     * グループの作成
     *
     * @param $attribute
     * @param $userIds
     */
    public function registerGroup($attribute, $userIds)
    {
        $this->group->create(array(
            'name' => $attribute['name'],
        ))->users()->attach($userIds);
    }
}
