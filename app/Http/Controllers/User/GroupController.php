<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\GroupRepository;
use Illuminate\Support\Facades\Auth;
use App\User;

class GroupController extends Controller
{
    private $groupRepository;

    /**
     * ChatController constructor.
     */
    public function __construct(GroupRepository $groupRepository)
    {
        $this->middleware('auth');
        $this->groupRepository =  $groupRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $groups = $this->groupRepository->fetchAllGroupByUserId(Auth::id());
        return view('User.Group.index', compact('groups'));
    }

    /**
     * 各グループの表示
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $groups = $this->groupRepository->fetchAllGroupByUserId(Auth::id());
        $groupUsers = $this->groupRepository->fetchGroupByUserId($id);
        $groupUserChat = $this->groupRepository->fetchGroupUsersMessage($id, $groupUsers);

        return view('User.Group.show', compact('groupUserChat','groups', 'groupUsers'));
    }


    public function create()
    {
        $users = User::all();
        return view('User.Group.create', compact('users'));
    }

    /**
     * グループ作成機能
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = array_merge($inputs['user_id'], array(Auth::id()));
        $this->groupRepository->registerGroup($inputs);

        return redirect()->action('User\GroupController@index');
    }
}
