@if (session('error'))
    <div class="bg-red-100 mt-4 mb-4 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Opzz!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

@if (session('message'))
    <div class="bg-blue-100 mb-4 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Info</p>
        <p class="text-sm">{{ session('message') }}</p>
    </div>
@endif
