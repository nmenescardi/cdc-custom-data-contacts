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


        $this->withoutExceptionHandling();


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
}
