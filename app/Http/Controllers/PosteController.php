<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use App\Http\Requests\StorePosteRequest;
use App\Http\Requests\UpdatePosteRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PosteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Postes/Index', ['postes' => Poste::selectRaw('id, name, title, description, level')->withCount('employers')->paginate($request->number_items ?? 5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return Inertia::render('Postes/Create', ['poste' => ['grade_id' => $request->grade]]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePosteRequest $request)
    {
        $poste = new Poste();
        $poste->title = $request->title;
        $poste->level = $request->level;
        $poste->name = $request->name;
        $poste->description = $request->description;
        $poste->grade_id = $request->grade_id;
        $poste->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(Poste $poste)
    {
        $poste = Poste::with(['grade', 'employers'=> function($employer) {
            $employer->selectRaw('employers.id, employers.poste_id, employers.name, matricule, birthday as birthday_full, joined_at as age_work');
        }])->find($poste->id);
        return Inertia::render('Postes/Show', ['poste' => $poste]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poste $poste)
    {
        return Inertia::render('Postes/Edit', ['poste' => $poste]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePosteRequest $request, Poste $poste)
    {
        $poste->title = $request->title;
        $poste->level = $request->level;
        $poste->name = $request->name;
        $poste->description = $request->description;
        $poste->grade_id = $request->grade_id;
        $poste->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poste $poste)
    {
        $poste->delete();
    }
    public function api_index()
    {
        return response()->json(Poste::select('id', 'name', 'title')->get());
    }
}
