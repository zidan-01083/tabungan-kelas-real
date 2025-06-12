<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabungan Kelas - Landing Page</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-gradient-to-br from-lime-100 via-yellow-50 to-sky-100 min-h-screen text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-lime-600">TabunganKelas</h1>
            <div class="space-x-6 text-sm font-medium">
                <a href="#fitur" class="hover:text-lime-600">Fitur</a>
                <a href="#tentang" class="hover:text-lime-600">Tentang</a>
                <a href="#kontak" class="hover:text-lime-600">Kontak</a>
                <a href="<?php echo e(route('login')); ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-20 bg-gradient-to-r from-lime-300 to-yellow-200">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-5xl font-extrabold text-gray-800 leading-tight mb-4">Kelola Tabungan Kelas Dengan Mudah</h2>
            <p class="text-lg text-gray-700 mb-6">Simpan, pantau, dan atur keuangan kelas secara digital. Aman, transparan, dan praktis.</p>
            <a href="<?php echo e(url('/dashboard')); ?>" class="bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-full font-semibold text-lg">Mulai Sekarang</a>
        </div>
        <img src="https://undraw.co/api/illustrations/cash_flow.svg" alt="Ilustrasi Tabungan" class="mx-auto mt-10 w-80">
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold text-lime-600 mb-12">Kenapa TabunganKelas?</h3>
            <div class="grid md:grid-cols-3 gap-10 text-left">
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
                    <h4 class="text-xl font-bold text-sky-600 mb-3">🔍 Transparan</h4>
                    <p>Semua anggota bisa melihat alur dana yang masuk dan keluar secara real-time.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
                    <h4 class="text-xl font-bold text-yellow-600 mb-3">💰 Praktis</h4>
                    <p>Setoran dan penarikan dana lebih mudah, cukup input lewat dashboard saja.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
                    <h4 class="text-xl font-bold text-lime-600 mb-3">📊 Laporan Otomatis</h4>
                    <p>Dapatkan rekap tabungan bulanan otomatis tanpa repot hitung manual.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-20 bg-yellow-100">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold text-sky-600 mb-6">Apa Itu TabunganKelas?</h3>
            <p class="text-lg text-gray-700">TabunganKelas adalah platform digital untuk memudahkan manajemen keuangan kelas di sekolah. Sistem ini cocok digunakan oleh wali kelas, bendahara, maupun siswa untuk menyimpan dana kas, mencatat transaksi, dan mengelola pengeluaran secara bersama-sama.</p>
            <img src="https://undraw.co/api/illustrations/savings.svg" alt="Tentang" class="mx-auto mt-10 w-72">
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto text-center px-6">
            <h3 class="text-3xl font-bold text-lime-600 mb-4">Hubungi Kami</h3>
            <p class="text-gray-700 mb-6">Ada pertanyaan? Kami siap membantu. Kirim pesan ke email kami kapan saja.</p>
            <a href="mailto:info@tabungankelas.com" class="inline-block bg-sky-500 hover:bg-sky-600 text-white px-6 py-3 rounded-full font-semibold">Email Kami</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-lime-700 text-white py-6 mt-10">
        <div class="max-w-6xl mx-auto text-center">
            <p class="text-sm">&copy; 2025 TabunganKelas. Dibuat dengan ❤️ untuk pelajar Indonesia.</p>
        </div>
    </footer>

</body>
</html>
<?php /**PATH C:\laragon\www\tabungan-kelas-real\resources\views/landing.blade.php ENDPATH**/ ?>