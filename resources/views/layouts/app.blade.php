<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        Test LIMS
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="/favicon.png" type="image/png" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        /* Scrollbar styling for horizontal scroll */
        .scrollbar-x::-webkit-scrollbar {
            height: 8px;
        }

        .scrollbar-x::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            /* Tailwind slate-300 */
            border-radius: 9999px;
        }

        .scrollbar-x::-webkit-scrollbar-track {
            background-color: #f1f5f9;
            /* Tailwind slate-100 */
        }
    </style>
</head>

<body class="bg-white text-black min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-[#2f4f7f] flex items-center px-3 sm:px-6 py-2 gap-2 select-none">
        <img alt="Logo with globe and green-blue elements" class="w-8 h-8" height="32"
            src="/favicon.png" width="32" />
        <div class="flex flex-col leading-none">
            <span class="text-white font-semibold text-base sm:text-lg">
                Test LIMS
            </span>
            <span class="text-[#cbd5e1] text-xs sm:text-sm font-normal">
                Version: 3.2.0.1
            </span>
        </div>
        <div class="flex-grow">
        </div>
        <button aria-label="Menu" class="text-white text-xl sm:text-2xl focus:outline-none sm:hidden">
            <i class="fas fa-bars">
            </i>
        </button>
        <div class="hidden sm:flex items-center space-x-6 text-white text-lg">
            <button aria-label="Search" class="hover:text-gray-300 focus:outline-none">
                <i class="fas fa-search">
                </i>
            </button>
            <button aria-label="Notifications" class="hover:text-gray-300 focus:outline-none">
                <i class="far fa-bell">
                </i>
            </button>
            <button aria-label="User Account" class="hover:text-gray-300 focus:outline-none">
                <i class="far fa-user-circle">
                </i>
            </button>
            <button aria-label="Help" class="hover:text-gray-300 focus:outline-none">
                <i class="fas fa-question-circle">
                </i>
            </button>
        </div>
    </header>
    <main class="flex-grow p-4 sm:p-6 max-w-full overflow-x-hidden">
        @yield('content')
    </main>
</body>

</html>
