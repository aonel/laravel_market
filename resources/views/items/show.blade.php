@extends('layouts.logged_in')

@section('title', $title)

@section('content')
  <main>
    <h1 class="logo text-center">{{$title}}</h1>
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
      @if(count($item->orders) > 0)
      <dt style="color: red">売り切れ</dt>
      @else
        <button class="btn btn-secondary">
          <a href="{{route('items.confirm',$item)}}" style="color:white;">購入する</a>
        </button>
      @endif
    </dl>
  </main>


@endsection