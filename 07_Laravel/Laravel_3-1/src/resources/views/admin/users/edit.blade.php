@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8 max-w-4xl">
  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto bg-white rounded-lg shadow">
    <div class="mt-3 mb-8 text-center text-xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-2xl">{{ $user->username }}の情報を編集</div>

      <form action="{{ route('admin.users.update', $user) }}" method="POST" class="max-w-xl mx-auto">
        @csrf
        @method('PUT')
        <div class="space-y-3 bg-white">
          <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
              <h2 class="max-w-sm mx-auto md:w-1/4">
                ユーザー名
              </h2>
              <div class="max-w-sm mx-auto md:w-3/4">
                  <div class=" relative ">
                      <input type="text" name="username" class="rounded border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 text-base focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" value="{{ $user->username }}" @error('username') border-red-500 @enderror">
                      @error('username')
                        <div class="text-red-500 mt-2 text-sm">
                          {{ $message }}
                        </div>
                      @enderror
                  </div>
              </div>
          </div>
        <div class="space-y-3 bg-white">
          <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
              <h2 class="max-w-sm mx-auto md:w-1/4">
                メールアドレス
              </h2>
              <div class="max-w-sm mx-auto md:w-3/4">
                  <div class=" relative ">
                      <input type="text" name="email" class="rounded border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 text-base focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" value="{{ $user->email}}" @error('email') border-red-500 @enderror">
                      @error('email')
                        <div class="text-red-500 mt-2 text-sm @error('username') border-red-500 @enderror">
                          {{ $message }}
                        </div>
                      @enderror
                  </div>
              </div>
          </div>
          <div class="space-y-3 bg-white">
            <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/4">
                  権限ステータス
                </h2>
                <div class="max-w-sm mx-auto md:w-3/4">
                    <div class=" relative ">
                        <select name="roles[]" class="rounded border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 text-base focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" >
                          @foreach ($roles as $role)
                          <option  @if($user->roles->pluck('name')->contains($role->name)) selected="selected" @endif value="{{ $role->id }}">{{ $role->name }}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
            </div>
          </div>
            <div class="space-y-3 bg-white">
              <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                  <h2 class="max-w-sm mx-auto md:w-1/4">
                    承認ステータス
                  </h2>
                  <div class="max-w-sm mx-auto md:w-3/4">
                      <div class=" relative ">
                          <select name="status" class="rounded border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 text-base focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            @foreach ($status as $value)
                            <option  @if($user->status->pluck('name')->contains($value->name)) selected="selected" @endif value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                          </select>
                      </div>
                  </div>
              </div>
          </div> 
        <button type="submit"  class="bg-blue-500 text-white rounded px-8 py-2 font-medium block m-auto">編集</button>
      </form>

    </div>
  </div>
@endsection