<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Organisation;
use App\Models\Role;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
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
        $this->authorize('viewAny', Department::class);
        $organisations = Organisation::orderBy('id', 'asc')->get();
        $departments = Department::orderBy('id', 'asc')->get();

        return view('departments.index', compact('departments', 'organisations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Department::class);

        $organisations = Organisation::orderBy('id', 'asc')->get();

        return view('departments.create', compact('organisations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Department::class);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['required', 'boolean'],
            'organisation' => ['required']
        ]);

        $selectedOrganisation = Organisation::where('name', '=', $request->organisation)->get()->first();

        Department::create([
            'name' => $request->name,
            'active' => $request->active,
            'organisation_id' => $selectedOrganisation->id,
        ]);

        if(auth()->user()->role_id === Role::IS_ADMIN) {
            return redirect(route('departments.index'));
        } else if(auth()->user()->role_id === Role::IS_MANAGER) {
            return redirect(route('organisations.show', auth()->user()->organisation_id));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $organisation = Organisation::where('id', '=', $department->organisation_id)->first();

        return view('departments.show', compact('department', 'organisation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $this->authorize('update', $department);

        $organisations = Organisation::orderBy('id', 'asc')->get();

        return view('departments.edit', compact('department', 'organisations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $this->authorize('update', $department);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'active' => ['required', 'boolean'],
            'organisation' => ['required']
        ]);

        $selectedOrganisation = Organisation::where('name', '=', $request->organisation)->get()->first();

        $department->update([
            'name' => $request->name,
            'active' => $request->active,
            'organisation_id' => $selectedOrganisation->id,
        ]);

        return redirect(route('departments.show', $department->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);

        $department->delete();

        if(auth()->user()->role_id === Role::IS_ADMIN) {
            return redirect(route('departments.index'));
        } else if(auth()->user()->role_id === Role::IS_MANAGER) {
            return redirect(route('organisations.show', auth()->user()->organisation_id));
        }
    }
}
