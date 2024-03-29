<?php

namespace Tests\Feature;

use App\Contact;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactsTest extends TestCase
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

    /** @test */
    public function a_contact_can_be_added()
    {
        $response = $this->actAs->post('/contacts', [
            'name' => 'Carlos'
        ]);

        $this->assertCount(1, Contact::all());

        $newContactId = Contact::first()->id;
        $response->assertRedirect(route('contacts.edit', $newContactId));
    }

    /** @test */
    public function a_name_is_required()
    {
        $initialURL = route('contacts.create');

        $response = $this->actAs->from($initialURL)->post('/contacts', []);

        $response->assertSessionHasErrors('name');
        $this->assertCount(0, Contact::all());

        $response->assertRedirect($initialURL);
    }

    /** @test */
    public function name_has_at_least_3_chars()
    {
        $initialURL = route('contacts.create');

        $response = $this->actAs->from($initialURL)->post('/contacts', [
            'name' => '12'
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertCount(0, Contact::all());

        $response->assertRedirect($initialURL);
    }

    /** @test */
    public function a_contact_can_be_updated()
    {
        $this->actAs->post('/contacts', [
            'name' => 'Carlos'
        ]);

        $newContact = Contact::first();

        $initialURL = route('contacts.edit', $newContact->id);

        $response = $this->actAs->from($initialURL)->patch(
            route('contacts.update', $newContact->id),
            [
                'name' => 'Maria'
            ]
        );

        $this->assertEquals('Maria', Contact::first()->name);
        $response->assertRedirect($initialURL);
    }

    /** @test */
    public function a_contact_can_be_deleted()
    {
        $this->actAs->post(
            '/contacts',
            ['name' => 'carlos']
        );

        $newContact = Contact::first();

        $response = $this->actAs->delete(
            route('contacts.destroy', $newContact->id)
        );

        $this->assertCount(0, Contact::all());
        $response->assertRedirect('/contacts');
    }

    /** @test */
    public function add_a_contact_with_tags()
    {
        $tagId1 = factory(Tag::class)->create()->id;
        $tagId2 = factory(Tag::class)->create()->id;
        $tagId3 = factory(Tag::class)->create()->id;

        $response = $this->actAs->post('/contacts', [
            'name' => 'Carlos',
            'tag_list' => [
                $tagId1, $tagId2, $tagId3
            ]
        ]);

        $this->assertCount(1, Contact::all());

        $newContactTags = Contact::first()->tags;

        $this->assertTrue($newContactTags->contains($tagId1));
        $this->assertTrue($newContactTags->contains($tagId2));
        $this->assertTrue($newContactTags->contains($tagId3));
    }


    /** @test */
    public function add_more_tags_to_an_existing_contact()
    {
        $tagId1 = factory(Tag::class)->create()->id;

        $response = $this->actAs->post('/contacts', [
            'name' => 'Carlos',
            'tag_list' => [$tagId1]
        ]);

        $newContact = Contact::first();

        $tagId2 = factory(Tag::class)->create()->id;
        $tagId3 = factory(Tag::class)->create()->id;

        $response = $this->actAs->patch(
            route('contacts.update', $newContact->id),
            [
                'name' => 'Carlos',
                'tag_list' => [$tagId2, $tagId3]
            ]
        );

        $newContactTags = $newContact->fresh()->tags;

        $this->assertTrue($newContactTags->contains($tagId1));
        $this->assertTrue($newContactTags->contains($tagId2));
        $this->assertTrue($newContactTags->contains($tagId3));
    }


    /** @test */
    public function contact_does_not_have_repeated_tags()
    {
        $tagId1 = factory(Tag::class)->create()->id;
        $tagId2 = factory(Tag::class)->create()->id;

        $response = $this->actAs->post('/contacts', [
            'name' => 'Carlos',
            'tag_list' => [$tagId1, $tagId2]
        ]);

        $newContact = Contact::first();

        $newContactTags = $newContact->tags;

        $this->assertEquals(2, $newContactTags->count());

        $response = $this->actAs->patch(
            route('contacts.update', $newContact->id),
            [
                'name' => 'Carlos',
                'tag_list' => [$tagId1, $tagId2]
            ]
        );

        $newContactTags = $newContact->fresh()->tags;
        $this->assertEquals(2, $newContactTags->count());
    }


    public function from(string $url)
    {
        $this->app['session']->setPreviousUrl($url);

        return $this;
    }
}
