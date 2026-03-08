<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsuranceRequest;
use App\Models\Insurance;

class InsuranceController extends Controller
{
    /**
     * Display a listing of insurances, paginated and ordered newest first.
     */
    public function index()
    {
        $insurances = Insurance::latest()->paginate(10);
        return view('admin.Insurances.index', compact('insurances'));
    }

    /**
     * Show the form for creating a new insurance.
     */
    public function create()
    {
        return view('admin.Insurances.create');
    }

    /**
     * Store a newly created insurance in storage.
     */
    public function store(InsuranceRequest $request)
    {
        Insurance::create($request->validated());

        return redirect()
            ->route('admin.insurances.index')
            ->with('success', 'Aseguradora registrada correctamente.');
    }
}
