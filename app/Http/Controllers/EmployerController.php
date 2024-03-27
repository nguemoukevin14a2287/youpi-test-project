<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employers = Employer::select('id', 'name', 'salary', 'image', 'image as image_path', 'poste_id', 'poste_id as poste_name', 'sexe as sexe_full', 'matricule')
            ->paginate($request->number_items ?? 10);
        return Inertia::render('Employers/Index', ['employers' => $employers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return Inertia::render('Employers/Create', ['employer' => ['poste_id' => $request->poste]]);
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
        $employer->poste_id = $request->poste_id;
        $employer->civility = $request->civility;
        $employer->strengths = $request->strengths;
        $employer->joined_at = $request->joined_at;
        $employer->matricule = $request->matricule ?? Str::random(7);
        if($image = $request->file('image')){
            $path = $image->store('public/images/employers');
            $employer->image = str_replace('public/images/employers', '', $path);
        }
        $employer->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Employer $employer)
    {
        $employer = Employer::with('poste')->selectRaw('employers.*, joined_at as joined_at_full, name as name_full, image as image_path, birthday as age, birthday as birthday_full, sexe as sexe_full, joined_at as age_work')->find($employer->id);
        $employer->append('grade');
        return Inertia::render('Employers/Show', ['employer' => $employer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employer $employer)
    {
        $employer = Employer::select('employers.*', 'image as image_path')->find($employer->id);
        return Inertia::render('Employers/Edit', ['employer' => $employer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployerRequest $request, Employer $employer)
    {
        $employer->name = $request->name;
        $employer->birthday = $request->birthday;
        $employer->salary = $request->salary;
        $employer->address = $request->address;
        $employer->sexe = $request->sexe;
        $employer->civility = $request->civility;
        $employer->strengths = $request->strengths;
        $employer->joined_at = $request->joined_at;
        $employer->matricule = $request->matricule;
        $employer->poste_id = $request->poste_id;
        if($image = $request->file('image')){
            if($employer->image) {
                Storage::delete('public/images/employers/' . $employer->image);
            }
            $path = $image->store('public/images/employers');
            $employer->image = str_replace('public/images/employers', '', $path);
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
