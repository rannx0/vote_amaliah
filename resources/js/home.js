// runing text
const phrases = [
    "Assalamualaikum🖐️",
    "Selamat Datang😊",
    "Jangan lupa vote ya👌",
    "Terima Kasih👋",
];
// scrip untuk menentukan kecepatan animasi runing text
let phraseIndex = 0;
let charIndex = 0;
const typingSpeed = 100; // kecepatan ketikan dalam milidetik
const element = document.getElementById("typing-text");

function typeWriter() {
    if (charIndex < phrases[phraseIndex].length) {
        element.innerHTML += phrases[phraseIndex].charAt(charIndex);
        charIndex++;
        setTimeout(typeWriter, typingSpeed);
    } else {
        setTimeout(() => {
            element.innerHTML = ""; // Menghapus teks setelah selesai
            charIndex = 0; // Reset charIndex
            phraseIndex = (phraseIndex + 1) % phrases.length; // Pindah ke frasa berikutnya
            typeWriter(); // Mulai mengetik frasa berikutnya
        }, 1000); // Tunggu 1 detik sebelum memulai frasa berikutnya
    }
}

typeWriter();
