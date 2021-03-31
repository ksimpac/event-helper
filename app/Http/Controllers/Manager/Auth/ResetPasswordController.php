<?php

namespace App\Http\Controllers\Manager\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Manager;
use App\Rules\MatchOldPassword;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('manager.auth.resetPassword');
    }

    public function update()
    {
        $regex_pattern = 'regex:/^\S*(?=\S{8,30})(?=\S*[a-z])(?=\S*[A-Z])(?![ ])\S*$/';

        $data = request()->validate([
            'originalPassword' => ['required', new MatchOldPassword],
            'new-password' => ['required', 'string', 'min:8', 'max:30', $regex_pattern, 'different:originalPassword'],
            'new-password-confirm' => ['same:new-password']
        ]);

        Manager::where('username', Auth::user()->username)->update([
            "password" => Hash::make($data['new-password'])
        ]);

        return redirect()->back()->with('successMsg', '密碼更改成功');
    }
}
