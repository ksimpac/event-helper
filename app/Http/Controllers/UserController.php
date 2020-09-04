<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Barryvdh\Debugbar\Facade as DebugBar;
use Illuminate\Support\Facades\DB;
//use Barryvdh\Debugbar\Facade as Debugbar;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    {  
        
        if(request()->input('telephone') !== $user->telephone) {
            $data = request()->validate([
                'telephone' =>['required', 'size:10', 'unique:users']
            ]);
            $user->update($data);
        }
        
        if(request()->input('email') !== $user->email) {
            $data = request()->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);
            $user->update($data);
            //$user->sendEmailVerificationNotification(); //重送驗證信件
        }
        

        return redirect()->back();
    }

    public function show(User $user)
    { 
        $participants = DB::table('events')
                        ->join('participants', 'events.event_id', '=', 'participants.event_id')
                        ->where('user_id', $user->user_id)->get();
    
        $collections = DB::table('events')
                        ->join('collections', 'events.event_id', '=', 'collections.event_id')
                        ->where('user_id', $user->user_id)->get();

        return view('users.show', compact('participants','collections'));
    }
}
