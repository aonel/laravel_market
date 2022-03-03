@extends('layouts.logged_in')

@section('title', $title)

@section('content')
  <main>
    <h1 class="logo text-center">{{ $title }}</h1>
    <div class="content_item">
      <form method="POST" action="{{ route('items.update', $item) }}">
        @csrf
        @method('patch')
        <div class="item_object">
          <label>
            商品名:
            <input type="text" name="name" value="{{$item->name}}">
          </label>
        </div>
        <div class="item_object">
          <label>
            商品説明:<br>
              <textarea name="description" rows="10" cols="40">{{$item->description}}</textarea>
          </label>
        </div>
        <div class="item_object">
          <label>
            価格:<br>
            <input type="number" name="price" value="{{$item->price}}">
          </label>
        </div>
        <div class="item_object">
          <label>
            カテゴリー:<br>
            <select name='category_id'>
              @foreach($categories as $category)
                <option value="{{$category->id}}"
                  @if($category->id === $item->category_id)
                    selected
                  @endif
                    >{{$category->name}}
                </option>
              @endforeach
            </select>
          </label>
        </div>
        <input type="submit" value="出品" class="btn btn-secondary">
      </form>
    </div>
  </main>
@endsection