<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Tests\TestCase;

class HomepageRootTest extends TestCase
{

    /** @test */
    public function root_page_redirects()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
}
