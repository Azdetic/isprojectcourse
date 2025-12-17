<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Profile - TMarket</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">
        
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Account Settings</h1>
            <p class="text-gray-500 font-medium">Manage your profile and account preferences.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-100 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2 shadow-sm">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-900/5 overflow-hidden mb-8">
            
            <div class="p-8 sm:p-10 border-b border-gray-100 bg-gray-50/50">
                <div class="flex flex-col sm:flex-row items-center gap-6">
                    <div class="relative group">
                        <img class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-md"
                             src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=B91C1C&color=fff&bold=true&size=128"
                             alt="{{ $user->name }}">
                        <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 border-2 border-white rounded-full"></div>
                    </div>
                    <div class="text-center sm:text-left">
                        <h2 class="text-2xl font-extrabold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-gray-500 font-medium">{{ $user->email }}</p>
                        <div class="mt-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-[#B91C1C] border border-red-100">
                                Member since {{ $user->created_at->format('M Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="sm:ml-auto">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-200 rounded-xl font-bold text-gray-700 shadow-sm hover:border-[#B91C1C] hover:text-[#B91C1C] transition">
                            <i class="fas fa-pencil-alt mr-2 text-sm"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-8 sm:p-10">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Personal Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-gray-400 shadow-sm">
                                <i class="far fa-user"></i>
                            </div>
                            <dt class="text-xs font-bold text-gray-500 uppercase tracking-wider">Full Name</dt>
                        </div>
                        <dd class="mt-2 text-gray-900 font-bold ml-11">{{ $user->name }}</dd>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-gray-400 shadow-sm">
                                <i class="far fa-envelope"></i>
                            </div>
                            <dt class="text-xs font-bold text-gray-500 uppercase tracking-wider">Email Address</dt>
                        </div>
                        <dd class="mt-2 text-gray-900 font-bold ml-11">{{ $user->email }}</dd>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-gray-400 shadow-sm">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <dt class="text-xs font-bold text-gray-500 uppercase tracking-wider">Joined Date</dt>
                        </div>
                        <dd class="mt-2 text-gray-900 font-bold ml-11">{{ $user->created_at->format('F d, Y') }}</dd>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-gray-400 shadow-sm">
                                <i class="fas fa-university"></i>
                            </div>
                            <dt class="text-xs font-bold text-gray-500 uppercase tracking-wider">Campus</dt>
                        </div>
                        <dd class="mt-2 text-gray-900 font-bold ml-11">Telkom University</dd>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-red-100 shadow-sm overflow-hidden">
            <div class="p-6 sm:px-10 py-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-red-600">Delete Account</h3>
                    <p class="text-gray-500 text-sm mt-1">Permanently delete your account and all of your content.</p>
                </div>
                
                <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 bg-red-50 text-red-600 font-bold rounded-xl border border-red-100 hover:bg-red-600 hover:text-white transition shadow-sm">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>

    </div>

    @include('components.footer')

</body>
</html>