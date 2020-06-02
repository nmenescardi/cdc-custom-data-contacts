<?php

namespace Tests\Unit;

use App\Contact;
use App\Tag;
use Exception;
use Illuminate\Database\QueryException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_title_cannot_be_nullable()
    {
        $this->expectException(QueryException::class);

        Contact::firstOrCreate([]);

        $this->assertCount(0, Contact::all());
    }

    /** @test */
    public function add_new_tags_to_a_contact()
    {
        $tagId1 = factory(Tag::class)->create()->id;
        $tagId2 = factory(Tag::class)->create()->id;
        $tagId3 = factory(Tag::class)->create()->id;

        $contact = Contact::firstOrCreate(['name' => 'Carlos']);

        $this->assertCount(1, Contact::all());

        $contact->addTags([$tagId1, $tagId2, $tagId3]);

        $newContactTags = $contact->fresh()->tags;

        $this->assertTrue($newContactTags->contains($tagId1));
        $this->assertTrue($newContactTags->contains($tagId2));
        $this->assertTrue($newContactTags->contains($tagId3));
    }

    /** @test */
    public function contact_does_not_have_repeated_tags()
    {
        $tagId1 = factory(Tag::class)->create()->id;
        $tagId2 = factory(Tag::class)->create()->id;
        $tagId3 = factory(Tag::class)->create()->id;

        $contact = Contact::firstOrCreate(['name' => 'Carlos']);

        $contact->addTags([$tagId1, $tagId2]);

        $contact->addTags([$tagId1, $tagId2, $tagId3]);

        $newContactTags = $contact->fresh()->tags;
        $this->assertEquals(3, $newContactTags->count());
    }
}
