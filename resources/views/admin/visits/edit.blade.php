@extends('layouts.admin')

@section('title', 'Edit Kunjungan')

@section('content')

<div class="max-w-2xl">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">Edit Kunjungan</h1>
            <p class="text-sm text-gray-400 mt-0.5">{{ $visit->title }}</p>
        </div>
        <a href="{{ route('visit.show', $visit) }}" target="_blank"
           class="text-sm text-gray-400 hover:text-primary transition-colors">
            Lihat halaman →
        </a>
    </div>

    <form method="POST" action="{{ route('admin.visits.update', $visit) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        @include('admin.visits._form')

        {{-- Existing images --}}
        @if($visit->images->isNotEmpty())
        <div>
            <label class="block text-xs font-medium text-gray-600 mb-3">Foto yang sudah ada</label>
            <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                @foreach($visit->images as $image)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $image->image_path) }}"
                         class="w-full aspect-square object-cover rounded-xl">
                    <label class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"
                               class="sr-only peer">
                        <span class="text-white text-xs font-medium peer-checked:hidden">Hapus</span>
                        <span class="text-red-400 text-xs font-medium hidden peer-checked:block">✓ Dihapus</span>
                    </label>
                </div>
                @endforeach
            </div>
            <p class="text-xs text-gray-400 mt-2">Hover foto dan centang untuk menghapus.</p>
        </div>
        @endif

        <div class="flex items-center gap-3 pt-2">
            <button type="submit"
                    class="px-6 py-2.5 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary/90 transition-colors">
                Perbarui
            </button>
            <a href="{{ route('admin.visits.index') }}"
               class="px-6 py-2.5 bg-gray-100 text-gray-600 text-sm font-medium rounded-xl hover:bg-gray-200 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
@include('admin.visits._image-preview-script')
@endpush
