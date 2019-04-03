<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Folder;
use App\Models\User;

class FolderTest extends TestCase
{
    /**
     * @covers App\Http\Controllers\Api\Folder\FolderController::show
     */

    public function test_can_show_folder()
    {
        $folder = factory(Folder::class)->create();
        $this->get(route('folder.show', $folder->id))
        ->assertStatus(200)
        ->assertJson([ 'data' => ['id' => (string)$folder->id]])
        ->assertJsonStructure([
            'data' => [ 
                'type', 'id', 
                'attributes' => [
                    'title'
                ], 
                'relationships' => [
                    'user' => [
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
     * @covers App\Http\Controllers\Api\Folder\FolderController::index
     */

    public function test_can_list_folder() 
    {
        factory(Folder::class, 2)->create();
        $this->get(route('folder.index'))
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [ 
                [
                    'type', 'id', 
                    'attributes' => [
                        'title'
                    ], 
                    'relationships' => [
                        'user' => [
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
     * @covers App\Http\Controllers\Api\Folder\FolderController::store
     */

    public function test_can_store_folder() {
        $data = [
            'title' => $this->faker->streetName,
            'user_id' => User::all(['id'])->random()
        ];
        $this->post(route('folder.store'), $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [ 
                    'type', 'id', 
                    'attributes' => [
                        'title'
                    ], 
                    'relationships' => [
                        'user' => [
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
     * @covers App\Http\Controllers\Api\Folder\FolderController::update
     */

    public function test_can_update_folder() {
        $folder = factory(Folder::class)->create();
        $data = [
            'title' => $this->faker->streetName,
        ];
        $this->put(route('folder.update', $folder->id), $data)
            ->assertStatus(200)
            ->assertJson([ 'data' => ['id' => (string)$folder->id]])
            ->assertJsonStructure([
                'data' => [ 
                    'type', 'id', 
                    'attributes' => [
                        'title'
                    ], 
                    'relationships' => [
                        'user' => [
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
     * @covers App\Http\Controllers\Api\Folder\FolderController::delete
     */

    public function test_can_delete_folder() {
        $folder = factory(Folder::class)->create();
        $this->delete(route('folder.destroy', $folder->id))
            ->assertStatus(204);
    }

    /**
     * @covers App\Http\Controllers\Api\Folder\FolderRelationshipController::user
     */

    public function test_can_show_folder_user()
    {
        $folder = factory(Folder::class)->create();
        $this->get(route('folder.user', $folder->id))
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => []
        ]);
    }

    /**
     * @covers App\Http\Controllers\Api\Folder\FolderRelationshipController::files
     */

    public function test_can_show_folder_files()
    {
        $folder = factory(Folder::class)->create();
        $this->get(route('folder.files', $folder->id))
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

    public function test_cant_list_folder() {
        $user = factory(User::class)->create();
        $user->admin = 0;
        $user->save();
        $this->actingAs($user, 'api');
        factory(Folder::class)->create();
        $this->get(route('folder.index'))
        ->assertStatus(403);
    }

    public function test_cant_show_folder() {
        $user = factory(User::class)->create();
        $user->admin = 0;
        $user->save();
        $this->actingAs($user, 'api');
        $folder = factory(Folder::class)->create();
        $folder->user_id = $user->id + 1;
        $folder->save();
        $this->get(route('folder.show', $folder->id))
        ->assertStatus(403);
    }
}
