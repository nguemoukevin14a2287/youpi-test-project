<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Employers/Index', ['employers' => Employer::select('id', 'name', 'salary')->paginate($request->number_items ?? 10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Employers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployerRequest $request)
    {
        $employer = new Employer();
        $employer->name = $request->name;
        $employer->birthday = $request->birthday;
        $employer->salary = $request->salary;
        $employer->address = $request->address;
        $employer->sexe = $request->sexe;
        $employer->strengths = $request->strengths;
        $employer->joined_at = $request->joined_at;
        $employer->matricule = Str::random(5);
        if($image = $request->file('image')){
            $path = $image->storeAs('images', $employer->matricule);
            $employer->image = $path;
        }
        $employer->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Employer $employer)
    {
        return Inertia::render('Employers/Show', ['employer' => $employer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employer $employer)
    {
        return Inertia::render('Employers/Edit', ['employer' => $employer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployerRequest $request, Employe $employer)
    {        
        $employer = new Employer();
        $employer->name = $request->name;
        $employer->birthday = $request->birthday;
        $employer->salary = $request->salary;
        $employer->address = $request->address;
        $employer->sexe = $request->sexe;
        $employer->strengths = $request->strengths;
        $employer->joined_at = $request->joined_at;
        $employer->matricule = Str::random(5);
        if($image = $request->file('image')){
            $path = $image->storeAs('images', $employer->matricule);
            $employer->image = $path;
        }
        $employer->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employer $employer)
    {
        $employer->delete();
    }
}
