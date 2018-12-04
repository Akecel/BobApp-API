<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Axel Rayer",
            'email' => "admin@admin.com",
            'password' => "password",
            'admin' => true,
        ]);
    }
}
