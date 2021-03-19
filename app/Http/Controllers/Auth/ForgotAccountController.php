<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForgotAccountController extends Controller
{
    public function index()
    {
        return view('admin.forgotAccount');
    }

    public function getInfo()
    {
        $data = request()->validate([
            'std_id' => ['required', 'string', 'min:10', 'max:10', 'exists:users'],
            'realname' => ['required', 'string', 'min:2', 'max:255', 'exists:users'],
            'telephone' => ['required', 'string', 'min:10', 'max:10', 'exists:users']
        ]);

        $userInfo = DB::table('users')
                    ->where('std_id', $data['std_id'])
                    ->where('realname', $data['realname'])
                    ->where('telephone', $data['telephone'])->first();

        return redirect()->back()->with('successMsg', 'success')->with('account', $userInfo->account)->with('email', $userInfo->email);
    }
}
