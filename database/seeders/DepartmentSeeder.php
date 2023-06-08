<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Organisation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create(
            [
                'name' => "John's Rocket R&D",
                'active' => true,
                'organisation_id' => Organisation::where('name', '=', "John's Space Agency")->first()->id,
            ]
        );
        Department::create(
            [
                'name' => "Jane's Spicy Engines",
                'active' => true,
                'organisation_id' => Organisation::where('name', '=', "Jane's Commercial Space Flights")->first()->id,
            ]
        );
        Department::create(
            [
                'name' => "John's Astronaut Training",
                'active' => true,
                'organisation_id' => Organisation::where('name', '=', "John's Space Agency")->first()->id,
            ]
        );
        Department::create(
            [
                'name' => "John's Alien Observers",
                'active' => true,
                'organisation_id' => Organisation::where('name', '=', "John's Space Agency")->first()->id,
            ]
        );
        Department::create(
            [
                'name' => "Jane's Safety Videos",
                'active' => true,
                'organisation_id' => Organisation::where('name', '=', "Jane's Commercial Space Flights")->first()->id,
            ]
        );
    }
}
