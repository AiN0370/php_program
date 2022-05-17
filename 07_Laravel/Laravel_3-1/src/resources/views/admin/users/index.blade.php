@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 sm:px-8 max-w-4xl">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto bg-white rounded-lg shadow">
      <div class="mt-2 text-center text-xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-2xl">ユーザー一覧</div>
      <table class="mt-8 mb-5 min-w-full leading-normal">
            <thead>
              <tr>
                  <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                    #
                  </th>
                  <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                    ユーザー名
                  </th>
                  <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                    権限ステータス
                  </th>
                  <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                    申請ステータス
                  </th>
                  <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                    アクション
                  </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    {{ $user->id }}
                  </td> 
                  <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                      {{ $user->username }}
                    </p>
                  </td> 
                  <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 whitespace-no-wrap">
                      {{ implode(',', $user->roles()->pluck('name')->toArray()) }}
                    </p>
                  </td> 
                  <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                      @if(!empty($user->status()->pluck('name')->toArray()))
                      <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full">
                      </span>
                      <span class="relative">
                        {{ implode(',', $user->status()->pluck('name')->toArray()) }}
                      </span>
                      @endif
                    </span>
                  </td>
                  <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                      <a href="{{ route('admin.users.edit', $user->id) }}" class="text-sky-600 hover:text-sky-700 mr-4">
                        編集
                      </a>
                      <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline"> 
                        @csrf
                        @method('DELETE')
                         <button type="submit" class="text-red-600 hover:text-red-900">削除</button> 
                      </form> 
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
  </div>
@endsection