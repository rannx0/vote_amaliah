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
    <style>
        /* Tambahan animasi bounce dan fade in */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease, transform 1s ease;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="bg-putih-200 flex flex-col justify-center items-center min-h-screen">
    <!-- Circle Animation -->
    <div id="circleAnimation" class="w-[128px] h-[128px] bg-ijo-200 rounded-full mb-6 animate-bounce"></div>

    <!-- Tulisan Terimakasih -->
    <p id="thankYouText" class="text-4xl text-hitam-200 font-montserrat font-bold fade-in">Terimakasih<span
            class="text-ijo-400">.</span></p>
    <!-- Teks tambahan -->
    <p id="additionalText" class="font-poppins text-sm font-medium text-abu-200 fade-in">by: Team Developer</p>

    <script>
        // Fungsi untuk menampilkan teks dengan transisi
        function showThankYouText() {
            const thankYouText = document.getElementById('thankYouText');
            const additionalText = document.getElementById('additionalText');
            const circleAnimation = document.getElementById('circleAnimation');

            // Menghilangkan animasi circle
            circleAnimation.classList.add('hidden');

            // Memunculkan teks dengan transisi
            thankYouText.classList.add('show');
            additionalText.classList.add('show');
        }

        // Memberikan delay 2 detik sebelum menampilkan teks
        setTimeout(showThankYouText, 2000);
    </script>
</body>

</html>
