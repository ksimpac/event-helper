<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class changePasswordController extends Controller
{
    public function index()
    {
        return Auth::user()->type == "系辦" ? view('admin.resetPassword') : view('auth.passwords.changePassword');
    }

    public function update()
    {
        $regex_pattern = 'regex:/^\S*(?=\S{10,30})(?=\S*[a-z])(?=\S*[A-Z])(?![ ])\S*$/';

        if (Auth::user()->type == "系辦") {
            $data = request()->validate([
                'account' => ['required', 'string', 'exists:users'],
                'new-password' => ['required', 'string', 'min:10', 'max:30', $regex_pattern],
                'new-password-confirm' => ['same:new-password']
            ]);
        } else {
            $data = request()->validate([
                'originalPassword' => ['required', 'string', new MatchOldPassword],
                'new-password' => ['required', 'string', 'min:10', 'max:30', $regex_pattern, 'different:originalPassword'],
                'new-password-confirm' => ['same:new-password']
            ]);

            $data['account'] = Auth::user()->account;
        }

        DB::table('users')->where('account', $data['account'])->update([
            "password" => Hash::make($data['new-password'])
        ]);
    }
}
