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
     * @covers App\Http\Controllers\Api\FolderCategory\FolderCategoryController::show
     */

    public function test_can_show_categroy()
    {
        $category = FolderCategory::all(['id'])->random();
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
     * @covers App\Http\Controllers\Api\FolderCategory\FolderCategoryController::index
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
     * @covers App\Http\Controllers\Api\FolderCategory\FolderCategoryController::update
     */

    public function test_can_update_category() {
        $category = FolderCategory::all(['id'])->random();
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
     * @covers App\Http\Controllers\Api\FolderCategory\FolderCategoryRelationshipController::type
     */

    public function test_can_show_categroy_type()
    {
        $category = FolderCategory::all(['id'])->random();
        $this->get(route('category.types', $category->id))
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

    public function test_cant_update_category() {
        $user = factory(User::class)->create();
        $user->admin = 0;
        $user->save();
        $this->actingAs($user, 'api');
        $category = FolderCategory::all(['id'])->random();
        $data = [
            'title' => 'Test Title',
            'description' => 'This is a description test',
            'extended_description' => 'This is a longer description test because if for the extended description'
        ];
        $this->put(route('category.update', $category->id), $data)
            ->assertStatus(403);
    }
}
