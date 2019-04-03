<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * @covers App\Http\Controllers\Api\Auth\AuthController::user
     */
    public function test_can_show_auth_user()
    {
        $this->get(route('auth.user'))
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [ 
                'type', 'id', 
                'attributes' => [
                    'phone_number', 'email', 'firstName', 'lastName', 'birthdate'
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

}
