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
        $initialURL = route('records.create');

        $contact = factory(Contact::class, 1)->create()->first();

        $response = $this->actAs->from($initialURL)->post('/records', [
            'description'   => 'Something else',
            'contact_id'    => $contact->id,
        ]);

        $response->assertSessionHasErrors('title');

        $this->assertCount(0, Record::all());

        $response->assertRedirect($initialURL);
    }

    public function test_contact_id_is_required()
    {
        $initialURL = route('records.create');

        $response = $this->actAs->from($initialURL)->post('/records', [
            'title'         => 'Something',
            'description'   => 'Something else',
        ]);

        $response->assertSessionHasErrors('contact_id');

        $this->assertCount(0, Record::all());

        $response->assertRedirect($initialURL);
    }



    //TODO: desc can be nullable


    //TODO: Update

    //TODO: Delete



    //TODO: Modify Record with tag

    public function from(string $url)
    {
        $this->app['session']->setPreviousUrl($url);

        return $this;
    }
}
