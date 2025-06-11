<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tabungan Kelas</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow px-6 py-4 mb-6 flex justify-between items-center">
        <a href="/dashboard" class="text-lime-600 font-bold text-xl">TabunganKelas</a>

        @auth
            <div class="relative inline-block text-left">
                <button type="button" class="flex items-center text-gray-700 font-medium hover:text-lime-600 focus:outline-none" id="menu-button" aria-expanded="true" aria-haspopup="true">
                    {{ Auth::user()->name }} </strong> ({{ Auth::user()->role }})
                    <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.1 1.02l-4.25 4.657a.75.75 0 01-1.1 0L5.25 8.27a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10 hidden" id="dropdown-menu">
                    <div class="py-1">
                        <!-- Profile link -->
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>

                        <!-- Admin Page link, only visible for admin users -->
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('admin.panel') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Page</a>
                        @endif

                        <!-- Logout button -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
    </nav>

    <!-- Main content -->
    <main class="px-6">
        @yield('content')
    </main>

    <!-- Script for dropdown toggle -->
    <script>
        document.addEventListener('click', function(e) {
            const button = document.getElementById('menu-button');
            const menu = document.getElementById('dropdown-menu');
            if (button && button.contains(e.target)) {
                menu.classList.toggle('hidden');
            } else {
                menu.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
