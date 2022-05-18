@extends('layouts.app')

@section('content')
  <div class="flex justify-center">
    <div class="lg:w-4/12 p-6 bg-white rounded-lg">
      <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label for="username" class="sr-only">ユーザー名</label>
          <input type="text" name="username" placeholder="ユーザー名" id="username" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('username') border-red-500 @enderror" value="{{ old('username') }}"">
        
          @error('username')
            <div class="text-red-500 mt-2 text-sm">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="email" class="sr-only">メールアドレス</label>
          <input type="text" name="email" placeholder="メールアドレス" id="email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
        
          @error('email')
            <div class="text-red-500 mt-2 text-sm @error('username') border-red-500 @enderror">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="password" class="sr-only">パスワード</label>
          <input type="password" name="password" placeholder="パスワード" id="password" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror">
        
          @error('password')
            <div class="text-red-500 mt-2 text-sm">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-4">
          <label for="role" class="text-sm">権限ステータス</label>
          <select name="role" id="role" class="bg-gray-100 border-2 w-full p-4 rounded-lg mt-1">
            @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white rounded px-4 py-3 font-medium w-full">登録</button>
        </div>
      </form>
    </div>
  </div>
@endsection