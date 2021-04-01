<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Manager;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('admin.auth.resetPassword');
    }

    public function update(Request $request)
    {
        $regex_pattern = 'regex:/^\S*(?=\S{8,30})(?=\S*[a-z])(?=\S*[A-Z])(?![ ])\S*$/';

        $data = $request->validate([
            'type' => ['required', 'in:0,1'],
            'username' => ['required', 'string', $request->input('type') == '0' ? 'exists:admins' : 'exists:managers'],
            'new-password' => ['required', 'string', 'min:8', 'max:30', $regex_pattern],
            'new-password-confirm' => ['same:new-password']
        ]);

        if ($data['type'] == '0') {
            Admin::where('username', $data['username'])->update([
                "password" => Hash::make($data['new-password'])
            ]);
        }

        if ($data['type'] == '1') {
            Manager::where('username', $data['username'])->update([
                "password" => Hash::make($data['new-password'])
            ]);
        }

        return redirect()->back()->with('successMsg', '密碼更改成功');
    }
}
