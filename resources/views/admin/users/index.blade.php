@extends('layouts.admin')

@section('header', 'Manage Users')

@section('content')

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">User Profile</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Joined Date</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                            #{{ $user->id }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-9 w-9">
                                    <img class="h-9 w-9 rounded-full border border-gray-200" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff&bold=true" 
                                         alt="{{ $user->name }}">
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-bold text-gray-900">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->is_admin)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-purple-50 text-purple-700 border border-purple-200">
                                    <i class="fas fa-shield-alt mr-1.5 mt-0.5"></i> Admin
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                    <i class="fas fa-user mr-1.5 mt-0.5"></i> Student
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500 font-medium">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @if(!$user->is_admin)
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to permanently delete this user? This will also remove their products and orders.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 p-2 rounded-lg transition duration-200 group" title="Delete User">
                                        <i class="fas fa-trash-alt group-hover:scale-110 transition-transform"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-gray-400 italic cursor-not-allowed" title="Admins cannot be deleted">Protected</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-users-slash text-2xl text-gray-300"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-500">No users found.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($users, 'links'))
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection