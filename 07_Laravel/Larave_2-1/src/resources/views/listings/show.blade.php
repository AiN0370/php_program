@extends('layout')

@section('content')
{{-- シングルリスティング --}}
<div class="card p-5 mt-5 w-50 mx-auto">
    <h1 class="h3 mb-3 fw-normal text-center">メモ</h1>

    <label>タイトル</label>
    <h2 class="p-2 font-weight-bold">{{$listing->title}}</h2>

    <label class="mt-3">テキスト</label>
    <p class="p-2">{{$listing->description}}</p>
</div>
    
@endsection