@if(session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)"
        x-show="show" class="fixed top-2 left-1/2 transform -translate-x-1/2 
        bg-neutral-700 text-white px-5 py-3 rounded-md border border-laravel">
        <p>
            {{session('message')}}
        </p>
    </div>
@endif