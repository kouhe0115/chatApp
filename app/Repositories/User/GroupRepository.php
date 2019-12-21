<?php

namespace App\Repositories\User;

use App\Models\Group;
use App\User;

class GroupRepository
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
    public function fetchGroupByUserId($id)
    {
        return $this->group->find($id)->users->all();
    }

    /**
     * * 選択されたグループに属すユーザーのメッセージを取得
     *
     * @param $id
     * @param $groupUsers
     * @return mixed
     */
    public function fetchGroupUsersMessage($id, $groupUsers)
    {
        foreach ($groupUsers as $gu) {
            foreach($gu->chats as $guc) {
                return $guc->where('group_id', $id)->with('user')->get();
            }
        }
    }

    public function registerGroup($attribute)
    {
        $name = $attribute['name'];

        $userId = $attribute['user_id'];
        $this->group->create(array(
            'name' => $name,
        ))->users()->attach($userId);
    }
}
