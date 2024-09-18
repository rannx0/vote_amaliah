<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="css/output.css" rel="stylesheet"> --}}
    @vite('resources/css/output.css')
    <title>Anda Sudah Memberikan Suara</title>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-red-500">Peringatan</h1>
        <p class="mt-4 text-lg font-medium text-gray-700">Anda sudah memberikan suara sebelumnya.</p>
        <p class="mt-2 text-gray-500">Terimakasih atas partisipasi Anda.</p>

        <a href="{{ route('home') }}" class="mt-6 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Kembali ke Halaman Utama
        </a>
    </div>
</body>

</html>
