<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $selectedUserType = $request->input('userType'); // 選択されたユーザータイプを取得
        $users = User::all();
        $adminUsers = User::where('user_type', 1)->get();
        $writerUsers = User::where('user_type', 2)->get();
        return view('users.index', compact('users', 'selectedUserType', 'adminUsers', 'writerUsers'));
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

        $userData = $request->all();

        if ($request->hasFile('user_icon')) {
            $file = $request->file('user_icon');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/user_icons', $filename);
            $userData['user_icon'] = 'storage/user_icons/' . $filename;
        } else {
            $userData['user_icon'] = null;
        }

        User::create($userData);

        return redirect()->route('users.index')->with('success', 'ユーザーが正常に作成されました。');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->user_name = $request->input('user_name');
        // $user->password = $request->input('password');
        // $user->user_type = $request->input('user_type');
        $user->user_nickname = $request->input('user_nickname');
        $user->stop_flag = $request->input('stop_flag');
        $user->postal_code = $request->input('postal_code');
        $user->prefecture_id = $request->input('prefecture_id');
        $user->city = $request->input('city');
        $user->street_address = $request->input('street_address');
        $user->building_and_room = $request->input('building_and_room');
        $user->user_phone_number = $request->input('user_phone_number');
        $user->email = $request->input('email');
        $user->bank_name = $request->input('bank_name');
        $user->branch_name = $request->input('branch_name');
        $user->bank_account_type = $request->input('bank_account_type');
        $user->bank_account_number = $request->input('bank_account_number');
        $user->bank_account_holder_name = $request->input('bank_account_holder_name');

        if ($request->hasFile('user_icon')) {
            $user->storeUserIcon($request->file('user_icon'));
        }

        $user->save();

        return redirect()->route('users.edit', $user->id)->with('success', 'ユーザー情報が更新されました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function stop($id)
    {
        $user = User::findOrFail($id);
        // アカウントを停止する処理を実行
        $user->update(['stop_flag' => 0]);

        return redirect()->route('users.index')->with('success', 'ユーザーアカウントが停止されました。');
    }

    public function showUserInfo()
    {
        return view('user');
    }
}
