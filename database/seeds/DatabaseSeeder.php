<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')
        ->insert(['name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin']);
    }
}
