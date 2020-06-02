<?php

namespace Tests\Feature;

use App\Contact;
use App\Record;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordTest extends TestCase
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
    public function a_record_can_be_added()
    {
        $contact = factory(Contact::class, 1)->create()->first();

        $tagId1 = factory(Tag::class)->create()->id;
        $tagId2 = factory(Tag::class)->create()->id;
        $tagId3 = factory(Tag::class)->create()->id;

        $response = $this->actAs->post('/records', [
            'title'         => 'Something',
            'description'   => 'Something else',
            'contact_id'    => $contact->id,
            'tag_list'      => [
                $tagId1, $tagId2, $tagId3
            ]
        ]);

        $this->assertCount(1, Record::all());

        $contactID = Record::first()->contact->id;
        $response->assertRedirect(route('contacts.edit', $contactID));
    }

    /** @test */
    public function a_title_is_required()
    {
    }

    //TODO: Title is required

    //TODO: contact_id is required

    //TODO: desc can be nullable


    //TODO: Update

    //TODO: Delete



    //TODO: Modify Record with tag

}
