<?php

// app/Http/Controllers/CustomLogoutController.php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomLogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/'); // ログアウト後のリダイレクト先を設定
    }
}
