<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\ChatRepositoryImterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * @var ChatRepositoryImterface
     */
    private $chatRepository;

    /**
     * ChatController constructor.
     * @param ChatRepositoryImterface $chatRepository
     */
    public function __construct(ChatRepositoryImterface $chatRepository)
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
    public function store(Request $request, $id)
    {
        $inputs = $request->only('message', 'group_id');
        $inputs['user_id'] = Auth::id();
        $inputs['group_id'] = $id;

        $this->chatRepository->registerMessage($inputs);
        return redirect()->action('User\GroupController@show', $inputs['group_id']);
    }
}
