<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordTest extends TestCase
{
    /** @test */
    public function a_record_can_be_added()
    {
        $this->withoutExceptionHandling();

        //TODO: Title, descr, contact_id, tag_list.
        //TODO: Place data array in separate method
    }

    //TODO: Title is required

    //TODO: contact_id is required

    //TODO: desc can be nullable


    //TODO: Update

    //TODO: Delete



    //TODO: Modify Record with tag

}
