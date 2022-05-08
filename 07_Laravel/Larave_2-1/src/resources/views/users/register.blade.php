@extends('layout')

@section('content')
<div class="card p-5 mt-5 w-50 mx-auto">
  <form method="POST" action="/">
    @csrf
      <h1 class="h3 mb-3 fw-normal text-center">ユーザー登録する</h1>
      <label for="inputEmail" class="visually-hidden mt-3">ユーザー名</label>
      <input type="text" id="inputUsername" class="form-control" placeholder="ユーザー名" autofocus name="name" value="{{old('name')}}">
      @error('name')
        <p class="text-danger small fs-6 mt-1">{{$message}}</p>
      @enderror

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
      <button class="w-100 btn btn-lg btn-primary mt-5" type="submit">新規登録</button>
  </form>
</div>
@endsection