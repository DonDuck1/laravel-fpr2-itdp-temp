<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $this->authorize('create', User::class);
        $organisations = Organisation::orderBy('id', 'asc')->get();
        $roles = Role::orderBy('id', 'asc')->get();

        return view('auth.register', compact('organisations', 'roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        $selectedOrganisation = Organisation::where('name', '=', $request->organisation)->get()->first();
        $selectedRole = Role::where('name', '=', $request->role)->get()->first();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'organisation' => ['required'],
            'role' => ['required', Rule::notIn([Role::where('id', '=', Role::IS_ADMIN)->get()->first()->name]),],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'organisation_id' => $selectedOrganisation->id,
            'role_id' => $selectedRole->id,
        ]);

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
