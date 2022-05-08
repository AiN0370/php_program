@if (session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show" class="alert alert-success position-fixed" style="top: 50px;left: 50%;transform: translateX(-50%);">
      <p class="m-0">{{session('message')}}</p>
    </div>
@endif