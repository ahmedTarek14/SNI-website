<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Modules\Auth\Models\Admin;

class AuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@sni.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('gz3uvN3O7@7@'),
        ]);
    }
}
