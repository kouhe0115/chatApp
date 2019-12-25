<?php

namespace App\Http\Controllers\User;

use App\Repositories\User\GroupRepositoryImterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    private $groupRepository;

    /**
     * GroupController constructor.
     * @param GroupRepositoryImterface $groupRepository
     */
    public function __construct(GroupRepositoryImterface $groupRepository)
    {
        $this->middleware('auth');
        $this->groupRepository = $groupRepository;
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
        $groupUsers = $this->groupRepository->fetchGroupUsersByGroupId($id);
        $groupUserChat = $this->groupRepository->fetchGroupUsersMessages($id);

        return view('User.Group.show', compact('groupUserChat', 'groups', 'groupUsers'));
    }

    /**
     * グループ作成ページの表示
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $groups = $this->groupRepository->fetchAllGroupByUserId(Auth::id());
        return view('User.Group.create', compact('users', 'groups'));
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
        $userIds = array_unique(array_merge($inputs['user_id'], array(Auth::id())));
        $this->groupRepository->registerGroup($inputs, $userIds);

        return redirect()->action('User\GroupController@index');
    }
}
