@extends('layout')

@section('content')
<div class="card p-5 mt-5 w-50 mx-auto">
  <form method="POST" action="{{route('listing.store')}}">
      @csrf
      <h1 class="h3 mb-3 fw-normal text-center">メモを登録する</h1>

      <!-- Title input -->
      <div class="form-outline mb-4">
          <label class="form-label" for="form4Example2">タイトル</label>
          <input type="text" id="form4Example2" class="form-control" name="title" value="{{old('title')}}"/>

          @error('title')
              <p class="text-danger small fs-6 mt-1">{{$message}}</p>
          @enderror
      </div>

      <!-- Message input -->
      <div class="form-outline mb-4">
          <label class="form-label" for="form4Example3">テキスト</label>
            <textarea class="form-control" id="form4Example3" rows="4" name="description">{{old('description')}}</textarea>
          @error('description')
              <p class="text-danger small fs-6 mt-1">{{$message}}</p>
          @enderror
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mb-4">メモを登録する</button>
  </form>
</div>

@endsection