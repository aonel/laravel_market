<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;

use App\User;
use App\Item;
use App\Order;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $item = \Auth::user();
        $purchase_item = \Auth::user()->orderItems;

        return view('users.index', [
            'title' => 'プロフィール',
            'item' => $item,
            'purchase_item' => $purchase_item,
        ]);
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('profiles.edit', [
            'title' => 'プロフィール編集',
            'user' => $user,
        ]);
    }

    public function update($id, UserRequest $request)
    {
        $user = User::find($id);
        $user->update($request->only(['name', 'profile']));

        session()->flash('success', 'プロフィールを更新しました。');
        return redirect()->route('profiles.index');
    }

    public function editImage($id)
    {
        $user = User::find($id);
        return view('profiles.edit_image', [
            'title' => 'プロフィール画像編集',
            'user' => $user,
        ]);
    }

    public function updateImage($id, UserImageRequest $request)
    {
        $path = '';
        $image = $request->file('image');

        if (isset($image) === true) {
            $path = $image->store('photos', 'public');
        }

        $user = User::find($id);

        if ($user->image !== '') {
            \Storage::disk('public')->delete(\Storage::url($user->image));
        }

        $user->update([
            'image' => $path,
        ]);

        session()->flash('success', '画像を変更しました');
        return redirect()->route('profiles.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->image !== '') {
            \Storage::disk('public')->delete(\Storage::url($user->image));
        }
        $user->delete();
        session()->flash('success', '投稿を削除しました');
        return redirect()->route('profiles.index');
    }
}
