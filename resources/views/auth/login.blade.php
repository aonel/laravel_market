@extends('layouts.not_logged_in')

@section('content')
  <main>
    <div class="not_login">
      <h1 class="logo">ログインする</h1>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
          <label>
            メールアドレス:
            <input type="email" name="email">
          </label>
        </div>
        <div>
          <label>
            パスワード:
            <input type="password" name="password" >
          </label>
        </div>
        <div class="text-right">
          <input type="submit" value="ログイン" class="btn btn-secondary">
        </div>
      </form>
    </div>
  </main>
@endsection