@extends('layouts.default')

@section('header')
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="collapse navbar-collapse nav_content" id="mainNav">
      <a href="{{ route('register') }}" class="btn btn-warning nav-link" style="margin-right: 10px;">
        ユーザー登録
      </a>
      <a href="{{ route('login') }}" class="btn btn-warning nav-link">
        ログイン
      </a>
    </div>
</header>
@endsection