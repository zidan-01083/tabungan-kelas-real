<nav class="bg-white shadow px-6 py-4 mb-6 flex justify-between items-center">
    <a href="{{ route('dashboard') }}" class="text-lime-600 font-bold text-xl">TabunganKelas</a>

    @auth
        <div class="relative inline-block text-left">
            <button type="button" class="flex items-center text-gray-700 font-medium hover:text-lime-600" id="menu-button">
                {{ Auth::user()->nama_siswa ?? Auth::user()->name }} ({{ Auth::user()->role }})
            </button>

            <div class="absolute right-0 mt-2 w-48 rounded shadow-lg bg-white z-10 hidden" id="dropdown-menu">
                <div class="py-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.panel') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    @endauth
</nav>

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
