<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganisationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Organisation::class);
        $organisations = Organisation::orderBy('id', 'asc')->get();

        return view('organisations.index', compact('organisations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Organisation::class);

        return view('organisations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Organisation::class);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['required', 'boolean'],
        ]);

        Organisation::create([
            'name' => $request->name,
            'active' => $request->active,
        ]);

        return redirect(route('organisations.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Organisation $organisation)
    {
        $this->authorize('view', $organisation);
        $departments = DB::table('departments')->where('organisation_id', $organisation->id)->get();

        return view('organisations.show', compact('organisation', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organisation $organisation)
    {
        $this->authorize('update', $organisation);

        return view('organisations.edit', compact('organisation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organisation $organisation)
    {
        $this->authorize('update', $organisation);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['required', 'boolean'],
        ]);

        $organisation->update([
            'name' => $request->name,
            'active' => $request->active,
        ]);

        return redirect(route('organisations.show', $organisation->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organisation $organisation)
    {
        $this->authorize('delete', $organisation);

        $organisation->delete();

        return redirect(route('organisations.index'));
    }
}
