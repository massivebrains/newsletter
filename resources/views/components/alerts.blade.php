@if (session('error'))
    <div class="bg-red-100 mb-4 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Opzz!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif
