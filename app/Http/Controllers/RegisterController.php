<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Register from city
     * 
     * @param Illuminate\Http\Request $request
     */
    public function __invoke(Request $request)
    {
        $data = $request->input();
        $user = DB::connection('mysql_city')->table('members')->where('email', $data['email'])->get()[0];
        if(md5(md5($data['password']).$user->salt) === $user->password) {
            $res = User::create([
                'nick_name' => $user->username,
                'email' => $data['email'],
                'avatar' => '/storage/null.png',
                'password' => Hash::make($data['password']),
            ]);
            return '<h2>注册成功！<h2><p>5秒后跳转</p><script>setTimeout(window.location.href = "/login", 5000)</script>';
        }else {
            return redirect('/register');
        }
    }
}
