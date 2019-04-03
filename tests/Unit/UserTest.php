<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * @covers App\Http\Controllers\Api\User\UserController::show
     */

    public function test_can_show_user()
    {
        $user = factory(User::class)->create();
        $this->get(route('user.show', $user->id))
        ->assertStatus(200)
        ->assertJson([ 'data' => ['id' => (string)$user->id]])
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

    /**
     * @covers App\Http\Controllers\Api\User\UserController::index
     */

    public function test_can_list_user() 
    {
        factory(User::class)->create();
        $this->get(route('user.index'))
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [ 
                [
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
            ],
            'links' => ['self']
        ]);
    }

    /**
     * @covers App\Http\Controllers\Api\User\UserController::store
     */

    public function test_can_store_files() {
        $data = [
            'phone_number' => $this->faker->unique()->e164PhoneNumber,
        ];
        $this->post(route('user.store'), $data)
            ->assertStatus(201)
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

    /**
     * @covers App\Http\Controllers\Api\User\UserController::update
     */

    public function test_can_update_user() {
        $user = factory(User::class)->create();
        $data = [
            'phone_number' => $this->faker->unique()->e164PhoneNumber,
        ];
        $this->put(route('user.update', $user->id), $data)
            ->assertStatus(200)
            ->assertJson([ 'data' => ['id' => (string)$user->id]])
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

    /**
     * @covers App\Http\Controllers\Api\User\UserController::delete
     */

    public function test_can_delete_file() {
        $user = factory(User::class)->create();
        $this->delete(route('user.destroy', $user->id))
            ->assertStatus(204);
    }

    /**
     * @covers App\Http\Controllers\Api\User\UserRelationshipController::files
     */

    public function test_can_show_user_file()
    {
        $user = factory(User::class)->create();
        $this->get(route('user.folders', $user->id))
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [],
            'links' => ['self']
        ]);
    }

    /**
     * @covers App\Http\Controllers\Api\User\UserRelationshipController::folders
     */

    public function test_can_show_user_folder()
    {
        $user = factory(User::class)->create();
        $this->get(route('user.files', $user->id))
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [],
            'links' => ['self']
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Security Test
    |--------------------------------------------------------------------------
    */

    /**
     * adminManage Policy test.
     *
     * @return void
     */

    public function test_cant_list_user() {
        $user = factory(User::class)->create();
        $user->admin = 0;
        $user->save();
        $this->actingAs($user, 'api');
        $this->get(route('user.index'))
        ->assertStatus(403);
    }

    public function test_cant_show_user() {
        $user = factory(User::class)->create();
        $user->admin = 0;
        $user->save();
        $this->actingAs($user, 'api');
        $this->get(route('user.show', 1 ))
        ->assertStatus(403);
    }
}
