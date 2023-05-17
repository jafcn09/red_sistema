<?php

namespace App\Http\Controllers;
use App\Planes;
use App\Message;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    //
/*     public function __construct(){
        $this->middleware('auth');
    } */
    public function index(){
        $planes = Planes::get();
        return view('chats',compact('planes'));
    }
    //Mensajes recibir
    public function fetchMessages(){
        return Message::with('user')->get();
    }
        //Mensajes recibir
    public function sendMessages(Request $request){
        auth()->user()->messages()->create([
            'message'   =>  $request->mesage
        ]);
        return ['status' => 'success'];
    }
}
