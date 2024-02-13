<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $baseQuery = Office::query();

        if($request->search) {
            $baseQuery->where('office_name', 'LIKE', "%$request->search%");
        }

        if(is_array($request->classifications)) {
            // $baseQuery->where('classification', 'LIKE', "%$request->classification%");
            $baseQuery->whereIn('classification', $request->classifications);
        }

        $offices = $baseQuery->get();

        return inertia('Office/Index', [
            'offices' => $offices,
            'filters' => $request->only(['search', 'classifications'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Office $office)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        //
    }
}
