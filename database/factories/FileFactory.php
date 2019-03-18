<?php

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\FileType;

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

$factory->define(App\Models\File::class, function (Faker $faker) {
    return [
        'url' => bcrypt($faker->domainName),
        'user_id' => User::all(['id'])->random(),
        'file_type_id' => FileType::all(['id'])->random(),
    ];
});
