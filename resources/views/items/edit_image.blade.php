@extends('layouts.logged_in')

@section('content')
  <main>
    <h1 class="logo text-center">{{ $title }}</h1>
    <div class="content_item">
      <h2>現在の画像</h2>
      <div class="item_body_main_img_edit">
        @if($item->image !== '')
          <img src="{{ \Storage::url($item->image) }}">
        @else
          画像はありません。
        @endif
      </div>
      <form
        method="POST"
        action="{{ route('items.update_image', $item) }}"
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