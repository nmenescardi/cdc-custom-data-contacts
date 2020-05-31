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

    /** @test */
    public function name_has_at_least_3_chars()
    {
        $response = $this->actAs->post('/contacts', [
            'name' => '12'
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertCount(0, Contact::all());
    }

    /** @test */
    public function a_contact_can_be_updated()
    {
        $this->actAs->post('/contacts', [
            'name' => 'Carlos'
        ]);

        $response = $this->actAs->patch(
            route('contacts.update', 1),
            [
                'name' => 'Maria'
            ]
        );

        $this->assertEquals('Maria', Contact::first()->name);
    }
}
