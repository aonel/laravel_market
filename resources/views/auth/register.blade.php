@extends('layouts.not_logged_in')

@section('content')
<main>
  <div class="not_login">
    <h1 class="logo">ユーザー登録</h1>
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div>
        <label>
          ユーザー名:
          <input type="text" name="name">
        </label>
      </div>
      <div>
        <label>
          メールアドレス:
          <input type="email" name="email">
        </label>
      </div>
      <div>
        <label>
          パスワード:
          <input type="password" name="password">
        </label>
      </div>
      <div>
        <label>
          パスワード（確認用）:
          <input type="password" name="password_confirmation" >
        </label>
      </div>
      <div class="text-right">
        <input type="submit" value="登録" class="btn btn-secondary">
      </div>
    </form>
    </div>
  </main>
@endsection