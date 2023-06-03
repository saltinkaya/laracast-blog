@if(session()->has("success"))
    <div x-data="{show: true}"
         x-init="setTimeout(() => show = false, 3000)"
         x-show="show"
         class="fixed bottom-3 right-3 bg-blue-500 text-white py-2 px-4">
        <p> {{ session("success") }}</p>
    </div>
@endif
