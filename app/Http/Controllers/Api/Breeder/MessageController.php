<?php

namespace App\Http\Controllers\Api\Breeder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Models\Message;
use App\Models\User;
use App\Models\Customer;

use JWTAuth;
use Auth;

class MessageController extends Controller
{
    public function __construct() 
    {
        $this->middleware('jwt:auth');
        $this->middleware('jwt.role:breeder');
        $this->middleware(function($request, $next) {
            $this->user = JWTAuth::user();
            return $next($request);
        });
    }

    public function getMessages(Request $request, $customer_id)
    {   
        $user_id = $this->user->id;

        $messages = Message::where('breeder_id', '=', $user_id)
                ->where('customer_id', $customer_id)
                ->orderBy('id', 'DESC')
                ->paginate($request->limit)
                ->map(function ($item) {

                    // if($item->read_at == NULL){
                    //     $item->read_at = date('Y-m-d H:i:s');
                    //     $item->save();
                    // }

                    $message = [];

                    $message['id'] = $item->id;
                    $message['id'] = $item->id;
                    $message['direction'] = $item->direction;
                    $message['message'] = $item->message;
                    $message['read_at'] = $item->read_at;
                    $message['customer_id'] = $item->customer_id;
                    $message['breeder_id'] = $item->breeder_id;

                    return $message;
                });

        return response()->json([
            'message' => 'Get Messages successful!',
            'data' => [
                'count' => $messages->count(),
                'messages' => $messages
            ]
        ], 200);
    }

    public function getThreads(Request $request)
    {   
        $user_id = $this->user->id;

        $threads = Message::where('breeder_id', '=', $user_id)
	    		->orderBy('created_at', 'DESC')
                ->get()
                ->unique('customer_id')
                ->values()
                ->forPage($request->page, $request->limit)
                ->map(function ($item) {

                    $thread = [];

                    $user = User::find($item->customer_id);

                    $thread['user'] = [ 
                        'id' => $user->id,
                        'name' => $user->name
                    ];

                    $thread['message'] = [
                        'id' => $item->id,
                        'direction' => $item->direction,
                        'content' => $item->message,
                        'read_at' => $item->read_at,
                    ];

                    return $thread;
                });

        return response()->json([
            'message' => 'Get Threads successful!',
            'data' => [
                'count' => $threads->count(),
                'threads' => $threads,
            ]
        ], 200);
        
    }

    public function seeMessage(Request $request)
    {

    }
}
