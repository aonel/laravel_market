@extends('layouts.logged_in')

@section('title',$title)

@section('content')
  <main>
    <h1 class="logo text-center">{{ $title }}</h1>
    <div class="content_item">
      <h2>現在の画像</h2>
      <div class="item_body_main_img_edit">
        @if($user->image !== '')
          <img src="{{ \Storage::url($user->image) }}">
        @else
          画像はありません。
        @endif
      </div>
      <form
        method="POST"
        action="{{ route('profiles.update_image', $user) }}"
        enctype="multipart/form-data"
      >
          @csrf
          @method('patch')
          <div>
            <label>
              画像を選択:
              <input type="file" name="image">
            </label>
          </div>
          <input type="submit" value="更新" class="btn btn-secondary">
      </form>
    </div>
  </main>

@endsection