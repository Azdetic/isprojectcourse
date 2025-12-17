<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product - TMarket</title>
    
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
            <span class="text-gray-900 font-bold">Edit Item</span>
        </nav>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-900/5 overflow-hidden">
            <div class="p-8 sm:p-10">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-[#B91C1C]">
                        <i class="fas fa-pencil-alt text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-gray-900">Edit Product</h1>
                        <p class="text-gray-500 text-sm">Update details for <strong>{{ $product->name }}</strong></p>
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

                <form action="{{ route('my-products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Product Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none focus:border-[#B91C1C] transition" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Price (Rp)</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none focus:border-[#B91C1C] transition" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Category</label>
                            <select name="category" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none focus:border-[#B91C1C] transition cursor-pointer">
                                @foreach(['Food', 'Stationery', 'Fashion', 'Electronics', 'Books', 'Secondhand Goods', 'Digital Services', 'Other'] as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-medium focus:outline-none focus:border-[#B91C1C] transition resize-none" required>{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Product Image</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="image" id="image-label" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-200 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition relative overflow-hidden group">
                                
                                <div id="image-content" class="w-full h-full">
                                    @if($product->image)
                                        <div class="relative w-full h-full">
                                            <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}" 
                                                 class="w-full h-full object-cover"
                                                 onerror="this.src='https://placehold.co/600x400?text=Image+Error'">
                                            
                                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                                <p class="text-white text-sm font-bold">Click to Change</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6 h-full">
                                            <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition">
                                                <i class="fas fa-cloud-upload-alt text-gray-400 text-xl group-hover:text-[#B91C1C]"></i>
                                            </div>
                                            <p class="mb-1 text-sm text-gray-500 font-medium">Click to upload image</p>
                                            <p class="text-xs text-gray-400">JPG, PNG (MAX. 2MB)</p>
                                        </div>
                                    @endif
                                </div>

                                <input id="image" name="image" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 flex gap-4">
                        <a href="{{ route('my-products.index') }}" class="flex-1 px-6 py-3.5 border border-gray-200 text-gray-600 font-bold rounded-xl text-center hover:bg-gray-50 transition">Cancel</a>
                        <button type="submit" class="flex-1 px-6 py-3.5 bg-[#B91C1C] text-white font-bold rounded-xl shadow-lg hover:bg-red-800 transition">Update Product</button>
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
                    // Force the label to show the new image immediately
                    imageLabel.innerHTML = `
                        <div class="relative w-full h-full">
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition duration-300">
                                <p class="text-white text-sm font-bold">Change Image</p>
                            </div>
                        </div>
                        <input id="image" name="image" type="file" class="hidden" accept="image/*">
                    `;
                    // Re-attach listener because we overwrote the HTML
                    document.getElementById('image').addEventListener('change', arguments.callee);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>