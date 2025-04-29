<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabungan Kelas</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <nav class="bg-white shadow px-6 py-4 mb-6">
        <a href="/students" class="text-lime-600 font-bold">TabunganKelas</a>
    </nav>
    <main class="px-6">
        @yield('content')
    </main>
</body>
</html>
