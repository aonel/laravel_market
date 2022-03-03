@extends('layouts.default')

@section('header')
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

      <a class="navbar-brand nav_logo" href="{{route('top')}}">Market</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse nav_content" id="mainNav">
        <span class="nav-link">
          こんにちは、{{\Auth::user()->name}}さん！
        </span>
        <a href="{{route('profiles.index')}}" class="nav-link">
          プロフィール
        </a>
        <a href="{{route('likes.index')}}" class="nav-link">
          お気に入り一覧
        </a>
        <a href="{{ route('users.exhibitions')}}" class="nav-link">
          出品商品一覧
        </a>
        
        <span class="ml-auto">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" value="ログアウト"  class="btn btn-secondary nav-link">
          </form>
        </span>
      </div>
    </nav>
  </header>
@endsection