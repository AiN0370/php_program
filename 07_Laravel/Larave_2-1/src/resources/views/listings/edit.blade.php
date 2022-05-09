@extends('layout')

@section('content')

<div class="card p-5 mt-5 w-50 mx-auto">
    <form method="POST" action="/listings/{{$listing->id}}">
      @csrf
      @method('PUT')
        <h1 class="h3 mb-3 fw-normal text-center">メモを編集する</h1>

        <!-- Title input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form4Example2">タイトル</label>
            <input type="text" id="form4Example2" class="form-control" name="title" value="{{$listing->title}}"/>
            @error('title')
            <p class="text-danger small fs-6 mt-1">{{$message}}</p>
            @enderror
        </div>

        <!-- Message input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form4Example3">テキスト</label>
            <textarea class="form-control" id="form4Example3" rows="4" name="description">{{$listing->description}}</textarea>
            @error('description')
            <p class="text-danger small fs-6 mt-1">{{$message}}</p>
            @enderror
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">メモを編集する</button>
    </form>
</div>
    
@endsection