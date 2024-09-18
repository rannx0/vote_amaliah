<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    @vite('resources/css/app.css') <!-- Untuk menggunakan Tailwind -->
    <link rel="icon" href="{{ asset('asset/image/logo title.png') }}" type="image/icon" />
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-8">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Admin Login</h2>

        <!-- Display Error Messages -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-600 p-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">name</label>
                <input type="name" id="name" name="name"
                    class="w-full p-3 border rounded focus:outline-none focus:ring focus:ring-indigo-200"
                    placeholder="Username" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full p-3 border rounded focus:outline-none focus:ring focus:ring-indigo-200"
                    placeholder="********" required>
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2 leading-tight">
                    <span class="text-sm text-gray-700">Remember me</span>
                </label>
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-900">Forgot password?</a>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition duration-200 ease-in-out focus:outline-none focus:ring-4 focus:ring-indigo-300">
                Login
            </button>
        </form>
    </div>
</body>

</html>
