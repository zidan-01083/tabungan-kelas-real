<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Tabungan Kelas</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    @include('components.navbar')

    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
