<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">
  <nav class="p-6 bg-white flex justify-between mb-6 flex-wrap">
      <ul class="sm:flex sm:items-center">
          <li>
              <a href="/" class="p-3">ホーム</a>
          </li>
          <li>
            <a href="{{ route('dashboard') }}" class="p-3">ダッシュボード</a>
        </li>
          @can('user-list')
            <li>
                <a href="{{ route('admin.users.index') }}" class="p-3">ユーザー一覧</a>
            </li>
          @endcan
      </ul>
      <ul class="sm:flex sm:items-center">
        @auth
            <li>
                <a href="" class="p-3">{{ auth()->user()->username }}</a>
            </li>
            <li>
                <form action="{{route('logout')}}" method="post" class="p-3 inline">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
            </li>
        @endauth

        @guest
            <li>
                <a href="{{ route('login') }}" class="p-3">ログイン</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="p-3">ユーザー登録</a>
            </li>
        @endguest
    </ul>
  </nav>
  @include('partials.flash-message')
  @yield('content')
</body>
</html>