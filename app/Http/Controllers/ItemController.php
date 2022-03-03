<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use App\Like;
use App\Order;
use App\Category;

use App\Http\Requests\ItemRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\ItemImageRequest;

use App\Services\FileUploadService;

use Illuminate\Http\Request;

class ItemController extends Controller
{


    //ログイン時でないと開けない設定
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function top()
    {

        return view('items.tops', [
            'title' => '息をするように、買おう。',
            'listing_users' => Item::all()->where('user_id', '<>', \Auth::user()->id)->sortByDesc('created_at')
        ]);
    }

    public function exhibitions()
    {
        $items = \Auth::user()->items()->latest()->get();

        return view('items.exhibitions', [
            'title' => '出品商品一覧',
            'items' => $items,

        ]);
    }
    //商品出品
    public function itemCreate()
    {
        return view('items.create', [
            'title' => '商品を出品',
            'categories' => Category::all()
        ]);
    }

    public function store(ItemRequest $request, FileUploadService $service)
    {
        //画像投稿処理
        $path = $service->saveImage($request->file('image'));

        Item::create([
            'user_id' => \Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $path,
        ]);
        session()->flash('success', '商品を出品しました');
        return redirect()->route('users.exhibitions');
    }

    // 画像変更処理
    public function editImage($id)
    {
        $item = Item::find($id);
        return view('items.edit_image', [
            'title' => '画像変更画面',
            'item' => $item,
        ]);
    }

    // 画像変更処理
    public function updateImage($id, ItemImageRequest $request, FileUploadService $service)
    {
        //画像投稿処理
        $path = $service->saveImage($request->file('image'));

        $item = Item::find($id);

        // 変更前の画像の削除
        if ($item->image !== '') {
            // publicディスクから、該当の投稿画像($post->image)を削除
            \Storage::disk('public')->delete(\Storage::url($item->image));
        }

        $item->update([
            'image' => $path, // ファイル名を保存
        ]);

        session()->flash('success', '画像を変更しました');
        return redirect()->route('users.exhibitions');
    }


    //商品編集
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        return view('items.edit', [
            'title' => '商品情報の編集',
            'item' => $item,
            'categories' => $categories
        ]);
    }

    public function update($id, EditRequest $request)
    {
        $item = Item::find($id);
        $item->update($request->only(['name', 'description', 'price', 'category_id',]));
        session()->flash('success', '出品情報を編集しました');
        return redirect()->route('users.exhibitions');
    }

    //出品削除処理
    public function destroy($id)
    {
        $item = Item::find($id);
        // 画像の削除
        if ($item->image !== '') {
            \Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        \Session::flash('success', '商品を削除しました');
        return redirect()->route('users.exhibitions');
    }

    //お気に入り
    public function toggleLike($id)
    {
        $user = \Auth::user();
        $item = Item::find($id);

        if ($item->isLikedBy($user)) {
            // いいねの取り消し
            $item->likes->where('user_id', $user->id)->first()->delete();
            \Session::flash('success', 'いいねを取り消しました');
        } else {
            // いいねを設定
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            \Session::flash('success', 'いいねしました');
        }
        return redirect()->route('top');
    }
    //商品詳細
    public function show($id)
    {
        $item = Item::find($id);

        return view('items.show', [
            'title' => '商品詳細',
            'item' => $item,
        ]);
    }
}
