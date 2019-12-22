<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\User\ChatRepositoryImterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
//    public function test(Request $request)
//    {
//        $message = $request->input('message');
//
//        $dataArray = array(
//            'message'   => $message
//        );
//
//        $returnData = json_encode($dataArray);
//        dd($returnData);
//        return $returnData;
//    }

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
     * @param Request $request
     * @param $id
     * @return false|string
     */
    public function store(Request $request, $id)
    {
        $dataArray = array(
            'message'   => $request->input('message'),
            'user_id' => Auth::id(),
            'group_id' => $id,
        );

        $this->chatRepository->registerMessage($dataArray);


        return response()->json($dataArray);

    }
}

