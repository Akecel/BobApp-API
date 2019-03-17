<?php

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\File;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Folder::class, function (Faker $faker) {
    return [
        'title' => $faker->streetName,
        'user_id' => User::all(['id'])->random(),
    ];
});
