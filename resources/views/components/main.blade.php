<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/form.js', 'resources/js/movie.js'])

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const token = localStorage.getItem('access_token');

            if (token) {
                document.getElementById('body').classList.remove('hidden')
            } else {
                window.location.href = 'signin'
                return;
            }
        });
    </script>
</head>

<body id="body" class="hidden bg-gray-100 min-h-screen flex flex-col">

    <!-- Overlay Background -->
    <div id="overlay" class="fixed inset-0 bg-[rgba(0,0,0,0.3)] bg-opacity-30 hidden z-40"></div>

    <!-- Navigation Bar -->
    <nav class="py-3 px-4 bg-gray-100 text-black border-b border-gray-300 flex justify-between items-center">
        <div class="flex">
            <button id="sidabar-button" class=" md:hidden mr-[10px] hover:bg-gray-400 cursor-pointer p-2 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h16" />
                </svg>
            </button>
            <p class="font-semibold text-2xl">Main Navigation</p>
        </div>
        <div>
            <p id="user_info"></p>
        </div>
    </nav>

    <!-- Full-height Flex Container -->
    <div class="flex flex-1 overflow-hidden">
        <!-- Heroicons CDN -->
        <script src="https://unpkg.com/heroicons@2.0.13/dist/24/outline/index.js" type="module"></script>

        <aside class="w-72 border-r border-gray-300 hidden md:flex flex-col bg-white">
            <nav class="flex-1 px-4 py-6">
                <ul class="space-y-2">

                    <!-- Movies (active) -->
                    <li>
                        <a href='movie'
                            class="flex items-center gap-3 px-4 py-2 text-white bg-gray-800 rounded-lg font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="2" y="7" width="20" height="10" rx="2" ry="2" />
                                <path d="M2 7l4 5-4 5" />
                                <path d="M22 7l-4 5 4 5" />
                            </svg>
                            <span>Movies</span>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li>
                        <a href=""
                            class=" logout-btn flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-600 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-white"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                            </svg>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        {{-- for mobile view --}}
        <aside id="sidebar-mobile"
            class="w-72 fixed top-0 left-0 h-full border-r border-gray-300 hidden flex-col bg-white z-50 md:hidden shadow-lg">

            <nav class="flex-1 px-4 py-6">
                <div class="flex justify-between mb-5 items-center">
                    <p class="font-semibold">Main Navigation</p>
                    <button id="sidebarclose-mobile" class="hover:bg-gray-400 cursor-pointer p-2 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16" />
                        </svg>
                    </button>
                </div>
                <ul class="space-y-2">

                    <!-- Movies (active) -->
                    <li>
                        <a href='movie'
                            class="flex items-center gap-3 px-4 py-2 text-white bg-gray-800 rounded-lg font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="2" y="7" width="20" height="10" rx="2" ry="2" />
                                <path d="M2 7l4 5-4 5" />
                                <path d="M22 7l-4 5 4 5" />
                            </svg>
                            <span>Movies</span>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li>
                        <a href=""
                            class=" logout-btn flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-600 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-white"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                            </svg>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>


        <!-- Main Content -->
        <main class="flex-1 overflow-auto flex-1 bg-[#f0f0f0]">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
