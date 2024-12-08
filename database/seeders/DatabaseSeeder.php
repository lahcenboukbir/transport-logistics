<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UsersTableSeeder::class);

        Customization::insert([
            [
                'name' => 'logo',
                'value' => '',
            ],
            [
                'name' => 'logo_sm',
                'value' => '',
            ],
            [
                'name' => 'site_name',
                'value' => ''
            ]
        ]);
    }
}
