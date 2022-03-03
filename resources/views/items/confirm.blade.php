@extends('layouts.logged_in')

@section('title',$title)

@section('content')
  <main>
    <h1 class="logo text-center">{{ $title }}</h1>
    
    <dl class="content_item">
      <dt>商品名</dt>
        <dd>{{$item->name}}</dd>

      <div class="body_img">
        @if($item->image !== '')
          <img src="{{ asset('storage/' . $item->image) }}">
        @else
          <img src="{{ asset('images/no_image.png') }}">
        @endif
      </div>

      <dt>カテゴリ</dt>
        <dd>{{$item->category->name}}</dd>
      <dt>価格</dt>
        <dd>{{$item->price}}円</dd>
      <dt>説明</dt>
        <dd>{{$item->description}}</dd>
      <div>
        <form method="post" action="{{ route('orders.store',$item)}}">
          @csrf
          <input type="hidden" name="item_id" value="{{ $item->id }}">
          <input type="submit" value="内容を確認し購入する" class="btn btn-warning">
        </form>
      </div>
    </dl>
  </main>
@endsection