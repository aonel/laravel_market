<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use App\Like;
use App\Category;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $like_items = \Auth::user()->likeItem()->orderBy('likes.created_at', 'desc')->get();

        return view('likes.index', [
            'title' => 'お気に入り一覧',
            'like_items' => $like_items,
        ]);
    }
}
