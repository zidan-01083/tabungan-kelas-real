<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tabungan Kelas</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-900 text-white h-screen">
            <div class="flex items-center justify-center h-16 text-xl font-bold">
                Tabungan Kelas
            </div>
            <ul class="space-y-4 px-4">
                <li>
                    <a href="#" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Dashboard</a>
                </li>
                <li>
                    <a href="#" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Riwayat Transaksi</a>
                </li>
                <li>
                    <a href="#" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Anggota Kelas</a>
                </li>
                <li>
                    <a href="#" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Setoran Tabungan</a>
                </li>
                <li>
                    <a href="#" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md">Laporan</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1: Total Tabungan -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-2xl font-semibold mb-4">Total Tabungan</div>
                    <div class="text-3xl font-bold text-green-600">Rp 5.000.000</div>
                </div>

                <!-- Card 2: Anggota Kelas -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-2xl font-semibold mb-4">Anggota Kelas</div>
                    <div class="text-3xl font-bold text-blue-600">25 Anggota</div>
                </div>

                <!-- Card 3: Setoran Terakhir -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="text-2xl font-semibold mb-4">Setoran Terakhir</div>
                    <div class="text-3xl font-bold text-yellow-600">Rp 200.000</div>
                    <div class="text-sm text-gray-600 mt-2">Dari: Ali</div>
                </div>
            </div>

            <!-- Chart / Graph -->
            <div class="bg-white mt-6 p-6 rounded-lg shadow-lg">
                <div class="text-2xl font-semibold mb-4">Grafik Tabungan</div>
                <!-- Di sini bisa menggunakan grafik seperti Chart.js atau lainnya -->
                <div class="bg-gray-300 h-64 rounded-lg">
                    <!-- Grafik akan ditempatkan di sini -->
                </div>
            </div>
        </div>
    </div>

</body>
</html>
