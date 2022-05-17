    @if (session()->has('message'))
        <div x-data="{show: true}" x-init="setTimeout(() => show=false, 3000)" x-show="show" class="fixed top-10 left-1/2 -translate-x-1/2 bg-blue-500 text-white px-5 py-3 rounded m-auto">
          <p>{{session('message')}}</p>
        </div>
    @endif
    @if (session()->has('alert'))
        <div x-data="{show: true}" x-init="setTimeout(() => show=false, 3000)" x-show="show" class="fixed top-10 left-1/2 -translate-x-1/2 bg-red-200 text-red-500 px-5 py-3 rounded m-auto">
          <p>{{session('alert')}}</p>
        </div>
    @endif