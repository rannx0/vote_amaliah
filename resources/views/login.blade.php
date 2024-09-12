<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="css/output.css" rel="stylesheet"> --}}
    @vite('resources/css/output.css')
    <!-- typography -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!-- icon title browser -->
    <link rel="icon" href="{{ asset('asset/image/logo title.png') }}" type="image/icon" />
    <title>Smk Amaliah 1&2 Ciawi</title>
    <!-- css runing text -->
    <style>
        .typing-container {
            font-family: 'Montserrat', sans-serif;
            white-space: nowrap;
            overflow: hidden;
            border-right: 2px solid;
            animation: blink-caret 0.75s step-end infinite;
        }

        .background {
            background-image: url(asset/image/Gambar\ 1.jpg);
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent;
            }

            50% {
                border-color: #3A3A3A;
            }
        }
    </style>
</head>

<body class="bg-putih-200">
    <div class="flex flex-col items-center justify-center h-screen p-8">
        <!-- logo smk amaliah -->
        <img class="mb-6" src="{{ asset('asset/image/maskotamaliah.png') }}" alt="logo smk amaliah">
        <!-- runing text -->
        <h1 id="typing-text"
            class="text-hitam text-[29px] md:text-2xl font-montserrat font-semibold text-center mb-4 typing-container">
        </h1>
    </div>

    <div class="bg-cover bg-center bg-fixed background">
        <div class="h-screen flex justify-center items-center">
            <div class="bg-white mx-4 p-8 rounded-2xl shadow-md w-full md:w-1/2 lg:w-1/3">
                <!-- fromt login -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- from nama -->
                    <div class="mb-4">
                        <input
                            class="border rounded-full w-full py-3 px-3 text-gray-700 leading-tight  focus:outline-none focus:border-hitam-200 focus:ring-1 focus:ring-hitam-200
              disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none"
                            id="username" type="text" name="username" value="{{ old('username') }}" required
                            autofocus placeholder="Masukan NISN" />
                        @error('username')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- from nis -->
                    <div class="mb-4">
                        <input
                            class="border rounded-full w-full py-3 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:border-hitam-200 focus:ring-1 focus:ring-hitam-200
              disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none"
                            id="password" type="password" name="password" required
                            placeholder="Passwordmu Adalah NIS!" />
                        @error('password')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- button login -->
                    <div class="mb-6">
                            <button
                                class="bg-ijo-200 w-full hover:bg-ijo-400 transition duration-200 ease-in-out active:bg-ijo-400 focus:outline-none focus:ring focus:ring-ijomuda text-white font-semibold font-montserrat py-3 px-4 rounded-full"
                                type="submit">
                                Login
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- js native -->
{{-- <script src="js/login.js"></script> --}}
@vite('resources/js/login.js')

</html>
