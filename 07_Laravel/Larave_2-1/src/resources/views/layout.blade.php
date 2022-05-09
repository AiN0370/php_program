<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Laravel_07-1</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand navbar-dark blue-gradient">
    <a class="navbar-brand" href="/">Autumn</a>
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" href="{{route('listing.create')}}">投稿する</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('users.create')}}">ユーザー登録</a>
        </li>
        @auth
        <li class="nav-item">
            <form method="POST" action="/logout">
                @csrf
                <button style="background: none;border: none;" type="submit" class="nav-link">ログアウト</button>
            </form> 
        </li>
        <li class="nav-item">
            <span class="nav-link">{{auth()->user()->name}}</span>
        </li>
        @else     
        <li class="nav-item">
            <a class="nav-link" href="{{route('users.login')}}">ログイン</a>
        </li>
        @endauth

        <form id="logout-button" method="POST" action={{route('users.logout')}}">
        </form>
    </ul>
</nav>

<main class="p-5">

@yield('content')
</main>


<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>
<x-flash-message />
</body>
</html>