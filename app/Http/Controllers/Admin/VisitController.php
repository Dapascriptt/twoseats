<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Models\VisitImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::with('images')->withCount('images')->latest('visit_date')->get();
        return view('admin.visits.index', compact('visits'));
    }

    public function create()
    {
        return view('admin.visits.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'location'       => ['required', 'string', 'max:255'],
            'story'          => ['required', 'string'],
            'visit_date'     => ['required', 'date'],
            'gmaps_link'     => ['nullable', 'url'],
            'instagram_link' => ['nullable', 'url'],
            'images.*'       => ['nullable', 'image', 'max:4096'],
        ]);

        $data['slug'] = $this->uniqueSlug($request->title);

        $visit = Visit::create($data);

        $this->storeImages($request, $visit);

        return redirect()->route('admin.visits.index')->with('success', 'Kunjungan berhasil ditambahkan.');
    }

    public function show(Visit $visit)
    {
        return redirect()->route('visit.show', $visit);
    }

    public function edit(Visit $visit)
    {
        $visit->load('images');
        return view('admin.visits.edit', compact('visit'));
    }

    public function update(Request $request, Visit $visit)
    {
        $data = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'location'       => ['required', 'string', 'max:255'],
            'story'          => ['required', 'string'],
            'visit_date'     => ['required', 'date'],
            'gmaps_link'     => ['nullable', 'url'],
            'instagram_link' => ['nullable', 'url'],
            'images.*'       => ['nullable', 'image', 'max:4096'],
        ]);

        if ($visit->title !== $request->title) {
            $data['slug'] = $this->uniqueSlug($request->title, $visit->id);
        }

        $visit->update($data);

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = VisitImage::find($imageId);
                if ($image && $image->visit_id === $visit->id) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        $this->storeImages($request, $visit);

        return redirect()->route('admin.visits.index')->with('success', 'Kunjungan berhasil diperbarui.');
    }

    public function destroy(Visit $visit)
    {
        foreach ($visit->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $visit->delete();

        return redirect()->route('admin.visits.index')->with('success', 'Kunjungan berhasil dihapus.');
    }

    private function storeImages(Request $request, Visit $visit): void
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('visits', 'public');
                $visit->images()->create(['image_path' => $path]);
            }
        }
    }

    private function uniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);
        $base = $slug;
        $i = 1;

        while (
            Visit::where('slug', $slug)
                ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
