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
    <link rel="icon" href="{{ asset('asset/image/logo title.png')}}" type="image/icon" />
    <title>Smk Amaliah 1&2 Ciawi</title>
    <style>
        /* Gaya untuk menyembunyikan elemen */
        .hidden {
            display: none;
        }

        /* Transisi teks Terimakasih */
        .transition-text {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease, transform 1s ease;
        }

        .transition-text.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Gaya untuk teks tambahan */
        .additional-text {
            font-size: 1rem;
            color: #6b7280;
            /* Warna abu-abu muda */
            margin-top: 2px;
        }
    </style>
</head>

<body class="bg-putih-200 flex flex-col justify-center items-center min-h-screen">
    <lottie-player id="lottieAnimation" class="mb-6 w-[128px] h-[116px]" src="/lottieflow-success-02-075733-easey.json"
        background="transparent" speed="0.8" autoplay>
    </lottie-player>

    <!-- Tulisan Terimakasih -->
    <p id="thankYouText" class="text-4xl text-hitam-200 font-montserrat font-bold transition-text">Terimakasih<span
            class="text-ijo-400">.</span></p>
    <!-- Teks tambahan -->
    <p id="additionalText" class="font-poppins text-sm font-medium additional-text transition-text">by:Team Developer
    </p>
</body>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
    const lottieAnimation = document.getElementById('lottieAnimation');
    const thankYouText = document.getElementById('thankYouText');
    const additionalText = document.getElementById('additionalText');

    // Listener untuk saat animasi selesai
    lottieAnimation.addEventListener('complete', () => {
        // Menyembunyikan animasi Lottie setelah selesai
        lottieAnimation.classList.add('hidden');

        // Menambahkan kelas show untuk memulai transisi teks
        thankYouText.classList.add('show');
        additionalText.classList.add('show');
    });
</script>

</html>
