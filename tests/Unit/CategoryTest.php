<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_show_categroy()
    {
        $categories = App\Models\FolderCategory::all();
        $numberOf = 0;
        foreach ($categories as $values) { $numberOf++; }
        $category = App\Models\FolderCategory::find(rand(1, $numberOf));
        $this->get(route('category.show', $category->id))
        ->assertStatus(200)
        ->assertJsonStructure([
            [ 'type', 'id', 
                'attributes' => ['title', 'icon', 'description', 'extended_description'], 
                'relationships' => ['*'],
                'links' => ['self']
            ]
        ]);
    }

    public function test_can_list_category() 
    {
        $this->get(route('category'))
        ->assertStatus(200)
        ->assertJsonStructure([
            '*' =>                 
                [ 'type', 'id', 
                'attributes' => ['title', 'icon', 'description', 'extended_description'], 
                'relationships' => ['*'],
                'links' => ['self']
            ],
            'links' => ['self']
        ]);
    }

    public function test_can_update_category() {
        $categories = App\Models\FolderCategory::all();
        $numberOf = 0;
        foreach ($categories as $values) { $numberOf++; }
        $category = App\Models\FolderCategory::find(rand(1, $numberOf));
        $data = [
            'title' => 'Test Title',
            'description' => 'This is a description test',
            'extended_description' => 'This is a longer description test because if for the extended description'
        ];
        $this->put(route('category.update', $category->id), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                [ 'type', 'id', 
                    'attributes' => ['title', 'icon', 'description', 'extended_description'], 
                    'relationships' => ['*'],
                    'links' => ['self']
                ]
            ]);
    }
}
