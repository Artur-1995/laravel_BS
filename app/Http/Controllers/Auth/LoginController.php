<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index($message = null, ...$user)
    {
        $user = Auth::user()->name ?? false;

        if ($user) {
            return redirect()->route('user.account');
        }
        return view('login.index', ['title' => 'Авторизация', 'cutString' => [$this, 'cutString'], 'menu' => $this->getMenu(), 'message' => $message ?? null]);
    }
    public function store(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();

        if ($user) {

            if (Hash::check($password, $user->password)) {
                $message = 'Вы авторизовались';
                Auth::login($user);
                session(['user' => $user]);

                return $this->index($message, $user);
            } else {

                $message = 'Неверный пароль';
                return $this->index($message);
            }
        } else {

            $message = 'Неверный логин';
            return $this->index($message);
        }
    }
    public function logout()
    {
        Auth::logout();
        return $this->index();

    }
}
