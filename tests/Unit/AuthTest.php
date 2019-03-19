<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * Test if can auth from mobile.
     *
     * @return void
     */

    public function test_can_auth_mobile()
    {
        $data = [
            'phone_num' => $this->faker->unique()->e164PhoneNumber,
        ];
        $token = $this->post(route('validation'), $data);

        $data = [
            'token' => $token,
        ];
        $token = $this->post(route('login'), $data)
        ->assertStatus(200)
        ->assertJson(['token'])
        ->assertJsonStructure([
            'token',
            'user' => [
                'type', 'id', 
                'attributes' => [
                    'phone_number', 'email', 'firstName', 'lastName', 'birthdate', 'address', 'postal_code', 'city', 'country'
                ], 
                'relationships' => [
                    'folders' => [
                        'links' => [
                            'self', 'related'
                        ],
                        'data' => []
                    ],
                    'files' => [
                        'links' => [
                            'self', 'related'
                        ],
                        'data' => []
                    ]
                ],
                'links' => ['self']
            ]
        ]);

    }

    /**
    * Test if can auth from backoffice.
    *
    * @return void
    */

   public function test_can_auth_mail()
   {
    $user = factory(User::class)->create();
    $data = [
        'email' => $user->email,
        'password' => $user->password
    ];
    $token = $this->post(route('signin'), $data)
    ->assertStatus(200)
    ->assertJson(['token']);
   }

    /*
    |--------------------------------------------------------------------------
    | Security Test
    |--------------------------------------------------------------------------
    */

    /**
    * Test passport.
    *
    * @return void
    */

   public function test_cant_request()
   {
    $this->actingAs(factory(User::class)->create(),['']);
    $this->get(route('user.index'))
    ->assertStatus(403);
   }

    /**
    * Test if cant auth from backoffice if not admin.
    *
    * @return void
    */

    public function test_cant_auth_mail()
    {
        $user = factory(User::class)->create();
        $user->admin = 0;
        $user->save();
        $this->actingAs($user, 'api');
     $data = [
         'email' => $user->email,
         'password' => $user->password
     ];
     $token = $this->post(route('signin'), $data)
     ->assertStatus(403);
    }

}
