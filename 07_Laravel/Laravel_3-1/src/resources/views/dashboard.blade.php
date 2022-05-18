@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 sm:px-8 max-w-4xl">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto bg-white rounded-lg shadow">
      <div class="mt-3 mb-8 text-center text-xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-2xl">ようこそ、{{ $user->username  }}</div>
        
        <form action="{{ route('users.update', $user) }}" method="POST" class="max-w-xl mx-auto">
          @csrf
          @method('PUT')
          <div class="space-y-3 bg-white">
            <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                <h2 class="max-w-sm mx-auto md:w-1/4">
                  ユーザー名
                </h2>
                <div class="max-w-sm mx-auto md:w-3/4">
                    <div class=" relative ">
                        <input type="text" name="username" class="rounded border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 text-base focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" value="{{ $user->username}}" @error('username') border-red-500 @enderror">
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
                        <input type="text" name="email" class="rounded border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 text-base focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" value="{{ auth()->user()->email}}" @error('email') border-red-500 @enderror">
                        @error('email')
                          <div class="text-red-500 mt-2 text-sm @error('username') border-red-500 @enderror">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
                </div>
            </div>
              <div class="space-y-3">
                <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                    <h2 class="max-w-sm mx-auto md:w-1/4">
                      承認ステータス
                    </h2>
                    <div class="max-w-sm mx-auto md:w-3/4">
                      <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                        @if(!empty($user->status()->pluck('name')->toArray()))
                          <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full">
                          </span>
                          <span class="relative">
                              {{ implode(',', $user->status()->get()->pluck('name')->toArray()) }}
                          </span>
                        @endif
                      </span>
                    </div>
                  </div>
                </div>
            </div> 
              <div class="space-y-3">
                <div class="items-center w-full p-4 space-y-4 text-gray-500 md:inline-flex md:space-y-0">
                  <h2 class="max-w-sm mx-auto md:w-1/4">
                    アクション
                  </h2>
                  <div class="max-w-sm mx-auto md:w-3/4">
                    @if(empty($user->status->pluck('name')->toArray()) || $user->status->pluck('name')->contains('破棄'))
                      <input type="checkbox" id="submit" name="status[]" value="3">
                      <label for="submit">承認申請をする</label>
                    @else
                      <input type="checkbox" id="delete" name="status[]" value="4">
                      <label for="delete">申請を破棄する</label>
                    @endif
                  </div>
                </div>
              </div>
              <div class="flex text-gray-500">
                <p class="max-w-sm md:w-1/4 mx-auto p-3">権限ステータス</p>
                <p class="max-w-sm md:w-3/4 mx-auto py-3">{{ implode(',', $user->roles()->get()->pluck('name')->toArray()) }}</p>
              </div>
          </div> 
          <div class="pt-10 pb-5 text-right">
            <button type="submit"  class="bg-blue-500 text-white rounded px-8 py-2 font-medium inline-block">編集</button>
          </div>
        </form>
        <form method="POST" action="{{ route('users.destroy', $user) }}" class="max-w-xl mx-auto text-right py-3 mb-5">
        @csrf
        @method('DELETE')
          <button type="submit"  class="text-red-500 font-medium">ユーザーを削除</button>
        </form> 
      </div>
    </div>
@endsection