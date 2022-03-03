@extends('layouts.logged_in')

@section('title', $title)

@section('content')
  <main>
    <h1 class="logo text-center">{{ $title }}</h1>
      <div class="user_body">
        <div class="user_body_flex">
          <div class=user_body_text>
            <dl>
              <dt class="mb-2">名前</dt>
              <dd>{{ $item->name }}</dd>
              <dt class="mb-2">ひとこと</dt>
              @if($item->profile !== '')
              <dd>{{ $item->profile}}</dd>
              @else
              <dd>未記入。</dd>
              @endif
              <dt class="mb-2">出品数</dt>
              <dd>{{$item->items->count()}}</dd>
            </dl>
          </div>
          <div class="user_body_img">
            @if($item->image !== '')
              <img src="{{ \Storage::url($item->image) }}">
            @else
              <img src="{{ asset('images/no_image.png') }}">
            @endif
          </div>
        </div>
        <div class="user_body_link">
          [<a href="{{ route('profiles.edit', $item) }}">プロフィール編集</a>]
          [<a href="{{ route('profiles.edit_image', $item) }}">画像を変更</a>]
        </div>
        
        <h3>購入履歴</h3>
        <div class="item_body_history">
          <ul>
            @forelse($purchase_item as $item)
              <li>{{$item->name}}:{{$item->price}}円 出品者{{$item->user->name}}</li>
            @empty
              <li>未購入</li>
            @endforelse
          </ul>
        </div>
      </div>
  </main>
  @endsection