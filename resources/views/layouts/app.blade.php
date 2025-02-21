<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SIMS Web App</title>
        {{-- ngok meta tag --}}
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('asset/fontawesome/css/all.css') }}" />
        <!-- Data Tables -->
        <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
        @yield('costum-css')

    </head>
    <body>
        <div class="d-flex">
            <!-- Sidebar -->
            <div id="sidebar" class="sidebar bg-danger vh-100  text-white">
                <div class="mb-2 d-flex p-3">
                    <div class="sidebar-logo">
                        <img src="{{ asset('assets/Handbag.png') }}" alt="" class="me-2 ms-2 "/>
                        <a href="{{ route('product.index') }}" class="ms-2">SIMS App Web</a>
                    </div>
                    <button class="toggle-btn ms-auto p-2" id="toggleButton" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 32 32"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h22M5 16h22M5 24h22"/></svg>
                    </button>
                </div>

                <ul class="nav flex-column p-3">
                    <li class="nav-item mb-2">
                        <a href="{{ route('product.index') }}" class="nav-link text-white d-flex align-items-center px-2  {{ request()->routeIs('product.index','product.create','product.edit') ? 'active' : '' }}">
                            <img src="{{ asset('assets/Package.png') }}" alt="" class="me-2"/>
                            <span class="ms-2">Produk</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('profile') }}" class="nav-link text-white d-flex align-items-center px-2 {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <img src="{{ asset('assets/User.png') }}" alt="" class="me-2" />
                            <span class="ms-2">Profil</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link text-white d-flex align-items-center px-2">
                            <img src="{{ asset('assets/SignOut.png') }}" alt="" class="me-2" />
                            <span class="ms-2">Logout</span>
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>

            <!-- Content -->
            <div class="flex-grow-1 p-4">
                @yield('content')
            </div>
        </div>


        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }} "></script>
        <script src="{{ asset('js/datatables.min.js')}}"></script>
        <script src="{{ asset('js/datatables.init.js')}}"></script>
        <script>
            // Fungsi untuk menangani klik pada nav-link
            document.querySelectorAll(".nav-link").forEach(link => {
                link.addEventListener("click", function() {
                    // Menghapus class 'active' dari semua nav-link
                    document.querySelectorAll(".nav-link").forEach(nav => nav.classList.remove("active"));

                    // Menambahkan class 'active' ke link yang diklik
                    this.classList.add("active");
                });
            });

            // Sidebar Toggle
            document.getElementById("toggleButton").addEventListener("click", function() {
                document.getElementById("sidebar").classList.toggle("collapsed");
            });
        </script>
        @yield('custom-js')
    </body>
    </html>
