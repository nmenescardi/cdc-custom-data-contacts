<?php

namespace Tests\Unit;

use App\Contact;
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

    //TODO: test new method on Contact model to sync tags

    //TODO: test relationships?
}
