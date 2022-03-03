@extends('layouts.logged_in')

@section('title', $title)

@section('content')
  <main>
    <h1 class="logo text-center">{{ \Auth::user()->name}}の出品商品一覧</h1>
    <a href="{{route('items.create')}}" class="btn btn-primary" style="color:white;">新規出品</a>
    <ul class="items">
        <li class="item">
        @forelse($items as $item)
          <div class="item_content">
            <div class="item_body">
              <div class="item_body_main_img">
                <div style="width:100%;height:150px;background-color:pink;background-repeat:no-repeat;background-size:100% 100%;background-position:50%;
                  @if($item->image !== '')
                    background-image:url({{ asset('storage/' . $item->image) }})
                  @else
                    background-image:url({{ asset('images/no_image.png') }})
                  @endif
                ">
                  <a href="{{route('items.show',$item)}}" style='display:block;height:150px'>
                    @if(count($item->orders) > 0)
                        <p style='margin:0;background-color:red;color:white;opacity:0.9; text-align: center'>売り切れ</p>
                    @else
                        <p style='margin:0;background-color:royalblue;color:white;opacity:0.7; text-align: center'>販売中</p>
                    @endif
                  </a>
              </div>
            </div>
              <div class="item_body_main">
                <dl>
                  <dt>商品名</dt>
                    <dd>{{$item->name}}</dd>
                  <dt>価格</dt>
                    <dd>{{$item->price}}円</dd>
                  <dt>この商品について</dt>
                    <dd>{{$item->description}}</dd>
                  <dt>カテゴリ</dt>
                    <dd>{{$item->category->name}}({{$item->created_at}})</dd>
                </dl>
              </div>
              <form method="post" class="delete" action="{{ route('items.destroy', $item) }}">
                @csrf
                @method('delete')
                <div>
                  [<a href="{{ route('items.edit', $item) }}">編集</a>]
                  [<a href="{{ route('items.edit_image', $item) }}">画像を変更</a>]
                  <input type="submit" value="削除" class="btn btn-secondary"style="margin-left:20px;">
                </div>
              </form>
            </div>
          </div>
        @empty
          <p class="no_post">出品している商品はありません。</p>
        @endforelse
      </li>
    </ul>
  </main>
@endsection

