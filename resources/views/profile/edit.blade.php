<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile - TMarket</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">

        <nav class="flex items-center text-sm text-gray-500 mb-8 font-medium">
            <a href="{{ route('profile.show') }}" class="hover:text-[#B91C1C] transition">My Profile</a>
            <i class="fas fa-chevron-right text-xs mx-3 text-gray-400"></i>
            <span class="text-gray-900 font-bold">Edit Profile</span>
        </nav>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-900/5 overflow-hidden">
            <div class="p-8 sm:p-10">
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-[#B91C1C]">
                        <i class="fas fa-user-edit text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-gray-900">Edit Profile</h1>
                        <p class="text-gray-500 text-sm">Update your personal information and security.</p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-xl text-sm font-medium">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#B91C1C]/20 focus:border-[#B91C1C] transition"
                            required>
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#B91C1C]/20 focus:border-[#B91C1C] transition"
                            required>
                    </div>

                    <div class="border-t border-gray-100 pt-6 mt-6">
                        <h3 class="text-sm font-bold text-gray-900 mb-4">Change Password <span class="text-gray-400 font-normal">(Optional)</span></h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">New Password</label>
                                <input type="password" name="password" id="password" 
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#B91C1C]/20 focus:border-[#B91C1C] transition"
                                    placeholder="Leave blank to keep current">
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#B91C1C]/20 focus:border-[#B91C1C] transition"
                                    placeholder="Confirm new password">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex gap-4">
                        <a href="{{ route('profile.show') }}" class="flex-1 px-6 py-3.5 border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 hover:text-gray-900 transition text-center">
                            Cancel
                        </a>
                        <button type="submit" class="flex-1 px-6 py-3.5 bg-[#B91C1C] text-white font-bold rounded-xl hover:bg-red-800 transition shadow-lg shadow-red-900/20 active:scale-[0.98]">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @include('components.footer')

</body>
</html>