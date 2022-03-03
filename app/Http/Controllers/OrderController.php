<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use App\Order;
use App\Http\Requests\OrderRequest;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //購入確認画面
    public function confirm($id)
    {
        $item = Item::find($id);

        return view('items.confirm', [
            'title' => '購入確認画面',
            'item' => $item,
        ]);
    }

    public function store($id, OrderRequest $request)
    {
        $item = Item::find($id);
        Order::create([
            'user_id' => \Auth::user()->id,
            'item_id' => $request->item_id,
        ]);
        return redirect()->route('items.finish', $item);
    }

    //購入完了画面
    public function finish($id)
    {
        $item = Item::find($id);

        return view('items.finish', [
            'title' => 'ご購入ありがとうございました。',
            'item' => $item,
        ]);
    }
}
