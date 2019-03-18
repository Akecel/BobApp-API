<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\FolderCategory;
use App\Models\User;

class CategoryTest extends TestCase
{
    /**
     * Test if can show a resource.
     *
     * @return void
     */

    public function test_can_show_categroy()
    {
        $categories = FolderCategory::all();
        $numberOf = 0;
        foreach ($categories as $values) { $numberOf++; }
        $category = FolderCategory::find(rand(1, $numberOf));
        $this->get(route('category.show', $category->id))
        ->assertStatus(200)
        ->assertJson([ 'data' => ['id' => (string)$category->id]])
        ->assertJsonStructure([
            'data' => [ 
                'type', 'id', 
                'attributes' => [
                    'title', 'icon', 'description', 'extended_description'
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
     * Test if can show a collection.
     *
     * @return void
     */

    public function test_can_list_category() 
    {
        $this->get(route('category.index'))
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [ 
                [
                    'type', 'id', 
                    'attributes' => [
                        'title', 'icon', 'description', 'extended_description'
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
            ],
            'links' => ['self']
        ]);
    }

    /**
     * Test if can update a resource.
     *
     * @return void
     */

    public function test_can_update_category() {
        $categories = FolderCategory::all();
        $numberOf = 0;
        foreach ($categories as $values) { $numberOf++; }
        $category = FolderCategory::find(rand(1, $numberOf));
        $data = [
            'title' => 'Test Title',
            'description' => 'This is a description test',
            'extended_description' => 'This is a longer description test because if for the extended description'
        ];
        $this->put(route('category.update', $category->id), $data)
            ->assertStatus(200)
            ->assertJson([ 'data' => ['id' => (string)$category->id]])
            ->assertJsonStructure([
                'data' => [ 
                    'type', 'id', 
                    'attributes' => [
                        'title', 'icon', 'description', 'extended_description'
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
     * Test policy.
     *
     * @return void
     */

    public function test_cant_update_category() {
        $this->faker = Factory::create();
        $user = factory(User::class)->create();
        $user->admin = 0;
        $user->save();
        $this->actingAs($user, 'api');
        $categories = FolderCategory::all();
        $numberOf = 0;
        foreach ($categories as $values) { $numberOf++; }
        $category = FolderCategory::find(rand(1, $numberOf));
        $data = [
            'title' => 'Test Title',
            'description' => 'This is a description test',
            'extended_description' => 'This is a longer description test because if for the extended description'
        ];
        $this->put(route('category.update', $category->id), $data)
            ->assertStatus(401);
    }

    /**
     * Test if can show a relationship resource.
     *
     * @return void
     */

    public function test_can_show_categroy_type()
    {
        $categories = FolderCategory::all();
        $numberOf = 0;
        foreach ($categories as $values) { $numberOf++; }
        $category = FolderCategory::find(rand(1, $numberOf));
        $this->get(route('category.types', $category->id))
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [ 
                [
                    'type', 'id', 
                    'attributes' => [
                        'title'
                    ], 
                    'relationships' => [
                        'category' => [
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
}
