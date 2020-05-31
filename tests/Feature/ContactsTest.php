<?php

namespace Tests\Feature;

use App\Contact;
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

        $this->withoutExceptionHandling();

        $response = $this->actAs->post('/contacts', [
            'name' => 'Carlos'
        ]);

        $this->assertCount(1, Contact::all());
        $response->assertStatus(302);
    }

    /** @test */
    public function a_name_is_required()
    {
        $response = $this->actAs->post('/contacts', []);

        $response->assertSessionHasErrors('name');
        $this->assertCount(0, Contact::all());
    }
}
