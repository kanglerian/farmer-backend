<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIPETANI</title>

    <!-- Fonts -->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        #map {
            height: 100%;
            width: 100%;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-[#2c3e50]">
    <section class="flex flex-col items-center justify-between h-screen px-5 md:px-0 py-5">
        <nav class="flex flex-col justify-center items-center space-y-5">
            <a href="/" class="flex items-end gap-3 py-5">
                <img src="{{ asset('img/plant.png') }}" style="width: 50px">
                <span class="font-bold text-white">SIPETANI</span>
            </a>
            @if (Route::has('login'))
                <ul class="flex items-center gap-5">
                    @auth
                        <li>
                            <a href="{{ url('/dashboard') }}" class="text-sm text-white underline">Dashboard</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="text-sm text-white bg-[#e67e22] hover:bg-[#DA7821] px-5 py-3 rounded-xl">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}" class="text-sm text-white bg-[#e67e22] hover:bg-[#DA7821] px-5 py-3 rounded-xl">Register</a>
                            </li>
                        @endif
                    @endauth
                </ul>
            @endif
        </nav>
        <div class="w-full md:w-2/3 h-2/3">
            <div id="map" class="rounded-2xl shadow-xl border-4 border-[#e67e22]"></div>
        </div>
        <footer>
            <p class="text-sm text-white">Copyright © 2024 SIPETANI</p>
        </footer>
    </section>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    @stack('scripts')
    <script>
        const getStreets = async () => {
            await axios.get(`/api/devices`)
                .then((response) => {
                    const maps = response.data.results;

                    const map = L.map('map').setView([-7.351971,108.515845], 10);

                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">Farmer App</a>'
                    }).addTo(map);

                    maps.forEach((result) => {
                        console.log(result);
                        const lat = result.coordinate_device_x ?? -7.351971;
                        const lng = result.coordinate_device_y ?? 108.515845;
                        const marker = L.marker([lat, lng]).addTo(map);
                        const paragraph = `<b>${result.name}</b><br/><span>${result.status} | ${result.condition}</span>`
                        marker.bindPopup(paragraph).openPopup();

                        const circle = L.circle([lat, lng], {
                            color: 'red',
                            fillColor: '#f03',
                            fillOpacity: 0.5,
                            radius: 80
                        }).addTo(map);
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        }
        getStreets();
    </script>
</body>

</html>
