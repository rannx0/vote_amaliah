<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- <link href="/css/output.css" rel="stylesheet" /> --}}
    @vite('resources/css/output.css')
    <!-- typography -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <!-- icon title browser -->
    <link rel="icon" href="{{asset('asset/image/logo title.png')}}" type="image/icon" />
    <title>Smk Amaliah 1&2 Ciawi</title>
    <!-- css runing text -->
    <style>
        .typing-container {
            font-family: "Montserrat", sans-serif;
            white-space: nowrap;
            overflow: hidden;
            border-right: 2px solid;
            animation: blink-caret 0.75s step-end infinite;
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent;
            }

            50% {
                border-color: #3a3a3a;
            }
        }
    </style>
</head>

<body class="bg-putih-200">
    <!-- home interface -->
    <div class="flex flex-col items-center justify-center h-screen p-8">
        <!-- logo smk amaliah -->
        <img class="mb-6 w-[128px] h-[116px]" src="{{ asset('asset/image/logo smk.png')}}" alt="logo smk amaliah" />
        <!-- runing text -->
        <h1 id="typing-text"
            class="text-hitam text-[29px] md:text-2xl font-montserrat font-semibold text-center mb-4 typing-container">
        </h1>
        <!-- button "mulai vote" -->
        <a href="/login"
            class="w-[142px] h-[42px] flex items-center justify-center transition duration-200 ease-in-out text-white font-semibold font-montserrat bg-ijo-200 hover:bg-ijo-400 active:bg-ijo-400 focus:outline-none focus:ring focus:ring-ijomuda rounded-full">Mulai
            Vote
        </a>
    </div>
    <!-- home interface end -->
</body>
<!-- js native -->
{{-- <script src="resources\js\home.js"></script> --}}
@vite('resources/js/home.js')

</html>
