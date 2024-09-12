<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="css/output.css" rel="stylesheet"> --}}
    @vite('resources/css/output.css')
    <!-- typography -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- icon title browser -->
    <link rel="icon" href="{{asset('asset/image/logo title.png')}}" type="image/icon" />
    <!-- css boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Smk Amaliah 1&2 Ciawi</title>
    <style>
        .dropdown-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .dropdown-content.show1 {
            max-height: 500px;
            /* Adjust as needed */
        }

        .dropdown-content.show2 {
            max-height: 500px;
            /* Adjust as needed */
        }

        input:checked+label svg {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="bg-putih-200">
    <div class="flex items-center justify-center sm:p-10 p-5 lg:px-10 bg-gray-100">
        <div class="min-h-screen max-w-5xl mx-auto place-content-center justify-center justify-items-center grid md:grid-cols-2 lg:grid-cols-3 gap-x-14 gap-y-5">
            <!-- vote.blade.php -->

@foreach($candidates as $candidate)
<!-- card 1 -->
<div class="bg-white shadow-sm rounded-2xl overflow-hidden max-w-xs order-first lg:order-none">
    <div class="rounded-lg p-8 md:p-8 w-full max-w-xs">
        <div class="flex flex-col items-center">
            <!-- Gambar kandidat -->
            <img class="w-[94px] h-[94px] bg-gray-300 rounded-full mb-4" src="{{ asset('storage/' . $candidate->image) }}" alt="Candidate Image">

            <!-- Nama Kandidat -->
            <h2 class="text-lg md:text-xl font-bold font-montserrat">{{ $candidate->name }}</h2>

            <!-- Kelas Kandidat -->
            <p class="text-abu-200 font-medium font-poppins">{{ $candidate->kelas->name ?? 'Tidak ada kelas' }}</p>

            <!-- Nomor Urut Kandidat -->
            <p class="text-hitam-200 font-semibold font-poppins text-2xl mt-3">{{ $candidate->nomor_urut }}</p>
        </div>

        <div class="mt-4">
            <form action="{{ route('vote.store')}}" method="POST">
                @csrf
                <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                <button class="font-montserrat font-semibold w-full h-[42px] bg-ijo-200 hover:bg-ijo-400 transition duration-200 ease-in-out active:bg-ijo-200 focus:outline-none focus:ring focus:ring-ijomuda text-white py-2 rounded-full">
                    Vote Ketua OSIS
                </button>
            </form>
        </div>

        <div class="mt-4">
            <!-- button -->
            <input type="checkbox" id="toggle{{ $candidate->id }}" class="hidden">
            <label for="toggle{{ $candidate->id }}" onclick="toggleSection('lihat-visi-misi{{ $candidate->id }}')" class="w-full text-center font-montserrat font-medium text-hitam-200 hover:underline flex items-center justify-center cursor-pointer">
                Lihat visi misi mereka
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" class="ml-1 transition-transform duration-300 transform">
                    <path d="m6.293 13.293 1.414 1.414L12 10.414l4.293 4.293 1.414-1.414L12 7.586z"></path>
                </svg>
            </label>
            <!-- button end -->

            <div id="lihat-visi-misi{{ $candidate->id }}" class="dropdown-content mt-2 text-gray-800">
                <!-- Bagian Visi -->
                <div class="mt-[10px]">
                    <h1 class="text-lg font-montserrat font-semibold text-black">Visi</h1>
                    <p class="mt-[6px] text-abu-200 font-poppins text-base">{{ $candidate->visi }}</p>
                </div>

                <!-- Bagian Misi -->
                <div class="mt-[10px]">
                    <h1 class="text-lg font-montserrat font-semibold text-black">Misi</h1>
                    <ol class="list-decimal pl-8 mt-[6px] text-abu-200 font-poppins text-base">
                        @foreach(explode("\n", $candidate->misi) as $misi)
                            <li>{{ $misi }}</li>
                        @endforeach
                    </ol>
                </div>

                <!-- Bagian Program Sekolah -->
                <div class="mt-[10px]">
                    <h1 class="text-lg font-montserrat font-semibold text-black">Program Sekolah</h1>
                    <ol class="list-decimal pl-5 mt-[6px] text-abu-200 font-poppins text-base">
                        @foreach(explode("\n", $candidate->program) as $program)
                            <li>{{ $program }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

            {{-- <!-- card 1 -->
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden max-w-xs order-first lg:order-none">
                <div class="rounded-lg p-8 md:p-8 w-full max-w-xs">
                    <div class="flex flex-col items-center">
                        <img class="w-[94px] h-[94px] bg-gray-300 rounded-full mb-4" src="{{asset('asset/image/unduhan (2).jpeg')}}"
                            alt="#">
                        <h2 class="text-lg md:text-xl font-bold font-montserrat">Febriansyah Saputra</h2>
                        <p class="text-abu-200 font-medium font-poppins">XI PPLG 2</p>
                        <p class="text-hitam-200 font-semibold font-poppins text-2xl mt-3">01</p>
                    </div>
                    <div class="mt-4">
                        <a href="end.html">
                            <button onclick="vote()"
                            class="font-montserrat font-semibold w-full h-[42px] bg-ijo-200 hover:bg-ijo-400 transition duration-200 ease-in-out active:bg-ijo-200 focus:outline-none focus:ring focus:ring-ijomuda text-white py-2 rounded-full">Vote
                            Ketua OSIS
                        </button>
                        </a>
                    </div>

                    <div class="mt-4">
                        <!-- button -->
                        <input type="checkbox" id="toggle1" class="hidden">
                        <label for="toggle1" onclick="toggleSection('lihat-visi-misi1')"
                            class="w-full text-center font-montserrat font-medium text-hitam-200 hover:underline flex items-center justify-center cursor-pointer">
                            Lihat visi misi mereka
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                class="ml-1 transition-transform duration-300 transform">
                                style="fill: #222222;transform: msFilter;">
                                <path d="m6.293 13.293 1.414 1.414L12 10.414l4.293 4.293 1.414-1.414L12 7.586z"></path>
                            </svg>
                        </label>
                        <!-- button end -->

                        <div id="lihat-visi-misi1" class="dropdown-content mt-2 text-gray-800">
                            <!-- Bagian Visi -->
                            <div class="mt-[10px]">
                                <h1 class="text-lg font-montserrat font-semibold text-black">Visi</h1>
                                <p class="mt-[6px] text-abu-200 font-poppins text-base">"Menjadi OSIS yang aktif,
                                    kreatif, dan berkontribusi positif untuk
                                    lingkungan
                                    sekolah."</p>
                            </div>

                            <!-- Bagian Misi -->
                            <div class="mt-[10px]"> <!-- Margin atas 10px / 1.0rem -->
                                <h1 class="text-lg font-montserrat font-semibold text-black">Misi</h1>
                                <ol class="list-decimal pl-8 mt-[6px] text-abu-200 font-poppins text-base">
                                    <li>Menjadi penggerak kegiatan sekolah yang inovatif dan bermanfaat.</li>
                                    <li>Menjalin hubungan baik antara siswa, guru, dan pihak sekolah.</li>
                                    <li>Menyediakan wadah untuk pengembangan bakat dan minat siswa.</li>
                                </ol>
                            </div>

                            <!-- Bagian Program Sekolah -->
                            <div class="mt-[10px]">
                                <h1 class="text-lg font-montserrat font-semibold text-black">Program Sekolah</h1>
                                <ol class="list-decimal pl-5 mt-[6px] text-abu-200 font-poppins text-base">
                                    <li>Ngaji Bersama</li>
                                    <li>Pengelolaan Dana Darurat</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            
        </div>
    </div>
</body>
{{-- <script src="vote.js"></script> --}}
@vite('resources/js/vote.js')

</html>
