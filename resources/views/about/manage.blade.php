<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage About Page - TMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-extrabold text-gray-900">Manage About Content</h1>
            <a href="{{ route('about.index') }}" class="text-sm font-bold text-[#B91C1C] hover:underline">
                View Public Page <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-100 text-green-700 px-4 py-3 rounded-xl text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-10">
            <h2 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Add New Section</h2>
            <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Title</label>
                        <input type="text" name="name" class="hidden"> <input type="text" name="title" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2" placeholder="e.g. Our Vision" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Image (Optional)</label>
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Content</label>
                    <textarea name="content" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2" placeholder="Write the details here..." required></textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-[#B91C1C] text-white px-6 py-2 rounded-lg font-bold text-sm hover:bg-red-800 transition">Add Section</button>
                </div>
            </form>
        </div>

        <div class="space-y-6">
            @foreach($sections as $section)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row gap-6">
                    
                    <div class="w-full md:w-32 h-32 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                         @if($section->image)
                            <img src="{{ Str::startsWith($section->image, 'http') ? $section->image : asset($section->image) }}" class="w-full h-full object-cover">
                         @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Image</div>
                         @endif
                    </div>

                    <div class="flex-grow">
                        <form action="{{ route('about.update', $section->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="flex justify-between gap-4 mb-2">
                                <input type="text" name="title" value="{{ $section->title }}" class="font-bold text-gray-900 bg-transparent border-b border-gray-300 focus:border-[#B91C1C] focus:outline-none w-full">
                                <input type="number" name="order" value="{{ $section->order }}" class="w-16 text-xs text-center border rounded bg-gray-50" title="Sort Order">
                            </div>

                            <textarea name="content" rows="2" class="w-full text-sm text-gray-600 bg-gray-50 border border-gray-200 rounded p-2 mb-3">{{ $section->content }}</textarea>

                            <div class="flex justify-between items-center">
                                <input type="file" name="image" class="text-xs text-gray-400">
                                <button type="submit" class="text-xs bg-gray-900 text-white px-3 py-1.5 rounded hover:bg-black transition">Save Changes</button>
                            </div>
                        </form>
                    </div>

                    <div class="flex items-start">
                        <form action="{{ route('about.destroy', $section->id) }}" method="POST" onsubmit="return confirm('Delete this section?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 p-2"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    @include('components.footer')

</body>
</html>