@extends('layouts.logged_in')

@section('title',$title)

@section('content')
  <main>
    <div class="content_item">
      <h1 class="logo">{{ $title }}</h1>
      <form method="POST" action="{{ route('profiles.update',$user) }}">
        @csrf
        @method('patch')
        <div class="item_object">
          <label>
            名前:
            <input type="text" name="name" value="{{ $user->name }}">
            </label>
        </div>
        <div class="item_object">
          <label>
            ひとこと:<br>
            <textarea name="profile" rows="10" cols="40">{{ $user->profile}}</textarea>
          </label>
        </div>
        <div class="text-center">
          <a href="{{ route('profiles.index')}}" class="btn btn-secondary">戻る</a>
          <input type="submit" value="更新" class="btn btn-secondary">
        </div>
      </form>
    </div>
  </main>
@endsection