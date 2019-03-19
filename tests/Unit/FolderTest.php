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
     * Test if can show a resource.
     *
     * @return void
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
     * Test if can show a collection.
     *
     * @return void
     */

    public function test_can_list_folder() 
    {
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
     * Test if can store a resource.
     *
     * @return void
     */

    public function test_can_store_folder() {
        $data = [
            'title' => $this->faker->streetName,
            'user_id' => User::all(['id'])->random()
        ];
        $this->post(route('category.store'), $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [ 
                    'type', 'id', 
                    'attributes' => [
                        'title'
                    ], 
                    'relationships' => [
                        'type' => [
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
     * Test if can update a resource.
     *
     * @return void
     */

    public function test_can_update_category() {
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
                        'type' => [
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
     * Test if can update a resource.
     *
     * @return void
     */

    public function test_can_delete_category() {
        $folder = factory(Folder::class)->create();
        $this->put(route('folder.delete', $folder->id))
            ->assertStatus(204);
    }

    /**
     * Test if can show a relationship resource.
     *
     * @return void
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
     * Test if can show a relationship resource.
     *
     * @return void
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
        $folder = factory(Folder::class)->create();
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
