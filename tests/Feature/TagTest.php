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

    //TODO: store multiple tags.


    //TODO: name is required

    //TODO: name is unique


    //TODO: Update

    //TODO: Delete


}
