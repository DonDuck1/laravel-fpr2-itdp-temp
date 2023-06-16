<?php

namespace Database\Seeders;

use App\Models\Organisation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Beheerder',
                'email' => 'beheerder@beheerder.com',
                'password' => Hash::make('DonaldDuck1234!'),
                'organisation_id' => null,
                'role_id' => Role::IS_ADMIN,
            ]
        );
        User::create(
            [
                'name' => 'John',
                'email' => 'john@john.com',
                'password' => Hash::make('1234'),
                'organisation_id' => Organisation::where('name', '=', "John's Space Agency")->first()->id,
                'role_id' => Role::IS_MANAGER,
            ]
        );
        User::create(
            [
                'name' => 'Jane',
                'email' => 'jane@jane.com',
                'password' => Hash::make('1234'),
                'organisation_id' => Organisation::where('name', '=', "Jane's Commercial Space Flights")->first()->id,
                'role_id' => Role::IS_MANAGER,
            ]
        );
        User::create(
            [
                'name' => 'John Jr.',
                'email' => 'johnjr@john.com',
                'password' => Hash::make('1234'),
                'organisation_id' => Organisation::where('name', '=', "John's Space Agency")->first()->id,
                'role_id' => Role::IS_USER,
            ]
        );
        User::create(
            [
                'name' => 'Jane Jr.',
                'email' => 'janejr@jane.com',
                'password' => Hash::make('1234'),
                'organisation_id' => Organisation::where('name', '=', "Jane's Commercial Space Flights")->first()->id,
                'role_id' => Role::IS_USER,
            ]
        );
    }
}
