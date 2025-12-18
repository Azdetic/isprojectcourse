<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sell New Item - TMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full">

        <nav class="flex items-center text-sm text-gray-500 mb-8 font-medium">
            <a href="{{ route('my-products.index') }}" class="hover:text-[#B91C1C] transition">My Shop</a>
            <i class="fas fa-chevron-right text-xs mx-3 text-gray-400"></i>
            <span class="text-gray-900 font-bold">Sell New Item</span>
        </nav>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-900/5 overflow-hidden">
            <div class="p-8 sm:p-10">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-[#B91C1C]">
                        <i class="fas fa-tag text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-gray-900">List an Item</h1>
                        <p class="text-gray-500 text-sm">Fill in the details to start selling.</p>
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

                <form action="{{ route('my-products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Product Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none focus:border-[#B91C1C] transition" placeholder="e.g. Calculus Textbook" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Price (Rp)</label>
                            <input type="number" name="price" value="{{ old('price') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none focus:border-[#B91C1C] transition" placeholder="150000" required>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Category</label>
                            <select name="category" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none focus:border-[#B91C1C] transition cursor-pointer" required>
                                <option value="" {{ !old('category') ? 'selected' : '' }} disabled>Select Category</option>
                                <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>Food</option>
                                <option value="Stationery" {{ old('category') == 'Stationery' ? 'selected' : '' }}>Stationery</option>
                                <option value="Fashion" {{ old('category') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="Electronics" {{ old('category') == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="Books" {{ old('category') == 'Books' ? 'selected' : '' }}>Books</option>
                                <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none focus:border-[#B91C1C] transition resize-none" placeholder="Describe your item..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Product Image</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="image" id="image-label" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-200 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition relative overflow-hidden group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition">
                                        <i class="fas fa-cloud-upload-alt text-gray-400 text-xl group-hover:text-[#B91C1C]"></i>
                                    </div>
                                    <p class="mb-1 text-sm text-gray-500 font-medium">Click to upload image</p>
                                    <p class="text-xs text-gray-400">JPG, PNG (MAX. 2MB)</p>
                                </div>
                                <input id="image" name="image" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex gap-4">
                        <a href="{{ route('my-products.index') }}" class="flex-1 px-6 py-3.5 border border-gray-200 text-gray-600 font-bold rounded-xl text-center hover:bg-gray-50 transition">Cancel</a>
                        <button type="submit" class="flex-1 px-6 py-3.5 bg-[#B91C1C] text-white font-bold rounded-xl shadow-lg hover:bg-red-800 transition">Upload Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('components.footer')

    <script>
        const imageInput = document.getElementById('image');
        const imageLabel = document.getElementById('image-label');

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create preview overlay
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 hover:opacity-100 transition duration-300 rounded-2xl';
                    previewDiv.innerHTML = '<p class="text-white text-sm font-bold">Image Selected</p>';

                    // Add image preview as background
                    imageLabel.style.backgroundImage = `url(${e.target.result})`;
                    imageLabel.style.backgroundSize = 'cover';
                    imageLabel.style.backgroundPosition = 'center';

                    // Change the upload text
                    const textDiv = imageLabel.querySelector('p');
                    if (textDiv) textDiv.textContent = 'Click to change image';

                    // Add overlay
                    imageLabel.appendChild(previewDiv);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
