<?php

namespace Database\Seeders;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organisation::create(
            [
                'name' => "John's Space Agency",
                'active' => true,
            ]
        );
        Organisation::create(
            [
                'name' => "Jane's Commercial Space Flights",
                'active' => true,
            ]
        );
    }
}
