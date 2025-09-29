<!DOCTYPE html>
<html lang="en" x-data="{ openSidebar: false }" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        .heading-font {
            font-family: 'Geist', system-ui, -apple-system, sans-serif;
            font-weight: 500;
            letter-spacing: -0.025em;
        }
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600&display=swap">
</head>

<body class="bg-neutral-50 h-full">

    <!-- Mobile top bar -->
    <div class="md:hidden sticky top-0 z-40 bg-white/95 backdrop-blur border-b">
        <div class="flex items-center justify-between px-4 h-14">
            <button class="p-2 rounded hover:bg-gray-100" @click="openSidebar = true" aria-label="Open menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h10M4 18h16" />
                </svg>
            </button>
            <div class="font-semibold">{{ $title ?? 'Admin' }}</div>
            <div></div>
        </div>
    </div>

    <div class="flex">
        <!-- Desktop Sidebar -->
        <aside class="hidden md:flex w-80 bg-gradient-to-b from-neutral-900 to-neutral-800 flex-col relative min-h-screen" id="particles-container">
            <div id="particles-js"></div>
            @include('layouts.sidebar-content')
        </aside>

        <!-- Mobile Sidebar (drawer) -->
        <div 
            x-show="openSidebar"
            x-transition
            class="fixed inset-0 z-50 flex md:hidden"
            aria-modal="true"
            style="display:none"
        >
            <!-- overlay -->
            <div class="fixed inset-0 bg-black/50" @click="openSidebar = false"></div>

            <!-- drawer -->
            <aside class="relative w-72 bg-gradient-to-b from-neutral-900 to-neutral-800 flex flex-col" id="particles-container-mobile">
                <div id="particles-js-mobile"></div>
                @include('layouts.sidebar-content')
            </aside>
        </div>

        <!-- Main Content -->
        <main class="flex-1 min-h-screen">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                @yield('content')
            </div>
        </main>
    </div>

    @yield('scripts')

    <script>
        function initParticles(id) {
            particlesJS(id, {
                particles: {
                    number: { value: 60, density: { enable: true, value_area: 800 } },
                    color: { value: "#d4d4d8" },
                    shape: { type: "circle" },
                    opacity: { value: 0.3 },
                    size: { value: 2, random: true },
                    line_linked: {
                        enable: true,
                        distance: 120,
                        color: "#a1a1aa",
                        opacity: 0.2,
                        width: 1
                    },
                    move: { enable: true, speed: 1.5 }
                },
                interactivity: {
                    detect_on: "canvas",
                    events: { onhover: { enable: true, mode: "repulse" }, resize: true },
                    modes: { repulse: { distance: 80, duration: 0.4 } }
                },
                retina_detect: true
            });
        }

        initParticles('particles-js');
        initParticles('particles-js-mobile');
    </script>
</body>
</html>
