<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\FileType;
use App\Models\File;
use App\Models\User;

class FileTest extends TestCase
{
    /**
     * Test if can show a resource.
     *
     * @return void
     */

    public function test_can_show_file()
    {
        $file = factory(File::class)->create();
        $this->get(route('file.show', $file->id))
        ->assertStatus(200)
        ->assertJson([ 'data' => ['id' => (string)$file->id]])
        ->assertJsonStructure([
            'data' => [ 
                'type', 'id', 
                'attributes' => [
                    'url'
                ], 
                'relationships' => [
                    'user' => [
                        'links' => [
                            'self', 'related'
                        ],
                        'data' => []
                    ],
                    'type' => [
                        'links' => [
                            'self', 'related'
                        ],
                        'data' => []
                    ]
                    ,
                    'folders' => [
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

    public function test_can_list_file() 
    {
        factory(File::class, 2)->create();
        $this->get(route('file.index'))
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [ 
                [
                    'type', 'id', 
                    'attributes' => [
                        'url'
                    ], 
                    'relationships' => [
                        'user' => [
                            'links' => [
                                'self', 'related'
                            ],
                            'data' => []
                        ],
                        'type' => [
                            'links' => [
                                'self', 'related'
                            ],
                            'data' => []
                        ]
                        ,
                        'folders' => [
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

    public function test_can_store_files() {
        Storage::fake('avatars');
        $fileInput = UploadedFile::fake()->image('avatar.jpg');
        $data = [
            'file_input' => $fileInput,
            'user_id' => User::all(['id'])->random(),
            'file_type_id' => FileType::all(['id'])->random(),
        ];
        $this->post(route('file.store'), $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [ 
                    'type', 'id', 
                    'attributes' => [
                        'url'
                    ], 
                    'relationships' => [
                        'user' => [
                            'links' => [
                                'self', 'related'
                            ],
                            'data' => []
                        ],
                        'type' => [
                            'links' => [
                                'self', 'related'
                            ],
                            'data' => []
                        ]
                        ,
                        'folders' => [
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

    public function test_can_update_folder() {
        $file = factory(File::class)->create();
        $data = [
            'url' => encrypt($this->faker->domainName),
        ];
        $this->put(route('file.update', $file->id), $data)
            ->assertStatus(200)
            ->assertJson([ 'data' => ['id' => (string)$file->id]])
            ->assertJsonStructure([
                'data' => [ 
                    'type', 'id', 
                    'attributes' => [
                        'url'
                    ], 
                    'relationships' => [
                        'user' => [
                            'links' => [
                                'self', 'related'
                            ],
                            'data' => []
                        ],
                        'type' => [
                            'links' => [
                                'self', 'related'
                            ],
                            'data' => []
                        ]
                        ,
                        'folders' => [
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
     * Test if can delete a resource.
     *
     * @return void
     */

    public function test_can_delete_file() {
        Storage::fake('avatars');
        $fileInput = UploadedFile::fake()->image('avatar.jpg');
        $data = [
            'id' => 357,
            'file_input' => $fileInput,
            'user_id' => User::all(['id'])->random(),
            'file_type_id' => FileType::all(['id'])->random(),
        ];
        $this->post(route('file.store'), $data);
        $file = File::all()->last();
        $this->delete(route('file.destroy', $file->id))
            ->assertStatus(204);
    }

    /**
     * Test if can show a relationship resource.
     *
     * @return void
     */

    public function test_can_show_file_user()
    {
        $file = factory(File::class)->create();
        $this->get(route('file.user', $file->id))
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

    public function test_can_show_file_type()
    {
        $file = factory(File::class)->create();
        $this->get(route('file.type', $file->id))
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

    public function test_can_show_file_folders()
    {
        $file = factory(File::class)->create();
        $this->get(route('file.folders', $file->id))
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

    public function test_cant_list_file() {
        $user = factory(User::class)->create();
        $user->admin = 0;
        $user->save();
        $this->actingAs($user, 'api');
        factory(File::class)->create();
        $this->get(route('file.index'))
        ->assertStatus(403);
    }

    public function test_cant_show_file() {
        $user = factory(User::class)->create();
        $user->admin = 0;
        $user->save();
        $this->actingAs($user, 'api');
        $file = factory(File::class)->create();
        $file->user_id = $user->id + 1;
        $file->save();
        $this->get(route('file.show', $file->id))
        ->assertStatus(403);
    }
}
