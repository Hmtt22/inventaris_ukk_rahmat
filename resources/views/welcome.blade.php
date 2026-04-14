<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory SMK Wikrama</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- ================= NAVBAR ================= -->
<div class="bg-gray-200">
    <div class="max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-12">
        <button onclick="openModal()" class="bg-blue-500 text-white px-5 py-2 rounded-md hover:bg-blue-600 transition">
            Login
        </button>
    </div>
</div>

<!-- ================= MODAL LOGIN ================= -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">

    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

        <form method="POST" action="/login">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Email</label>
                <input type="email" name="email" placeholder="Email"
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-6">
                <label class="block text-gray-600 mb-1">Password</label>
                <input type="password" name="password" placeholder="Password"
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <div class="flex justify-between">
                <button type="button" onclick="closeModal()"
                        class="bg-orange-400 text-white px-4 py-2 rounded-md hover:bg-orange-500">
                    Close
                </button>

                <button type="submit"
                        class="bg-green-400 text-white px-4 py-2 rounded-md hover:bg-green-500">
                    Submit
                </button>
            </div>
        </form>
    </div>

</div>

<!-- ================= HERO ================= -->
<section class="bg-white py-20"> <div class="max-w-6xl mx-auto px-6 text-center"> <div class="mb-12"> <h1 class="text-5xl font-extrabold mb-6 text-gray-900 leading-tight">
                Inventory Management of <br> SMK Wikrama
            </h1>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto">
                Management of incoming and outgoing items at SMK Wikrama Bogor.
            </p>
        </div>

        <div class="flex justify-center">
            <img src="{{ asset('images/landing.png') }}"
                 alt="inventory"
                 class="w-full max-w-2xl h-auto object-contain">
                 </div>

    </div>
</section>

<!-- ================= FLOW ================= -->
<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-3xl font-semibold mb-2">Our system flow</h2>
        <p class="text-gray-500 mb-10">Our inventory system workflow</p>

        <div class="grid md:grid-cols-4 gap-6">

            <!-- CARD 1 -->
            <div class="row g-4 text-center">
                <div class="col-lg-3 col-md-6">
                    <div class="flow-card">
                        <div class="flow-img-wrapper" style="background-color: #040723">
                            <img src="{{ asset('images/gambar1.png') }}" alt="Items Data">
                        </div>
                        <h6 class="flow-title">Items Data</h6>
                    </div>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="row g-4 text-center">
                <div class="col-lg-3 col-md-6">
                    <div class="flow-card">
                        <div class="flow-img-wrapper" style="background-color: #040723">
                            <img src="{{ asset('images/gambar2.png') }}" alt="Management Technician">
                        </div>
                        <h6 class="flow-title">Management Technician</h6>
                    </div>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="row g-4 text-center">
                <div class="col-lg-3 col-md-6">
                    <div class="flow-card">
                        <div class="flow-img-wrapper" style="background-color: #040723">
                            <img src="{{ asset('images/gambar3.png') }}" alt="Managed Lending">
                        </div>
                        <h6 class="flow-title">Managed Lending</h6>
                    </div>
                </div>
            </div>

            <!-- CARD 4 -->
            <div class="row g-4 text-center">
                <div class="col-lg-3 col-md-6">
                    <div class="flow-card">
                        <div class="flow-img-wrapper" style="background-color: #040723">
                            <img src="{{ asset('images/gambar4.png') }}" alt="All Can Borrow">
                        </div>
                        <h6 class="flow-title">All Can Borrow</h6>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<footer class="bg-white border-t border-gray-200 py-16">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12">

        <div class="flex flex-col gap-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo SMK Wikrama" class="w-16">
            <div class="text-gray-500 space-y-1">
                <p>smkwikrama@sch.id</p>
                <p>001-7876-2876</p>
            </div>
        </div>

        <div>
            <h3 class="text-xl font-bold mb-6">Our Guidelines</h3>
            <ul class="text-gray-500 space-y-3">
                <li><a href="#" class="hover:text-gray-800">Terms</a></li>
                <li><a href="#" class="text-red-500 font-medium">Privacy policy</a></li>
                <li><a href="#" class="hover:text-gray-800">Cookie Policy</a></li>
                <li><a href="#" class="hover:text-gray-800">Discover</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-xl font-bold mb-6">Our address</h3>
            <p class="text-gray-500 mb-6 leading-relaxed">
                Jalan Wangun Tengah<br>
                Sindangsari<br>
                Jawa Barat
            </p>

            <div class="flex gap-4">
                <a href="#" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:bg-gray-100">
                    <span class="text-xs">f</span>
                </a>
                <a href="#" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:bg-gray-100">
                    <span class="text-xs">t</span>
                </a>
                <a href="#" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:bg-gray-100">
                    <span class="text-xs">ig</span>
                </a>
                <a href="#" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:bg-gray-100">
                    <span class="text-xs">in</span>
                </a>
            </div>
        </div>

    </div>
</footer>

<script>
    function openModal() {
        document.getElementById('loginModal').classList.remove('hidden');
        document.getElementById('loginModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('loginModal').classList.add('hidden');
        document.getElementById('loginModal').classList.remove('flex');
    }
</script>

</body>
</html>
