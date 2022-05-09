@extends('layout')

@section('content')

    @unless (count($listings) == 0)

    @foreach ($listings as $listing)
    <x-listing-card :listing="$listing" :users="$users"/>
    @endforeach

    @else
        <p>投稿が見つかりません</p>
    @endunless

    <div class="mt-6 p-4">
        {{$listings->links()}}
    </div>
@endsection