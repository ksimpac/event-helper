<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Admin;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('admin.auth.resetPassword');
    }

    public function update()
    {
        $regex_pattern = 'regex:/^\S*(?=\S{10,30})(?=\S*[a-z])(?=\S*[A-Z])(?![ ])\S*$/';

        $data = request()->validate([
            'username' => ['required', 'string', 'exists:admins'],
            'new-password' => ['required', 'string', 'min:10', 'max:30', $regex_pattern],
            'new-password-confirm' => ['same:new-password']
        ]);

        Admin::where('username', $data['username'])->update([
            "password" => Hash::make($data['new-password'])
        ]);

        return redirect()->back()->with('successMsg', '密碼更改成功');
    }
}
