<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * Test to show auth user resource.
     *
     * @return void
     */

    public function test_can_show_auth_user()
    {
        $this->get(route('auth.user'))
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [ 
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
     * Test to logout user.
     *
     * @return void
     */

    public function test_can_logout()
    {
        $this->get(route('auth.logout'))
        ->assertStatus(204);
    }
}
