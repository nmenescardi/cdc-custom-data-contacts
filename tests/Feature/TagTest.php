<?php

namespace Tests\Feature;

use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    protected $authUser;
    protected $actAs;

    public function setup(): void
    {
        parent::setUp();
        $this->authUser = factory(User::class)->create();
        $this->actAs = $this->actingAs($this->authUser, 'web');
    }


    public function test_a_single_tag_can_be_added()
    {
        $tag_list = ['SomeTag'];

        $this->actAs->post(route('tags.store'), ['tag_list' => $tag_list]);

        $this->assertCount(1, Tag::all());
    }

    public function test_multiple_tags_can_be_added()
    {
        $tag_list = ['SomeTag', 'SomeTag2', 'SomeTag3'];

        $this->actAs->post(route('tags.store'), ['tag_list' => $tag_list]);

        $this->assertCount(3, Tag::all());
    }

    public function test_tag_name_is_unique()
    {
        $tag_list = ['SomeTag'];

        $this->actAs->post(route('tags.store'), ['tag_list' => $tag_list]);

        $this->assertCount(1, Tag::all());


        $tag_list = ['SomeTag'];

        $this->actAs->post(route('tags.store'), ['tag_list' => $tag_list]);

        $this->assertCount(1, Tag::all());
    }

    public function test_tag_name_is_updated()
    {
        $tag_list = ['SomeTag'];

        $this->actAs->post(route('tags.store'), ['tag_list' => $tag_list]);

        $tag = Tag::first();

        $this->actAs->patch(route('tags.update', $tag->id), ['name' => 'New Name']);

        $this->assertEquals('New Name', $tag->fresh()->name);
    }

    public function test_tag_name_is_unique_when_updating()
    {
        $tag_list = ['First Tag', 'Unique Tag Name'];

        $this->actAs->post(route('tags.store'), ['tag_list' => $tag_list]);

        $tag = Tag::first();

        $response = $this->actAs->patch(route('tags.update', $tag->id), ['name' => 'Unique Tag Name']);

        $response->assertSessionHasErrors('name');
    }


    //TODO: Update

    //TODO: Delete


}
