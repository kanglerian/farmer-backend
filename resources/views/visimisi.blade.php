<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Skripsi">

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

<body class="antialiased bg-gray-50">
    <section class="flex flex-col items-center justify-between h-screen">
        <nav class="w-full flex justify-between items-center px-10">
            <a href="/" class="flex items-end gap-3 py-5">
                <img src="{{ asset('img/plant-black.png') }}" style="width: 50px">
                <span class="font-bold text-gray-900">SIPETANI</span>
            </a>
            @if (Route::has('login'))
                <ul class="flex items-center gap-5">
                    <li>
                        <a href="{{ route('welcome') }}" class="text-sm text-gray-900 underline">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('visimisi') }}" class="text-sm text-gray-900 underline">Visi & Misi</a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-sm text-gray-900 underline">Tentang Kami</a>
                    </li>
                    @auth
                        <li>
                            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-900 underline">Dashboard</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="text-sm text-gray-900 underline">Log in</a>
                        </li>
                    @endauth
                </ul>
            @endif
        </nav>
        <div class="w-full max-w-7xl mx-auto h-full mt-10 text-center">
            <div class="space-y-4">
                <h2 class="font-bold text-2xl">Visi & Misi</h2>
                <p class="text-base">Menjadi unit pelayanan publik yang handal dalam mendukung kemandirian pangan.</p>
                <ul class="space-y-1">
                    <li>Meningkatkan pelayanan publik sektor pertanian dan ketahanan pangan.</li>
                    <li>Mewujudkan pelayanan publik yang cepat, tepat, transparan, dan akuntabel.</li>
                    <li>Mewujudkan kepercayaan masyarakat kepada aparatur pelayanan publik.</li>
                    <li>Membangun sistem informasi pelayanan publik berbasis teknologi informasi.</li>
                </ul>
            </div>
        </div>
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
                    const maps = response.data.data;

                    const map = L.map('map').setView([-7.351971, 108.515845], 10);

                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">Farmer App</a>'
                    }).addTo(map);

                    maps.forEach((result) => {
                        console.log(result);
                        const lat = result.coordinate_device_x ?? -7.351971;
                        const lng = result.coordinate_device_y ?? 108.515845;
                        const marker = L.marker([lat, lng]).addTo(map);
                        const paragraph =
                            `<b>${result.name}</b><br/><span>${result.status} | ${result.condition}</span>`
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
