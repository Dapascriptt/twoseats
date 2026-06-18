@php $v = $visit ?? null; @endphp

@if($errors->any())
<div class="px-4 py-3 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm">
    <ul class="list-disc list-inside space-y-0.5">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Title --}}
<div>
    <label class="block text-xs font-medium text-gray-600 mb-1.5">Nama Tempat <span class="text-red-400">*</span></label>
    <input type="text" name="title" value="{{ old('title', $v?->title) }}" required
           placeholder="Mis: Almanac Coffee"
           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors @error('title') border-red-300 @enderror">
</div>

{{-- Location --}}
<div>
    <label class="block text-xs font-medium text-gray-600 mb-1.5">Lokasi <span class="text-red-400">*</span></label>
    <input type="text" name="location" value="{{ old('location', $v?->location) }}" required
           placeholder="Mis: Bandung, Jawa Barat"
           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors @error('location') border-red-300 @enderror">
</div>

{{-- Visit Date --}}
<div>
    <label class="block text-xs font-medium text-gray-600 mb-1.5">Tanggal Kunjungan <span class="text-red-400">*</span></label>
    <input type="date" name="visit_date" value="{{ old('visit_date', $v?->visit_date?->format('Y-m-d')) }}" required
           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors @error('visit_date') border-red-300 @enderror">
</div>

{{-- Story --}}
<div>
    <label class="block text-xs font-medium text-gray-600 mb-1.5">Cerita <span class="text-red-400">*</span></label>
    <textarea name="story" rows="7" required
              placeholder="Tulis kenangan dari kunjungan ini..."
              class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors resize-none leading-relaxed @error('story') border-red-300 @enderror">{{ old('story', $v?->story) }}</textarea>
</div>

{{-- External Links --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1.5">Link Google Maps</label>
        <input type="url" name="gmaps_link" value="{{ old('gmaps_link', $v?->gmaps_link) }}"
               placeholder="https://maps.google.com/..."
               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors @error('gmaps_link') border-red-300 @enderror">
    </div>
    <div>
        <label class="block text-xs font-medium text-gray-600 mb-1.5">Link Instagram</label>
        <input type="url" name="instagram_link" value="{{ old('instagram_link', $v?->instagram_link) }}"
               placeholder="https://instagram.com/..."
               class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors @error('instagram_link') border-red-300 @enderror">
    </div>
</div>

{{-- Images --}}
<div>
    <label class="block text-xs font-medium text-gray-600 mb-1.5">
        Upload Foto {{ $v ? '(opsional — tambah foto baru)' : '' }}
    </label>
    <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-primary/40 transition-colors cursor-pointer"
         onclick="document.getElementById('images').click()">
        <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
        </svg>
        <p class="text-sm text-gray-500">Klik untuk pilih foto</p>
        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP — max 4MB per foto</p>
        <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden" onchange="previewImages(this)">
    </div>

    {{-- Preview area --}}
    <div id="image-preview" class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-3 hidden"></div>
</div>
