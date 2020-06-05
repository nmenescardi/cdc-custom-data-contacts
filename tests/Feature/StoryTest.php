<?php

namespace Tests\Feature;

use App\Story;
use App\Tag;
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

    public function test_a_story_can_be_updated()
    {
        $this->actAs->post(route('stories.store'), [
            'title'             => 'First Title',
            'description'       => 'First Desc',
            'days_to_expire'    => 2
        ]);

        $this->assertCount(1, Story::all());

        $story = Story::first();

        $this->actAs->patch(route('stories.update', $story), [
            'title'             => 'New Title',
            'description'       => 'New Desc',
            'days_to_expire'    => 15
        ]);

        $this->assertEquals('New Title', $story->fresh()->title);
        $this->assertEquals('New Desc', $story->fresh()->description);
        $this->assertEquals(15, $story->fresh()->days_to_expire);
    }

    public function test_a_story_can_be_deleted()
    {
        $this->actAs->post(
            route('stories.store'),
            ['title' => 'The Title']
        );

        $this->assertCount(1, Story::all());

        $story = Story::first();

        $this->actAs->delete(route('stories.destroy', $story));

        $this->assertCount(0, Story::all());
    }

    public function test_adding_a_story_with_tags()
    {

        $tagId1 = factory(Tag::class)->create()->id;
        $tagId2 = factory(Tag::class)->create()->id;
        $tagId3 = factory(Tag::class)->create()->id;

        $response = $this->actAs->post(
            route('stories.store'),
            [
                'title'     => 'The Title',
                'tag_list'  => [
                    $tagId1, $tagId2, $tagId3
                ]
            ]
        );

        $this->assertCount(1, Story::all());

        $newStoryTags = Story::first()->tags;

        $this->assertTrue($newStoryTags->contains($tagId1));
        $this->assertTrue($newStoryTags->contains($tagId2));
        $this->assertTrue($newStoryTags->contains($tagId3));
    }

    public function test_adding_more_tags_to_an_existing_story()
    {

        $tagId1 = factory(Tag::class)->create()->id;

        $response = $this->actAs->post(
            route('stories.store'),
            [
                'title'     => 'The Title',
                'tag_list'  => [$tagId1]
            ]
        );

        $this->assertCount(1, Story::all());

        $story = Story::first();

        $tagId2 = factory(Tag::class)->create()->id;
        $tagId3 = factory(Tag::class)->create()->id;

        $this->actAs->patch(route('stories.update', $story), [
            'title'    => 'New Title',
            'tag_list' => [$tagId2, $tagId3]
        ]);

        $storyTags = $story->fresh()->tags;

        $this->assertTrue($storyTags->contains($tagId1));
        $this->assertTrue($storyTags->contains($tagId2));
        $this->assertTrue($storyTags->contains($tagId3));
    }

    public function test_a_story_does_not_have_repeated_tags()
    {

        $tagId1 = factory(Tag::class)->create()->id;
        $tagId2 = factory(Tag::class)->create()->id;

        $response = $this->actAs->post(
            route('stories.store'),
            [
                'title'     => 'The Title',
                'tag_list'  => [$tagId1, $tagId2]
            ]
        );

        $this->assertCount(1, Story::all());

        $story = Story::first();

        $storyTags = $story->tags;

        $this->assertEquals(2, $storyTags->count());

        $tagId3 = factory(Tag::class)->create()->id;

        $this->actAs->patch(route('stories.update', $story), [
            'title'    => 'New Title',
            'tag_list' => [$tagId1, $tagId2, $tagId3]
        ]);

        $storyTags = $story->fresh()->tags;

        $this->assertEquals(3, $storyTags->count());
    }
}
