<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Repositories\User\ChatRepositoryImterface;
use App\Repositories\User\GroupRepositoryImterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $groupUsers = $this->groupRepository->fetchGroupUsersByGroupId($id);

        $a = [];
        foreach ($groupUsers as $gu) {
            foreach($gu->chats as $guc) {
                return $a =  $guc->where('group_id', $id)->where('id', '>', $messageId)->with('user')->get();
            }
        }
        return $a->toJson();
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

        return response()->json($ins);
    }

    public function getUserId()
    {
        return Auth::id();
    }

    public function getSearchUsers(Request $request)
    {
//        $user = $this->user->all();

        $input = $request->input('word');
        $users = $this->user->where('name', 'LIKE', "%{$input}%")->get();
        return $users->toJson();
    }
}

