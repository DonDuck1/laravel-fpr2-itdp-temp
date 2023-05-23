<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <?php
        $users = App\Models\User::get();
        $organisations = App\Models\Organisation::get();
        $departments = App\Models\Department::get();

        $user = Illuminate\Support\Facades\Auth::user();
        $organisationOfCurrentUser = App\Models\Organisation::where('id', '=', $user->organisation_id)->first();
        $departmentsOfCurrentUser = App\Models\Department::where('organisation_id', '=', $organisationOfCurrentUser->id)->get();
    ?>

    <p>User: {{ $user }}:</p>
    <p>Organisation of user: {{ $organisationOfCurrentUser }}</p>
    <p>Departments of organisation of user:</p>
    @foreach($departmentsOfCurrentUser as $department)
        <p>{{ $department }}</p>
    @endforeach
    <br>
    <br>
    <br>
    @foreach($users as $user)
        <p>{{ $user }}</p>
        <br>
    @endforeach
    <br>
    <br>
    <br>
    @foreach($organisations as $organisations)
        <p>{{ $organisations }}</p>
        <br>
    @endforeach
    <br>
    <br>
    <br>
    @foreach($departments as $department)
        <p>{{ $department }}</p>
        <br>
    @endforeach
</x-app-layout>
