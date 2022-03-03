@extends('layouts.logged_in')

@section('title', $title)

@section('content')
  <main>
    <h1 class="logo text-center">{{$title}}</h1>
    <div class="content_item">
      <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="item_object">
          <label>
            商品名:<br>
            <input type="text" name="name">
          </label>
        </div>
        <div class="item_object">
          <label>
            商品説明:<br>
              <textarea name="description" rows="10" cols="40"></textarea>
          </label>
        </div>
        <div class="item_object">
          <label>
            価格:<br>
              <input type="number" name="price">
          </label>
        </div>
        <div class="item_object">
          <label>
            カテゴリー:<br>
            <select name="category_id" >
              @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
          </label>
        </div>
        <div class="item_object">
          <label>
            画像:
            <input type="file" name="image">
          </label>
        </div>
        <input type="submit" value="出品" class="btn btn-secondary">
      </form>
    </div>
  </main>
@endsection