<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Group;
use App\Repositories\User\ChatRepositoryImterface;
use App\Repositories\User\GroupRepositoryImterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ChatController extends Controller
{
    /**
     * @var ChatRepositoryImterface
     */
    private $chatRepository;

    /**
     * @var GroupRepositoryImterface
     */
    private $groupRepository;

    private $user;

    /**
     * ChatController constructor.
     * @param ChatRepositoryImterface $chatRepository
     * @param GroupRepositoryImterface $groupRepository
     * @param User $user
     */
    public function __construct(ChatRepositoryImterface $chatRepository, GroupRepositoryImterface $groupRepository, User $user)
    {
        $this->middleware('auth');
        $this->chatRepository = $chatRepository;
        $this->groupRepository = $groupRepository;
        $this->user = $user;
    }

    public function show(Request $request, $id)
    {
        $messageId  = $request->input('message_id');

        $a = DB::select('
            select *
            from `users`
            inner join `chats`
            on `chats`.`user_id` = `users`.`id`
            where `chats`.`group_id` = ?
            and `chats`.`id` > ?'
            , [$id, $messageId]
        );

        foreach ($a as $key => $ai) {
            $ai->avatar = asset('storage/cover/' . $ai->avatar);
        }

        return json_encode($a);
    }

    /**
     * @param Request $request
     * @param $id
     * @return false|string
     */
    public function store(Request $request, $id)
    {

        $ins = Chat::create([
            'user_id' => Auth::id(),
            'group_id' => $id,
            'message'   => $request->input('message'),
        ]);

        $ins->user->avatar = asset('storage/cover/' . $ins->user->avatar);
        return response()->json($ins);
    }

    public function getUserId()
    {
        return Auth::id();
    }

    public function getSearchUsers(Request $request)
    {
        $input = $request->input('word');
        $users = $this->user->where('name', 'LIKE', "%{$input}%")->get();

        $us = $users->toArray();

        foreach ($us as $key => $u) {
            $us[$key]['avatar'] = asset('storage/cover/' . $u['avatar']);
        }

        return json_encode($us);
    }
}

