@extends('layouts.admin')

@section('title', 'Semua Kunjungan')

@section('content')

<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-xl font-semibold text-gray-900">Kunjungan</h1>
        <p class="text-sm text-gray-400 mt-0.5">{{ $visits->count() }} kunjungan tersimpan</p>
    </div>
    <a href="{{ route('admin.visits.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary/90 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah
    </a>
</div>

@if($visits->isEmpty())
<div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
    <p class="font-serif italic text-gray-400">Belum ada kunjungan.</p>
    <a href="{{ route('admin.visits.create') }}" class="inline-block mt-3 text-sm text-primary hover:underline">
        Tambah sekarang →
    </a>
</div>
@else
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-100">
                <th class="text-left px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider">Tempat</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider hidden sm:table-cell">Lokasi</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider hidden md:table-cell">Tanggal</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-gray-400 uppercase tracking-wider hidden md:table-cell">Foto</th>
                <th class="px-6 py-4"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($visits as $visit)
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($visit->images_count > 0)
                        <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                            <img src="{{ asset('storage/' . $visit->images->first()?->image_path) }}"
                                 class="w-full h-full object-cover">
                        </div>
                        @else
                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @endif
                        <div>
                            <p class="font-medium text-gray-900">{{ $visit->title }}</p>
                            <p class="text-xs text-gray-400 font-mono">{{ $visit->slug }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500 hidden sm:table-cell">{{ $visit->location }}</td>
                <td class="px-6 py-4 text-gray-500 hidden md:table-cell">
                    {{ $visit->visit_date->format('d M Y') }}
                </td>
                <td class="px-6 py-4 text-gray-500 hidden md:table-cell">
                    {{ $visit->images_count }} foto
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('visit.show', $visit) }}" target="_blank"
                           class="p-2 text-gray-400 hover:text-gray-700 transition-colors" title="Lihat">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>
                        <a href="{{ route('admin.visits.edit', $visit) }}"
                           class="p-2 text-gray-400 hover:text-primary transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('admin.visits.destroy', $visit) }}"
                              onsubmit="return confirm('Hapus kunjungan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-500 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection
