<?php

namespace Tests\Feature;

use App\Story;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoryTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser = factory(User::class)->create();
        $this->actAs = $this->actingAs($this->authUser, 'web');
    }

    public function test_a_story_can_be_created()
    {
        $response = $this->actAs->post(
            route('stories.store'),
            [
                'title'             => 'The Title',
                'description'       => 'Some Desc',
                'days_to_expire'    => 6,
            ]
        );

        $this->assertCount(1, Story::all());
    }

    public function test_a_title_is_required()
    {
        $response = $this->actAs->post(route('stories.store'), [
            'description' => '',
            'days_to_expire' => 6
        ]);

        $response->assertSessionHasErrors('title');

        $this->assertCount(0, Story::all());
    }

    public function test_the_description_can_be_null()
    {
        $this->actAs->post(
            route('stories.store'),
            [
                'title'  => 'Some Title',
                'days_to_expire' => 7
            ]
        );

        $this->assertCount(1, Story::all());
    }

    public function test_days_to_expire_can_be_null()
    {
        $this->actAs->post(route('stories.store'), [
            'title' => 'A Title'
        ]);

        $this->assertCount(1, Story::all());
    }
}
