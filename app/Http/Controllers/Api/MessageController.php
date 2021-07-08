<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Pusher\Pusher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function getNasabah()
    {
        $users = User::select('users.id', 'users.name', 'ft_profile.foto')->where('role', 'Nasabah')->leftJoin('ft_profile', 'users.id', '=', 'ft_profile.user_id')->get();
        return response()->json($users, 200);
    }
    public function getPengurus()
    {
        $users = User::select('users.id', 'users.name', 'ft_profile.foto')->where('role', 'Pengurus1')->leftJoin('ft_profile', 'users.id', '=', 'ft_profile.user_id')->get();
        return response()->json($users, 200);
    }

    public function sendMessage(Request $request, $id)
    {
        $data = $request->only('message');
        $validator = Validator::make($data, [
            'message' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
          );
          
        $pusher = new Pusher(
            'ee32967882a02fdcd1a2',
            'ef112da7d7cb82023f55',
            '1215543',
            $options
        );
        
        $from = Auth::id();
        $to = $id;
        $messages = $request->message;

        $message = Message::create([
            'from' => $from,
            'to' => $to,
            'message' => $messages,
            'is_read' => 0,
        ]);

        $pusher->trigger('my-channel', 'my-event', $message);

        return response()->json($message, 200);
    }

    public function getMessage($id)
    {
        $my_id = Auth::id();
        $message = Message::where(function ($query) use ($id, $my_id) {
            $query->where('from', $my_id)->where('to', $id);
        })->orWhere(function($query) use ($id, $my_id){
            $query->where('from', $id)->where('to', $my_id)->update([
            'is_read' => 1
        ]);
        })->orderBy('created_at', 'DESC')->get();

        return response()->json($message, 200);
    }

    public function index()
    {
        $my_id = Auth::id();
        $from = User::select('users.id', 'users.name', 'ft_profile.foto', 'messages.is_read', 'messages.message')->where('users.id', '!=', $my_id)->leftJoin('ft_profile', 'users.id', '=', 'ft_profile.user_id')->join('messages', 'messages.to', '=', 'users.id')->where('messages.from', '=', $my_id)->get()->toArray();

        $to = User::select('users.id', 'users.name', 'ft_profile.foto', 'messages.is_read', 'messages.message')->where('users.id', '!=', $my_id)->leftJoin('ft_profile', 'users.id', '=', 'ft_profile.user_id')->join('messages', 'messages.from', '=', 'users.id')->where('messages.to', '=', $my_id)->get()->toArray();

        $data = array_unique(array_merge($from, $to), SORT_REGULAR);
        $message = array_values($data);
        // var_dump($message);
        return response()->json($message, 200);
    }
}
