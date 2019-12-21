<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\User\ChatRepository;


class ChatController extends Controller
{
    /**
     * @var ChatRepository
     */
    private $chatRepository;

    /**
     * ChatController constructor.
     * @param ChatRepository $chatRepository
     */
    public function __construct(ChatRepository $chatRepository)
    {
        $this->middleware('auth');
        $this->chatRepository = $chatRepository;
    }

    /**
     * メッセージ作成
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $inputs = $request->only('message', 'group_id');
        $inputs['user_id'] = Auth::id();
        $groupId = $request->input('group_id');

        $this->chatRepository->registerMessage($inputs);
        return redirect()->action('User\GroupController@show', $groupId);
    }
}
