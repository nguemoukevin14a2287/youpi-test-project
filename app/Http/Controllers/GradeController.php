<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Grades/Index', ['grades' => Grade::selectRaw('id, name, title, description, level')->paginate($request->number_items ?? 5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Grades/Create', ['grade' => new Grade()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request)
    {
        $grade = new Grade();
        $grade->title = $request->title;
        $grade->level = $request->level;
        $grade->name = $request->name;
        $grade->description = $request->description;
        $grade->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        $grade = Grade::with(['postes'=> function($poste) {
            $poste->withCount('employers')
                ->selectRaw('postes.id, grade_id, postes.name, postes.title');
        }])->withCount('postes')->find($grade->id);
        $grade->append('employers');
        return Inertia::render('Grades/Show', ['grade' => $grade]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        return Inertia::render('Grades/Edit', ['grade' => $grade]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        //
        $grade->title = $request->title;
        $grade->level = $request->level;
        $grade->name = $request->name;
        $grade->description = $request->description;
        $grade->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
    }
}
