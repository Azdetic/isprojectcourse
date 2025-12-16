<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - TMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .clip-diagonal {
            clip-path: polygon(0 0, 100% 0, 100% 70%, 0 85%);
        }
        @media (min-width: 768px) {
            .clip-diagonal {
                clip-path: polygon(0 0, 100% 0, 100% 80%, 0 95%);
            }
        }
    </style>
</head>
<body class="min-h-screen bg-white relative overflow-x-hidden">

    <!-- Background Section -->
    <div class="absolute top-0 left-0 w-full h-[70vh] md:h-[80vh] clip-diagonal z-0 overflow-hidden">
        <!-- City Image -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/telkomuniv.jpg') }}');"></div>
        <!-- Red Overlay -->
        <div class="absolute inset-0 bg-red-900/80 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-red-900/50 to-red-900/80"></div>
    </div>

    <!-- Top Right Button (Desktop Only) -->
    <div class="absolute top-6 right-8 z-20 hidden md:block">
        <a href="{{ route('login') }}" class="px-6 py-2 border border-white text-white rounded-full text-sm font-semibold hover:bg-white/10 transition">
            SIGN IN
        </a>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen flex flex-col justify-center items-center px-4 py-12">

        <!-- Auth Card -->
        <div class="bg-white w-full max-w-[450px] rounded-2xl shadow-xl p-8 md:p-10 relative">

            <!-- Logo -->
            <div class="flex flex-col items-center mb-6">
                <div class="flex items-center gap-2 text-red-700 font-bold text-2xl tracking-tight">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/>
                    </svg>
                    <span>TMARKET</span>
                </div>
            </div>

            <!-- Title -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-1">Sign Up</h1>
                <p class="text-gray-400 text-sm">blablabla</p>
            </div>

            <!-- Form Content -->
            <form action="{{ route('signup.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Name Input -->
                <div class="space-y-1">
                    <label for="name" class="text-[10px] uppercase font-bold text-gray-500 tracking-wider ml-1">NAME</label>
                    <input type="text" name="name" id="name" placeholder="John"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 placeholder-gray-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors"
                        required>
                </div>

                <!-- Email Input -->
                <div class="space-y-1">
                    <label for="email" class="text-[10px] uppercase font-bold text-gray-500 tracking-wider ml-1">EMAIL ADDRESS</label>
                    <input type="email" name="email" id="email" placeholder="johndoe@example.com"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 placeholder-gray-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors"
                        required>
                </div>

                <!-- Password Input -->
                <div class="space-y-1">
                    <label for="password" class="text-[10px] uppercase font-bold text-gray-500 tracking-wider ml-1">PASSWORD</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="**********"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-700 placeholder-gray-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-colors pr-10"
                            required>
                        <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Terms Checkbox -->
                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="terms" id="terms" class="w-4 h-4 border-gray-300 rounded text-red-600 focus:ring-red-500" required>
                    <label for="terms" class="text-gray-500 text-xs">
                        I agree to the <a href="#" class="underline hover:text-red-600">Terms of Service</a> and <a href="#" class="underline hover:text-red-600">Privacy Policy</a>.
                    </label>
                </div>

                <!-- Signup Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-red-700 to-red-800 hover:from-red-800 hover:to-red-900 text-white font-bold py-3.5 rounded-lg uppercase tracking-wide shadow-lg shadow-red-700/30 transition-all transform hover:scale-[1.01]">
                    CREATE AN ACCOUNT
                </button>

                <!-- Telkom Button -->
                <button type="button" class="w-full bg-white border border-red-700 text-red-700 font-bold py-3.5 rounded-lg uppercase tracking-wide hover:bg-red-50 transition-colors">
                    USE TELKOM ACCOUNT
                </button>

            </form>

        </div>

        <!-- Footer -->
        <div class="mt-12 text-center text-gray-400 text-xs opacity-60">
            &copy; 2025 All Rights Reserved. TMarket
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '-icon');
            if (input.type === "password") {
                input.type = "text";
                // Change icon to eye-slash if needed, or just keep eye
            } else {
                input.type = "password";
            }
        }
    </script>
</body>
</html>
