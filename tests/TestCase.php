<?php

namespace Tests;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use App\Models\User;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $faker;
    public function setUp() {
        parent::setUp();
        $this->faker = Factory::create();
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');
    }
}
