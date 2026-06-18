@extends('layouts.admin')

@section('title', 'Tambah Kunjungan')

@section('content')

<div class="max-w-2xl">
    <div class="mb-8">
        <h1 class="text-xl font-semibold text-gray-900">Tambah Kunjungan</h1>
        <p class="text-sm text-gray-400 mt-0.5">Tambahkan kenangan baru.</p>
    </div>

    <form method="POST" action="{{ route('admin.visits.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @include('admin.visits._form')

        <div class="flex items-center gap-3 pt-2">
            <button type="submit"
                    class="px-6 py-2.5 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary/90 transition-colors">
                Simpan
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
