<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe to a Newsletter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl text-center text-gray-700 mb-4">Subscribe to our Newsletter</h2>

        @include('components.alerts')

        <form action="/subscribe" method="POST">
            @csrf

            <div class="w-full max-w-sm min-w-[200px]">
                <div class="relative">
                    <select name="email_list_id" required
                        class="w-full p-3 mb-4 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                        @foreach ($emailList as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input type="email" name="email"
                class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300"
                placeholder="Enter your email" required>
            <button type="submit" class="w-full mt-4 bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                Subscribe
            </button>
        </form>
    </div>
</body>

</html>
