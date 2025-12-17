<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - TMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        .clip-diagonal {
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 95%);
        }
        
        @media (min-width: 768px) {
            .clip-diagonal {
                clip-path: polygon(0 0, 100% 0, 100% 75%, 0 100%);
            }
        }
    </style>
</head>
<body class="min-h-screen bg-white relative overflow-x-hidden">

    <div class="absolute top-0 left-0 w-full h-[65vh] md:h-[80vh] clip-diagonal z-0 overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/telkomuniv.jpg') }}');"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-red-900/95 via-red-800/90 to-slate-900/90 mix-blend-multiply"></div>
    </div>

    <div class="absolute top-8 right-8 z-20 hidden md:block">
        <a href="{{ route('login') }}" class="px-6 py-2.5 border border-white/30 bg-white/10 backdrop-blur-sm text-white rounded-full text-sm font-bold hover:bg-white hover:text-red-900 transition-all shadow-lg">
            LOG IN
        </a>
    </div>

    <div class="relative z-10 min-h-screen flex flex-col justify-center items-center px-4 py-12">

        <div class="bg-white w-full max-w-[450px] rounded-2xl shadow-2xl shadow-gray-900/20 p-8 md:p-10 relative border border-gray-100">

            <div class="flex flex-col items-center mb-8">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="TMarket Logo" class="h-12 w-auto object-contain">
                    
                    <span class="text-3xl font-extrabold text-[#B91C1C] tracking-tight uppercase">TMARKET</span>
                </div>
            </div>

            <div class="mb-8 text-center">
                <h1 class="text-xl font-bold text-gray-900">Create Account</h1>
                <p class="text-gray-500 text-sm mt-1">Join the marketplace for Telkom University.</p>
            </div>

            <form action="{{ route('signup.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label for="name" class="text-[11px] uppercase font-bold text-gray-500 tracking-wider ml-1">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="John Doe"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all font-medium text-sm"
                        required>
                </div>

                <div class="space-y-1">
                    <label for="email" class="text-[11px] uppercase font-bold text-gray-500 tracking-wider ml-1">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="student@telkomuniversity.ac.id"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all font-medium text-sm"
                        required>
                </div>

                <div class="space-y-1">
                    <label for="password" class="text-[11px] uppercase font-bold text-gray-500 tracking-wider ml-1">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="Create a password"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all pr-10 font-medium text-sm"
                            required>
                        <button type="button" onclick="togglePassword('password')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-start space-x-3 pt-2">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-red-300 text-red-700" required>
                    </div>
                    <label for="terms" class="text-xs text-gray-500 font-medium">
                        I agree to the <a href="#" class="text-red-700 hover:underline font-bold">Terms of Service</a> and <a href="#" class="text-red-700 hover:underline font-bold">Privacy Policy</a>.
                    </label>
                </div>

                <button type="submit" class="w-full bg-[#B91C1C] hover:bg-red-800 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-red-900/20 transition-all transform active:scale-[0.98] mt-2">
                    CREATE ACCOUNT
                </button>

                <div class="relative flex items-center py-2">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="flex-shrink-0 mx-4 text-gray-400 text-[10px] uppercase tracking-widest font-bold">Or</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>

                <button type="button" class="w-full bg-white border border-gray-200 text-gray-700 font-bold py-3.5 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all flex items-center justify-center gap-3">
                    <div class="p-1 rounded bg-red-50 text-red-700">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span>Sign up with Telkom SSO</span>
                </button>

            </form>

        </div>

        <div class="mt-8 text-center text-gray-400 text-xs font-medium">
            &copy; 2025 TMarket. All Rights Reserved.
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
</body>
</html>