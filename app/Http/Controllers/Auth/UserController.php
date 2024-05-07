<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {

        $user = Auth::user() ?? '';
        if (Auth::check()) {
            return view('account.index', ['title' => 'Личный кабинет', 'cutString' => [$this, 'cutString'], 'menu' => $this->getMenu(), 'user' => $user]);
        }
        return redirect()->route('login');
    }
    public function store(Request $request, $userId)
    {
        $user = User::find($userId);
        $user->api_token = Str::random(80);
        $user->save();
        return redirect()->route('user.account');
    }

    public function destroy(Request $request, $userId)
    {
        $user = User::find($userId);
        $user->api_token = 0;
        $user->save();
        return redirect()->route('user.account');
    }
}