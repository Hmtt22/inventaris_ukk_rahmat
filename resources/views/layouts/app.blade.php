<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventory SMK Wikrama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        <aside class="w-72 bg-[#1e3a8a] text-white flex flex-col shadow-xl">

            <div class="p-6">
                <div class="flex items-center gap-3 mb-10">
                    <div class="bg-white p-1.5 rounded-lg shadow-md">
                        <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-8 h-8 object-contain">
                    </div>
                    <span class="font-bold text-xl tracking-tight uppercase">Inventory</span>
                </div>

                <nav class="space-y-4">

                    <a href="{{ Auth::user()->role === 'admin' 
                            ? route('admin.dashboard') 
                            : route('operator.dashboard') }}"
                        class="flex items-center gap-4 p-3 rounded-lg transition duration-200 shadow-md
                        {{ request()->routeIs('admin.dashboard') || request()->routeIs('operator.dashboard') ? 'bg-[#254adb]' : 'hover:bg-[#254adb]' }}">
                        <i class="fas fa-th-large w-5 text-center"></i>
                        <span class="font-semibold">Dashboard</span>
                    </a>

                    <div class="pt-4">
                        <p class="text-[10px] text-blue-300 uppercase font-extrabold mb-3 px-3 tracking-[0.2em] opacity-80">Items Data</p>
                        <div class="space-y-1">
                            @auth
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.categories.index') }}" 
                                    class="flex items-center gap-4 p-3 hover:bg-[#254adb] rounded-lg transition group">
                                        <i class="fas fa-chart-pie w-5 text-center text-blue-300 group-hover:text-white"></i>
                                        <span class="group-hover:translate-x-1 transition duration-200">Categories</span>
                                    </a>
                                @endif
                            @endauth
                            <a href="{{ route('admin.items.index') }}" class="flex items-center gap-4 p-3 hover:bg-[#254adb] rounded-lg transition group">
                                <i class="fas fa-chart-pie w-5 text-center text-blue-300 group-hover:text-white"></i>
                                <span class="group-hover:translate-x-1 transition duration-200">Items</span>
                            </a>
                            @auth
                                @if(Auth::user()->role === 'operator')
                                    <a href="{{ route('lendings.index') }}" class="flex items-center gap-4 p-3 hover:bg-[#254adb] rounded-lg transition group">
                                        <i class="fas fa-sync w-5 text-center text-blue-300 group-hover:text-white"></i>
                                        <span class="group-hover:translate-x-1 transition duration-200">Lending</span>
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>

                    <div class="pt-4">
                        <p class="text-[10px] text-blue-300 uppercase font-extrabold mb-3 px-3 tracking-[0.2em] opacity-80">
                            Accounts
                        </p>

                        <!-- USERS WRAPPER -->
                        <div>

                            <!-- MAIN BUTTON -->
                            <button
                                onclick="toggleUsersMenu()"
                                class="w-full flex items-center justify-between p-3 hover:bg-[#254adb] rounded-lg transition"
                            >
                                <div class="flex items-center gap-4">
                                    <i class="fas fa-user w-5 text-center text-blue-300"></i>
                                    <span class="text-white">Users</span>
                                </div>

                                <i id="usersArrow" class="fas fa-chevron-down text-[10px] text-blue-400 transition"></i>
                            </button>

                            <!-- SUB MENU (HIDDEN BY DEFAULT) -->
                            <div id="usersSubmenu" class="ml-10 mt-2 space-y-2 hidden">

                                <a href="{{ route('users.index', ['role' => 'admin']) }}"
                                class="block text-sm text-blue-200 hover:text-white">
                                    Admin
                                </a>

                                <a href="{{ route('users.index', ['role' => 'operator']) }}"
                                class="block text-sm text-blue-200 hover:text-white">
                                    Operator
                                </a>

                            </div>
                        </div>
                    </div>

                </nav>
            </div>

            <div class="mt-auto p-6 border-t border-blue-800/50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    
                    <button type="submit" class="flex items-center gap-4 text-blue-300 hover:text-white transition group">
                        <i class="fas fa-sign-out-alt group-hover:-translate-x-1 transition duration-200"></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white h-16 border-b border-gray-200 flex items-center px-8 justify-between shadow-sm">
                <h2 class="text-gray-700 font-medium">Welcome Back, <span class="font-bold">Admin Wikrama</span></h2>
                <div class="text-sm text-gray-500 font-medium">{{ date('d F, Y') }}</div>
            </header>

            <main class="p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
    function toggleUsersMenu() {
        const menu = document.getElementById('usersSubmenu');
        const arrow = document.getElementById('usersArrow');

        menu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }
</script>
</body>
</html>
