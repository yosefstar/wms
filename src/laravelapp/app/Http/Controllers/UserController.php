<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // 新規ユーザー作成画面
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|max:45',
            'password' => 'required|max:255',
            'user_type' => 'required|integer',
            'user_nickname' => 'required|max:50',
            'user_icon' => 'max:255',
            'stop_flag' => 'integer|nullable',
            'postal_code' => 'max:8',
            'prefecture_id' => 'integer|nullable',
            'city' => 'max:100',
            'street_address' => 'max:255',
            'building_and_room' => 'max:255',
            'user_phone_number' => 'max:15',
            'email' => 'required|email|max:100|unique:users,email',
            'bank_name' => 'max:100',
            'branch_name' => 'max:100',
            'bank_account_type' => 'max:20',
            'bank_account_number' => 'max:20',
            'bank_account_holder_name' => 'max:100',
        ]);

        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'ユーザーが正常に作成されました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
