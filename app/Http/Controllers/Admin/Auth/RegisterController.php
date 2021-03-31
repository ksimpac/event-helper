<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Manager;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.auth.register');
    }

    public function store(Request $request) //儲存建立的帳號
    {
        $regex_pattern = 'regex:/^\S*(?=\S{8,30})(?=\S*[a-z])(?=\S*[A-Z])(?![ ])\S*$/';

        $data = $request->validate([
            'type' => ['required', 'in:0,1'],
            'username' => [
                'required', 'string', 'min:8', 'max:30', $regex_pattern,
                $request->input('type') == '0' ? 'unique:admins' : 'unique:managers'
            ],
            'password' => ['required', 'string', 'min:8', 'max:30', $regex_pattern, 'confirmed'],
        ]);

        if ($data['type'] == '0') {
            Admin::create([
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
            ]);
        }

        if ($data['type'] == '1') {
            Manager::create([
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
            ]);
        }

        return redirect()->back()->with('successMsg', '帳號建立成功！');
    }
}
