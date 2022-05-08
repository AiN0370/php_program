@extends('layout')

@section('content')
<div class="card p-5 mt-5 w-50 mx-auto">
  <form method="POST" action="/users/authenticate">
    @csrf
      <h1 class="h3 mb-3 fw-normal text-center">ログインする</h1>

      <label for="inputEmail" class="visually-hidden mt-3">メールアドレス</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="メールアドレス" autofocus name="email" value="{{old('email')}}">
      @error('email')
        <p class="text-danger small fs-6 mt-1">{{$message}}</p>
      @enderror

      <label for="inputPassword" class="visually-hidden mt-3">パスワード</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="パスワード" name="password" value="{{old('password')}}">
      @error('password')
        <p class="text-danger small fs-6 mt-1">{{$message}}</p>
      @enderror
      <button class="w-100 btn btn-lg btn-primary mt-5" type="submit">ログイン</button>
  </form>
</div>

@endsection