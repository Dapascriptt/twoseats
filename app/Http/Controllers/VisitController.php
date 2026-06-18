<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function home(Request $request)
    {
        $featuredVisit = Visit::with('images')->latest('visit_date')->first();
        $totalCount    = Visit::count();

        return view('home', compact('featuredVisit', 'totalCount'));
    }

    public function explore(Request $request)
    {
        $query = Visit::with('images')->latest('visit_date');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $visits = $query->get();

        return view('explore', compact('visits'));
    }

    public function show(Visit $visit)
    {
        $visit->load('images');
        return view('visits.show', compact('visit'));
    }
}
